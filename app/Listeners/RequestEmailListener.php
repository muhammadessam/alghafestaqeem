<?php

namespace App\Listeners;

use App\Mail\SendRequestMail;
use App\Events\RequestEmailEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Interfaces\SettingRepositoryInterface;

class RequestEmailListener implements ShouldQueue
{
    private SettingRepositoryInterface $settingRepository;
    public $default_email;
    public $request_emails;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(SettingRepositoryInterface $settingRepository)
    {
        //
        $this->settingRepository = $settingRepository;
        $setting =  $this->settingRepository->getFirstSettings();
        $this->default_email= $setting->default_email;
        $this->emails= $setting->request_emails;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\RequestEmailEvent  $event
     * @return void
     */
    public function handle(RequestEmailEvent $event)
    {
        $default_email = $this->default_email;
        $emails = $this->emails;

        Mail::to($default_email)->cc($emails)
            ->send(new SendRequestMail($event->title, $event->contents, $event->view, $event->item))
        ;
    }
}