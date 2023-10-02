<?php

namespace App\Exports;

use App\Models\Evaluation\EvaluationTransaction;
use Maatwebsite\Excel\Concerns\FromCollection;

class EvaluationTransactionExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return EvaluationTransaction::orderBy('id', 'DESC')->get();
    }
}
