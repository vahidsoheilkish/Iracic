<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ArticleSubmit
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $authors = array();
    public $id;
    public $title;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($authors,$id,$title)
    {
        $this->authors = $authors;
        $this->id = $id;
        $this->title = $title;
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
