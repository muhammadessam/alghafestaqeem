<?php

namespace App\Notifications;

use App\Models\Evaluation\EvaluationEmployee;
use App\Models\Evaluation\EvaluationTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TimeNotification extends Notification
{
    use Queueable;

    private string $type;
    private EvaluationTransaction $evaluation_transaction;
    private EvaluationEmployee $employee;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $type, EvaluationTransaction $evaluation_transaction)
    {
        $this->type = $type;
        $this->evaluation_transaction = $evaluation_transaction;
        if ($this->type == 'preview')
            $this->employee = $this->evaluation_transaction->previewer;
        if ($this->type == 'income')
            $this->employee = $this->evaluation_transaction->income;
        if ($this->type == 'review')
            $this->employee = $this->evaluation_transaction->review;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable)
    {
        return [
            'appointment_type' => $this->type,
            'instrument_number' => $this->evaluation_transaction->instrument_number,
            'employee_name' => $this->employee->title
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
