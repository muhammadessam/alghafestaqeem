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
        \DB::statement('update evaluation_transactions set  is_iterated = 0;');
        $trans = EvaluationTransaction::all();
        $dispatcher = EvaluationTransaction::getEventDispatcher();
        EvaluationTransaction::unsetEventDispatcher();
        foreach ($trans as $tran) {
            $tran->timestamps = false;
            if (is_numeric($tran['instrument_number'])) {
                $col = EvaluationTransaction::where('instrument_number', $tran['instrument_number'])->where('id', '!=', $tran['id']);
                $col->timestamps = false;
                $col->update(['is_iterated' => true]);
            } else {
                $tran->update(['is_iterated' => false]);
            }
        }
        EvaluationTransaction::setEventDispatcher($dispatcher);
    }
}
