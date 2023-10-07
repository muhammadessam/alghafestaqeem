<?php

namespace App\Repositories\Evaluation;

use App\Models\Evaluation\EvaluationTransaction;
use Illuminate\Support\Str;
use App\Models\Evaluation\EvaluationTransaction as Transaction;
use App\Interfaces\Evaluation\TransactionRepositoryInterface;
use App\Models\Evaluation\EvaluationCompany;
use App\Models\Evaluation\EvaluationEmployee;


use Carbon\Carbon;


class TransactionRepository implements TransactionRepositoryInterface
{
    public function getAllTransactions()
    {
        return Transaction::get();
    }

    public function getPublishTransactions($page, $list = 'paginate')
    {
        $data = Transaction::Ordered();
        if ($list == 'list') {
            $data = $data->take($page)->get();
        } elseif ($list == 'all') {
            $data = $data->get();
        } else {
            $data = $data->paginate($page);
        }
        return $data;
    }

    public function getdailyTransactions($data)
    {

        $items = Transaction::Recent();
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $employee = $data['employee'] ?? '';
        $company = $data['company'] ?? '';
        $city = $data['city'] ?? '';

        if (isset($search) && $search != '') {
            $items = $items->where(
                function ($q) use ($search) {
                    $q->where('id', 'like', '%' . $search . '%');
                    $q->orWhere('transaction_number', 'like', '%' . $search . '%');
                    $q->orWhere('instrument_number', 'like', '%' . $search . '%');
                    $q->orWhere('owner_name', 'like', '%' . $search . '%');
                    $q->orWhere('region', 'like', '%' . $search . '%');

                }
            );
        }
        if (isset($from_date) && $from_date != '') {
            $items = $items->whereDate('updated_at', '>=', $from_date);
        }
        if (isset($to_date) && $to_date != '') {
            $items = $items->whereDate('updated_at', '<=', $to_date);
        }
        if (isset($from_date) && $from_date != '' && isset($to_date) && $to_date != '') {
            $items = $items->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date);


        }
        if (isset($status) && $status != '' && $status != '-1') {
            $items = $items->where('status', $status);
        }

        if (isset($company) && $company != '') {
            $items = $items->whereIn('evaluation_company_id', $company);
        }

        if (isset($city) && $city != '') {
            $items = $items->where('city_id', $city);
        }

        if (isset($employee) && $employee != '') {
            $items = $items->where(
                function ($q) use ($employee) {
                    $q->where('previewer_id', $employee);
                    $q->orWhere('income_id', $employee);
                    $q->orWhere('review_id', $employee);
                }
            );
        }
        $items = $items->whereDate('created_at', Carbon::today())->get();


        return $items;
    }

    public function getReviewTransactions($data)
    {
        $items = Transaction::Recent();
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $employee = $data['employee'] ?? '';
        $company = $data['company'] ?? '';
        $city = $data['city'] ?? '';

        if (isset($search) && $search != '') {
            $items = $items->where(
                function ($q) use ($search) {
                    $q->where('id', 'like', '%' . $search . '%');
                    $q->orWhere('transaction_number', 'like', '%' . $search . '%');
                    $q->orWhere('instrument_number', 'like', '%' . $search . '%');
                    $q->orWhere('owner_name', 'like', '%' . $search . '%');
                    $q->orWhere('region', 'like', '%' . $search . '%');

                }
            );
        }
        if (isset($from_date) && $from_date != '') {
            $items = $items->whereDate('updated_at', '>=', $from_date);
        }
        if (isset($to_date) && $to_date != '') {
            $items = $items->whereDate('updated_at', '<=', $to_date);
        }
        if (isset($status) && $status != '' && $status != '-1') {
            $items = $items->where('status', $status);
        }

        if (isset($company) && $company != '') {
            $items = $items->whereIn('evaluation_company_id', $company);
        }

        if (isset($city) && $city != '') {
            $items = $items->where('city_id', $city);
        }

        if (isset($employee) && $employee != '') {
            $items = $items->where(
                function ($q) use ($employee) {
                    $q->where('previewer_id', $employee);
                    $q->orWhere('income_id', $employee);
                    $q->orWhere('review_id', $employee);
                }
            );
        }

        $items = $items->where('status', 3)->get();

        return $items;


    }

    public function getPaginateTransactions2($data)
    {
        $items = Transaction::Recent();
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $employee = $data['employee'] ?? '';
        $company = $data['company'] ?? '';
        $city = $data['city'] ?? '';

        if (isset($search) && $search != '') {
            $items = $items->where(
                function ($q) use ($search) {
                    $q->where('id', 'like', '%' . $search . '%');
                    $q->orWhere('transaction_number', 'like', '%' . $search . '%');
                    $q->orWhere('instrument_number', 'like', '%' . $search . '%');
                    $q->orWhere('owner_name', 'like', '%' . $search . '%');
                    $q->orWhere('region', 'like', '%' . $search . '%');

                }
            );
        }
        if (isset($from_date) && $from_date != '') {
            $items = $items->whereDate('updated_at', '>=', $from_date);
        }
        if (isset($to_date) && $to_date != '') {
            $items = $items->whereDate('updated_at', '<=', $to_date);
        }
        if (isset($status) && $status != '' && $status != '-1') {
            $items = $items->where('status', $status);
        }

        if (isset($company) && $company != '') {
            $items = $items->whereIn('evaluation_company_id', $company);
        }

        if (isset($city) && $city != '') {
            $items = $items->where('city_id', $city);
        }

        if (isset($employee) && $employee != '') {
            $items = $items->where(
                function ($q) use ($employee) {
                    $q->where('previewer_id', $employee);
                    $q->orWhere('income_id', $employee);
                    $q->orWhere('review_id', $employee);
                }
            );
        }

        $items = $items->orderBy('id', 'DESC')->paginate(25);

        return $items;
    }


    public function getPaginateTransactions($data)
    {
        $items = Transaction::Recent();
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $employee = $data['employee'] ?? '';
        $company = $data['company'] ?? '';
        $city = $data['city'] ?? '';

        if (isset($search) && $search != '') {
            $items = $items->where(
                function ($q) use ($search) {
                    $q->where('id', 'like', '%' . $search . '%');
                    $q->orWhere('transaction_number', 'like', '%' . $search . '%');
                    $q->orWhere('instrument_number', 'like', '%' . $search . '%');
                    $q->orWhere('owner_name', 'like', '%' . $search . '%');
                    $q->orWhere('region', 'like', '%' . $search . '%');

                }
            );
        }
        if (isset($from_date) && $from_date != '') {
            $items = $items->whereDate('updated_at', '>=', $from_date);
        }
        if (isset($to_date) && $to_date != '') {
            $items = $items->whereDate('updated_at', '<=', $to_date);
        }
        if (isset($status) && $status != '' && $status != '-1') {
            $items = $items->where('status', $status);
        }

        if (isset($company) && $company != '') {
            $items = $items->whereIn('evaluation_company_id', $company);
        }

        if (isset($city) && $city != '') {
            $items = $items->where('city_id', $city);
        }

        if (isset($employee) && $employee != '') {
            $items = $items->where(
                function ($q) use ($employee) {
                    $q->where('previewer_id', $employee);
                    $q->orWhere('income_id', $employee);
                    $q->orWhere('review_id', $employee);
                }
            );
        }

        $items = $items->get();

        return $items;
    }

    public function getCompanyTransactions($data)
    {

        $first_day_of_the_current_month = Carbon::today()->startOfMonth();
        $items = EvaluationCompany::with(['Transaction' => function ($q) use ($first_day_of_the_current_month) {
            $q->whereDate('date', '>=', $first_day_of_the_current_month);
        }])->get();

        $status = $data['status'] ?? '-1';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $city = $data['city'] ?? '';


        if (isset($from_date) && $from_date != '') {
            $items = EvaluationCompany::with(['Transaction' => function ($q) use ($from_date) {
                $q->whereDate('updated_at', '>=', $from_date);
            }])->get();
        }
        if (isset($to_date) && $to_date != '') {
            $items = EvaluationCompany::with(['Transaction' => function ($q) use ($to_date) {
                $q->whereDate('updated_at', '<=', $to_date);
            }])->get();
        }
        if (isset($from_date) && $from_date != '' && isset($to_date) && $to_date != '') {

            $items = EvaluationCompany::with(['Transaction' => function ($q) use ($from_date, $to_date) {
                $q->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date);
            }])->get();
        }
        if (isset($status) && $status != '' && $status != '-1') {
            $items = EvaluationCompany::with(['Transaction' => function ($q) use ($status) {
                $q->where('status', $status);
            }])->get();
        }
        if (isset($city) && $city != '') {
            $items = EvaluationCompany::with(['Transaction' => function ($q) use ($city) {
                $q->where('city_id', $city);
            }])->get();
        }
        if (isset($from_date) && $from_date != '' && isset($to_date) && $to_date != '' && isset($city) && $city != '') {

            $items = EvaluationCompany::with(['Transaction' => function ($q) use ($from_date, $to_date, $city) {
                $q->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date)->where('city_id', '=', $city);
            }])->get();
        }
        if (isset($from_date) && $from_date != '' && isset($to_date) && $to_date != '' && isset($status) && $status != '-1') {

            $items = EvaluationCompany::with(['Transaction' => function ($q) use ($from_date, $to_date, $status) {
                $q->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date)->where('status', $status);
            }])->get();
        }
        if (isset($from_date) && $from_date != '' && isset($to_date) && $to_date != '' && isset($status) && $status != '-1' && isset($city) && $city != '') {

            $items = EvaluationCompany::with(['Transaction' => function ($q) use ($from_date, $to_date, $status, $city) {
                $q->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date)->where('status', $status)->where('city_id', $city);
            }])->get();
        }


        return $items;
    }

    public function getemployeeTransactions($data,)
    {

        $items = EvaluationEmployee::with('Transactionpreviewer')->with('Transactionincome')->with('Transactionreview')->get();
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';


        if (isset($from_date) && $from_date != '') {
            $items = EvaluationEmployee::with(['Transactionpreviewer' => function ($q) use ($from_date) {
                $q->whereDate('updated_at', '>=', $from_date);
            }])->with(['Transactionincome' => function ($q) use ($from_date) {
                $q->whereDate('updated_at', '>=', $from_date);
            }])->with(['Transactionreview' => function ($q) use ($from_date) {
                $q->whereDate('updated_at', '>=', $from_date);
            }])->get();
        }
        if (isset($to_date) && $to_date != '') {
            $items = EvaluationEmployee::with(['Transactionpreviewer' => function ($q) use ($to_date) {
                $q->whereDate('updated_at', '<=', $to_date);
            }])->with(['Transactionincome' => function ($q) use ($to_date) {
                $q->whereDate('updated_at', '<=', $to_date);
            }])->with(['Transactionreview' => function ($q) use ($to_date) {
                $q->whereDate('updated_at', '<=', $to_date);
            }])->get();
        }

        if (isset($from_date) && $from_date != '' && isset($to_date) && $to_date != '') {
            $items = EvaluationEmployee::
            with(['Transactionpreviewer' => function ($q) use ($from_date, $to_date) {
                $q->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date);
            }])->with(['Transactionincome' => function ($q) use ($from_date, $to_date) {
                $q->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date);
            }])->with(['Transactionreview' => function ($q) use ($from_date, $to_date) {
                $q->whereDate('updated_at', '>=', $from_date)->whereDate('updated_at', '<=', $to_date);
            }])->get();
        }


        return $items;
    }

    public function getCount()
    {
        return Transaction::count();
    }

    public function getTransactionById($transactionId)
    {
        return Transaction::with('files')->findOrFail($transactionId);
    }

    public function getTransactionBySlug($transactionSlug)
    {
        return Transaction::where('transaction_number', $transactionSlug)->first();
    }

    public function deleteTransaction($transactionId)
    {
        $deleted_trans = Transaction::find($transactionId);
        $updated_trans = Transaction::where('instrument_number', $deleted_trans->instrument_number)->where('id', '!=', $transactionId)->get();
        Transaction::destroy($transactionId);
        if ($updated_trans->count() == 1) {
            $updated_trans->first()->is_iterated = false;
            $updated_trans->first()->saveQuietly();
        }
    }

    public function createTransaction($transactionDetails)
    {
        return Transaction::create($transactionDetails);
    }

    public function updateTransaction($transactionId, $newDetails)
    {
        return Transaction::find($transactionId)->update($newDetails);
    }
}
