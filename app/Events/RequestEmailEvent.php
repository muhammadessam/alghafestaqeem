<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RequestEmailEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;


    public $title;
    public $contents;
    public $view;
    public $item;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($title, $contents, $view, $item =null)
    {
        //
        $this->title= $title;
        $this->contents= $contents;
        $this->view= $view;
        $this->item= $item;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}