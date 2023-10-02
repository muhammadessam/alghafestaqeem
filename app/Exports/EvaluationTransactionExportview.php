<?php

namespace App\Exports;

use App\Models\Evaluation\EvaluationTransaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;


class EvaluationTransactionExportview implements FromView,WithEvents 
{
    /**
    * @return \Illuminate\Support\Collection
    
    */
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
            },
        ];
    }

    public function view(): View
    {
       
  
        $items= EvaluationTransaction::Recent();
        $status = $this->request->status ?? '-1';
        $search = $this->request->search ?? '';
        $from_date = $this->request->from_date ?? '';
        $to_date = $this->request->to_date ?? '';
        $employee = $this->request->employee ?? '';
        $company = $this->request->company ?? '';
        $city = $this->request->city ?? '';

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

        return view('admin.evaluation.transactions.test', ['items' => $items]);
       

       
    }
}
