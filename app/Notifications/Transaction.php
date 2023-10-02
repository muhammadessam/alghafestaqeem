<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Transaction extends Notification
{
    use Queueable;
    protected $Transaction;


    /**
     * Create a new notification instance.
     */
    public function __construct($Transaction,$type)
    {
        $this->Transaction=$Transaction;
                $this->type=$type;


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

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            
            'Transaction'=>$this->Transaction,
            'user'=>auth()->user(),
                        'type'=>$this->type

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
