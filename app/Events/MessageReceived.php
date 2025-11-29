<?php


namespace App\Events;


use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;


class MessageReceived implements ShouldBroadcast
{
use InteractsWithSockets, SerializesModels;


public $message;


public function __construct(Message $message)
{
$this->message = $message;
}



public function broadcastOn()
{
return new Channel('messages');
}



public function broadcastAs()
{
return 'message.received';
}
}
