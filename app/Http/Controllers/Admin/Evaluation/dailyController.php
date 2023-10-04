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
// use Datatables;
use Excel;
use App\Exports\EvaluationTransactionExport;
use App\Exports\EvaluationTransactionExportview;



class dailyController extends Controller
{
    private TransactionRepositoryInterface $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->middleware('auth');
        $this->middleware('checkPermission:evaluation-transactions.index')->only(['index']);



    }

      public function export(request $request)
    {
      // return Excel::download($item, 'EvaluationTransactionExport.xlsx');

      return Excel::download(new EvaluationTransactionExportview($request), 'صالح بن علي الغفيص عاملات التقييم .xlsx');
    }
    //
     public function deletenotification($id)
    {
        auth()->user()->notifications()->where('id', $id)->delete();

        return redirect('admin/notifucation')
            ->with('message', 'تم مسح الإشعار.');
    }

    public function index(Request $request)
    {
        $result = [];
        $amount = 0;
        $transaction = 0;
        $previewer=0;
        $review=0;
        $income=0;
        $data = $request->all();
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $employee = $data['employee'] ?? '';
        $company = $data['company'] ?? '';
        $counts = $this->transactionRepository->getCount();
        $items = $this->transactionRepository->getdailyTransactions($data);
        $statuses = Constants::TransactionStatuses;

        if (isset($employee) && $employee != '') {
            $previewer = $items
                ->where('previewer_id',  $employee)
                ->count();
            $review = $items->where('review_id',  $employee)->count();
            $income = $items->where('income_id',  $employee)->count();
            $employee= EvaluationEmployee::where('id', $employee)->first();
            $transaction = $previewer + (0.5* ($review+$income)) ;

            if(! empty($employee) ){
                $amount = $employee->price *  $transaction;
            }
        }else{
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
            'transaction'  => $transaction,
            'previewer'=>$previewer,
            'review'=>$review,
            'income'=>$income,
            'amount' => $amount
        ];

        //$data= DataTable::of($result['items'])->make(true);


        return view(
            'admin.evaluation.transactions.daily',
            compact('result')
        );
    }
    // sh

    public function Review_transactions(Request $request)
    {

        $result = [];
        $amount = 0;
        $transaction = 0;
        $previewer=0;
        $review=0;
        $income=0;
        $data = $request->all();
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $employee = $data['employee'] ?? '';
        $company = $data['company'] ?? '';
        $counts = $this->transactionRepository->getCount();
        $items = $this->transactionRepository->getReviewTransactions($data);
        $statuses = Constants::TransactionStatuses;

        if (isset($employee) && $employee != '') {
            $previewer = $items
                ->where('previewer_id',  $employee)
                ->count();
            $review = $items->where('review_id',  $employee)->count();
            $income = $items->where('income_id',  $employee)->count();
            $employee= EvaluationEmployee::where('id', $employee)->first();
            $transaction = $previewer + (0.5* ($review+$income)) ;

            if(! empty($employee) ){
                $amount = $employee->price *  $transaction;
            }
        }else{
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
            'transaction'  => $transaction,
            'previewer'=>$previewer,
            'review'=>$review,
            'income'=>$income,
            'amount' => $amount
        ];



        return view(
            'admin.evaluation.transactions.review',
            compact('result')
        );

    }

     public function company_transactions(Request $request)
    {

        $result = [];
        $amount = 0;
        $transaction = 0;

        $data = $request->all();
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $company = $data['company'] ?? '';
         $items = $this->transactionRepository->getCompanyTransactions($data);
        $statuses = Constants::TransactionStatuses;
        $counts = Count($items);



        $result = [
            'from_date' => $from_date,
            'to_date' => $to_date,
            'items' => $items,
            'counts' => $counts,
            'status' => $status,
            'search' => $search,
            'statuses' => $statuses,
            'cities' => Category::City()->get(),

        ];

        //$data= DataTable::of($result['items'])->make(true);


        return view(
            'admin.evaluation.transactions.company.index',
            compact('result')
        );

    }

         public function user_transactions(Request $request)
    {
        $result = [];
        $amount = 0;
        $search = $data['search'] ?? '';

        $data = $request->all();
        $status = $data['status'] ?? '-1';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $items = $this->transactionRepository->getemployeeTransactions($data);
        $statuses = Constants::TransactionStatuses;
        $counts = count($items);


        // if (isset($employee) && $employee != '') {
        //     $previewer = $items
        //         ->where('previewer_id',  $employee)
        //         ->count();
        //     $review = $items->where('review_id',  $employee)->count();
        //     $income = $items->where('income_id',  $employee)->count();
        //     $employee= EvaluationEmployee::where('id', $employee)->first();
        //     $transaction = $previewer + (0.5* ($review+$income)) ;

        //     if(! empty($employee) ){
        //         $amount = $employee->price *  $transaction;
        //     }
        // }else{
        //     $transaction = $items->count();
        // }

        $result = [
            'from_date' => $from_date,
            'to_date' => $to_date,
            'items' => $items,
            'counts' => $counts,
            'status' => $status,
            'search' => $search,
            'statuses' => $statuses,
            'types' => Category::ApartmentType()->get(),

            'amount' => $amount
        ];



        return view(
            'admin.evaluation.transactions.employe.index',
            compact('result')
        );
    }


        public function AllCompany_transactions(Request $request)
    {

        $result = [];
        $amount = 0;
        $transaction = 0;

        $data = $request->all();
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $company = $data['company'] ?? '';
         $items = $this->transactionRepository->getCompanyTransactions($data);
        $statuses = Constants::TransactionStatuses;
        $counts = Count($items);



        $result = [
            'from_date' => $from_date,
            'to_date' => $to_date,
            'items' => $items,
            'counts' => $counts,
            'status' => $status,
            'search' => $search,
            'statuses' => $statuses,
            'cities' => Category::City()->get(),

        ];

        //$data= DataTable::of($result['items'])->make(true);


        return view(
            'admin.evaluation.transactions.company.companies',
            compact('result')
        );

    }

    public function single_transactions($id,Request $request)
    {
        $result = [];
        $amount = 0;
        $transaction = 0;
        $previewer=0;
        $review=0;
        $income=0;
        $data = $request->all();
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $employee = $data['employee'] ?? '';
        $data['company']=[$id];
        $company = EvaluationCompany::find($id);
        $counts = $this->transactionRepository->getCount();
        $items = $this->transactionRepository->getPaginateTransactions($data);
        $statuses = Constants::TransactionStatuses;

        if (isset($employee) && $employee != '') {
            $previewer = $items
                ->where('previewer_id',  $employee)
                ->count();
            $review = $items->where('review_id',  $employee)->count();
            $income = $items->where('income_id',  $employee)->count();
            $employee= EvaluationEmployee::where('id', $employee)->first();
            $transaction = $previewer + (0.5* ($review+$income)) ;

            if(! empty($employee) ){
                $amount = $employee->price *  $transaction;
            }
        }else{
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
            'types' => Category::ApartmentType()->get(),
            'cities' => Category::City()->get(),
            'transaction'  => $transaction,
            'previewer'=>$previewer,
            'review'=>$review,
            'income'=>$income,
            'amount' => $amount,
            'company'=>$company
        ];



        return view(
            'admin.evaluation.transactions.company.single',
            compact('result')
        );
    }














}
