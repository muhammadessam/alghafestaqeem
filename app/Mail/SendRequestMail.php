<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRequestMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $title;
    public $contents;
    public $item;
    public $view;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $contents, $view, $item)
    {
        //

        $this->title= $title;
        $this->contents= $contents;
        $this->item= $item;
        $this->view= $view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $title = $this->title;
        $contents = $this->contents;
        $item = $this->item;
        $view = $this->view;

        return $this->subject($title)->view('emails.'.$view, compact('title', 'contents', 'item'));
    }
}