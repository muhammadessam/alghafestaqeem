<?php

namespace App\Console\Commands;

use App\Models\Evaluation\EvaluationTransaction;
use Illuminate\Console\Command;

class MakeIsIteratableCommand extends Command
{
    protected $signature = 'make:is-iterable';

    protected $description = 'Command description';

    public function handle(): void
    {
        $trans = EvaluationTransaction::all();
        foreach ($trans as $tran) {
            $tran->timestamps = false;
            if (is_numeric($tran['instrument_number'])) {
                if (EvaluationTransaction::where('instrument_number', $tran['instrument_number'])->where('id', '!=', $tran['id'])->count())
                    EvaluationTransaction::where('instrument_number', $tran['instrument_number'])->where('id', '!=', $tran['id'])->update([
                        'is_iterated' => true
                    ]);
                else
                    $tran->update([
                        'is_iterated' => false
                    ]);
            } else {
                $tran->update([
                    'is_iterated' => false
                ]);
            }
        }
    }
}
