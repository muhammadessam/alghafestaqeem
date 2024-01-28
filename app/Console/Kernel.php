<?php

namespace App\Console;

use App\Models\Evaluation\EvaluationTransaction;
use App\Models\User;
use App\Notifications\TimeNotification;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('backup:clean')->daily()->at('01:00');
        $schedule->command('backup:run')->daily()->at('01:30');

        // Send notifications for appointments
        $schedule->call(function () {
            $user = User::find('1');
            $start_dt = Carbon::now()->subDays(3)->format('Y-m-d H:m:s');
            $end_dt = Carbon::now()->addDays(3)->format('Y-m-d H:m:s');
            foreach (['preview', 'income', 'review'] as $type) {
                $evaluation_transactions = EvaluationTransaction::where('status', 3)
                    ->whereDate($type . '_date_time', '>', $start_dt)
                    ->whereDate($type . '_date_time', '<', $end_dt)
                    ->get();
                foreach ($evaluation_transactions as $evaluation_transaction) {
                    $user->notify(new TimeNotification($type, $evaluation_transaction));
                }
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
