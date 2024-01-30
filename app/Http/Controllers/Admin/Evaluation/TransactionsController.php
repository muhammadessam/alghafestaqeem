<?php

namespace App\Http\Controllers\Admin\Evaluation;

use App\Models\Category;
use App\Helpers\Constants;
use Illuminate\Http\Request;
use App\Http\Requests\Transaction;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Http\Requests\ChangeStatusRequest;
use App\Models\Evaluation\EvaluationCompany;
use App\Models\Evaluation\EvaluationEmployee;
use App\Models\Evaluation\EvaluationTransaction;
use App\Interfaces\Evaluation\TransactionRepositoryInterface;
use App\Models\City;
use App\Models\User;
use App\Models\Transaction_files;
use Illuminate\Validation\Rules\File;
use App\Notifications\Transaction as NotfyTransaction;
use Auth;
use Illuminate\Support\Facades\DB;


class TransactionsController extends Controller
{
    private TransactionRepositoryInterface $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->middleware('auth');
        $this->middleware('checkPermission:evaluation-transactions.index')->only(['index']);
        $this->middleware('checkPermission:evaluation-transactions.show')->only(['show']);
        $this->middleware('checkPermission:evaluation-transactions.edit')->only(['edit']);
        $this->middleware('checkPermission:evaluation-transactions.delete')->only(['destroy']);
        $this->middleware('checkPermission:evaluation-transactions.create')->only(['create']);
        $this->middleware('checkPermission:evaluation-transactions.show')->only(['daily']);
    }

    public function DeleteFile($id)
    {
        Transaction_files::where('id', $id)->delete();
        return back();
    }

    private function uploadfiles(Request $request, $id)
    {

        $files = $request->file('files');
        foreach ($files as $file) {
            $filename = $file->getClientOriginalName();
            $destinationPath = 'upload/transaction';
            $extension = $file->getClientMimeType();
            $file->move(public_path($destinationPath), $filename);

            Transaction_files::create([
                'Transaction_id' => $id,
                'path' => $filename,
                'type' => $extension,
            ]);
        }
    }


    public function chick_instrument_number($value)
    {
        if (is_numeric($value)) {
            $test = EvaluationTransaction::where('instrument_number', $value)->get();
            if (count($test) > 0) {
                $massage = "<span  style='color: #dc3545;'>رقم الصك موجود مسبقا</span>";
            } else {
                $massage = "<span  style='color: #3d8d3d;'> يمكنك استخدام رقم الصك</span>";
            }
        }
        return response()->json($massage);
    }

    public function checkNewRegion()
    {
        $exists = EvaluationTransaction::where('new_city_id', request()->new_city_id)
            ->where('plan_no', request()->plan_no)
            ->where('plot_no', request()->plot_no)
            ->first();
        if ($exists) {
            $massage = "<span  style='color: #dc3545;'>توجد معاملة بنفس العنوان (المدينة، رقم المخطط، رقم القطعة)</span>";
        } else {
            $massage = "<span  style='color: #3d8d3d;'>يمكنك استخدام هذا العنوان (المدينة، رقم المخطط، رقم القطعة)</span>";
        }
        return response()->json($massage);
    }

    public function index(Request $request)
    {
        return view('admin.evaluation.transactions.index2');
    }


    public function index2(Request $request)
    {

        $result = [];
        $amount = 0;
        $previewer = 0;
        $review = 0;
        $income = 0;
        $transaction = 0;
        $data = $request->all();
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $employee = $data['employee'] ?? '';
        $company = $data['company'] ?? '';
        $counts = $this->transactionRepository->getCount();
        $items = $this->transactionRepository->getPaginateTransactions($data);
        $statuses = Constants::TransactionStatuses;
        /*
        عدد المعاملات  =(مجموع المعاين بيساوى 1+  مجموع الادخال بيساوى 0.5 + مجموع المراحعه بيساوى 0.5 )
        'previewer',
        'review',
        'income',
         */
        if (isset($employee) && $employee != '') {
            $previewer = $items
                ->where('previewer_id', $employee)
                ->count();
            $review = $items->where('review_id', $employee)->count();
            $income = $items->where('income_id', $employee)->count();
            $employee = EvaluationEmployee::where('id', $employee)->first();
            $transaction = $previewer + (0.5 * ($review + $income));

            if (!empty($employee)) {
                $amount = $employee->price * $transaction;
            }
        } else {
            $transaction = $items->count();
        }

        $result = [
            'from_date' => $from_date,
            'to_date' => $to_date,
            'items' => $items,
            'counts' => $counts,
            'status' => $status,
            'search' => $search,
            'statuses' => $statuses,
            'employees' => EvaluationEmployee::get(),
            'companies' => EvaluationCompany::get(),
            'types' => Category::ApartmentType()->get(),
            'cities' => Category::City()->get(),

            'transaction' => $transaction,
            'previewer' => $previewer,
            'review' => $review,
            'income' => $income,
            'amount' => $amount
        ];

        return view(
            'admin.evaluation.transactions.index',
            compact('result')
        );
    }


    public function create(EvaluationTransaction $item, request $request)
    {
        $result['company'] = null;

        if ($request->company != null) {
            $result['company'] = EvaluationCompany::find($request->company);
        }
        $result['employees'] = EvaluationEmployee::get();
        $result['companies'] = EvaluationCompany::get();
        $result['types'] = Category::ApartmentType()->get();
        $result['cities'] = Category::City()->get();
        $cities = City::all();
        return view('admin.evaluation.transactions.create_and_edit', compact('item', 'result', 'cities'));
    }

    public function store(TransactionRequest $request)
    {
        $search = EvaluationTransaction::where('instrument_number', $request->instrument_number)->where('transaction_number', $request->transaction_number)
            ->where('owner_name', $request->owner_name)->where('region', $request->region)->where('notes', $request->notes)->where('date', $request->date)->get();
        if (count($search) > 0) {
            return redirect()->route('admin.evaluation-transactions.index');
        }
        $data = $request->all();

        if (
            $data['previewer_id'] != null &&
            $data['income_id'] != null &&
            $data['review_id'] != null
        ) {
            $status = 4;
        } else if (
            ($data['previewer_id'] != null && $data['income_id'] != null) || $data['previewer_id'] != null
        ) {
            $status = 3;
        } else {
            $status = 0;
        }

        $data['status'] = $status;

        if ($data['preview_date'] != null && $data['preview_time'] != null)
            $data['preview_date_time'] = $data['preview_date'] . ' ' . $data['preview_time'];
        if ($data['review_date'] != null && $data['review_time'] != null)
            $data['review_date_time'] = $data['review_date'] . ' ' . $data['review_time'];
        if ($data['income_date'] != null && $data['income_time'] != null)
            $data['income_date_time'] = $data['income_date'] . ' ' . $data['income_time'];

        unset($data['preview_date']);
        unset($data['preview_time']);
        unset($data['review_date']);
        unset($data['review_time']);
        unset($data['income_date']);
        unset($data['income_time']);

        $transaction = $this->transactionRepository->createTransaction($data);
        if ($request->has('files')) {
            $this->uploadfiles($request, $transaction->id);
        }
        // notfy
        $user = User::find('1');
        $message = " تمت أضافة معاملة جديدة برقم" . $transaction->instrument_number;
        $user->notify(new NotfyTransaction($transaction, $message));
        //

        if (isset($request->company) && $request->company != null) {
            return redirect()->route('admin.single_transactions', $request->company)
                ->with('message', __('admin.AddedMessage'));
        }

        if (isset($request->action) && $request->action == 'preview') {
            return redirect()->route('admin.evaluation-transactions.store')
                ->with('message', __('admin.AddedMessage'));
        }

        return redirect()->route('admin.evaluation-transactions.index')
            ->with('message', __('admin.AddedMessage'));
    }

    public function show($id)
    {
        $item = $this->transactionRepository->getTransactionById($id);
        return view('admin.evaluation.transactions.show', compact('item'));
    }

    public function edit($id, request $request)
    {
        $result['company'] = null;

        if ($request->company != null) {
            $result['company'] = EvaluationCompany::find($request->company);
        }
        $item = $this->transactionRepository->getTransactionById($id);
        $result['employees'] = EvaluationEmployee::get();
        $result['companies'] = EvaluationCompany::get();
        $result['types'] = Category::ApartmentType()->get();
        $result['cities'] = Category::City()->get();
        $cities = City::all();

        return view('admin.evaluation.transactions.create_and_edit', compact('item', 'result', 'cities'));
    }

    public function update(TransactionRequest $request, $id)
    {
        $data = $request->except(['_token', '_method']);
        if ($data['review_id'] != null) {
            $status = 4;
        } elseif ($data['previewer_id'] != null) {
            $status = 3;
        } else {
            $status = 0;
        }

        $data['status'] = $status;


        $this->transactionRepository->updateTransaction($id, $data);
        if ($request->has('files')) {
            $this->uploadfiles($request, $id);
        }
        $transaction = EvaluationTransaction::find($id);
        $user = User::find('1');
        $message = "تمت تعديل معاملة برقم " . $transaction->instrument_number;
        $user->notify(new NotfyTransaction($transaction, $message));
        if (isset($request->company) && $request->company != null) {
            return redirect()->route('admin.single_transactions', $request->company)
                ->with('message', __('admin.UpdatedMessage'));
        }

        return redirect()->route('admin.evaluation-transactions.index')
            ->with('message', __('admin.UpdatedMessage'));
    }

    public function changeStatus(ChangeStatusRequest $request, $id)
    {
        $data = ['status' => $request->status];;
        $this->transactionRepository->updateTransaction($id, $data);
        //
        if ($request->status == 0) {
            $Newstatus = __('admin.NewTransaction');
        } elseif ($request->status == 1) {
            $Newstatus = __('admin.InReviewRequest');
        } elseif ($request->status == 2) {
            $Newstatus = __('admin.ContactedRequest');
        } elseif ($request->status == 3) {
            $Newstatus = __('admin.ReviewedRequest');
        } elseif ($request->status == 4) {
            $Newstatus = __('admin.FinishedRequest');
        } elseif ($request->status == 5) {
            $Newstatus = __('admin.PendingRequest');
        } elseif ($request->status == 6) {
            $Newstatus = __('admin.Cancelled');
        }


        //
        $transaction = EvaluationTransaction::find($id);
        $user = User::find('1');
        $message = "تمت تغير حالة معاملة برقم " . $transaction->instrument_number . " إالى" . $Newstatus;
        $user->notify(new NotfyTransaction($transaction, $message));

        return redirect()->route('admin.evaluation-transactions.index')
            ->with('message', __('admin.UpdatedMessage'));
    }

    public function destroy($id)
    {
        $transaction = EvaluationTransaction::find($id);
        $user = User::find('1');
        $message = "تمت مسح معاملة برقم " . $transaction->instrument_number;
        $user->notify(new NotfyTransaction($transaction, $message));
        $this->transactionRepository->deleteTransaction($id);


        return redirect()->back()
            ->with('message', __('admin.DeletedMessage'));
    }
}
