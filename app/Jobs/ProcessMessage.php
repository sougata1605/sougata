<?php


namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;
use App\Events\MessageReceived;


class ProcessMessage implements ShouldQueue
{
use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


public $messageId;


public function __construct($messageId)
{
$this->messageId = $messageId;
}


public function handle()
{
$message = Message::find($this->messageId);
if (! $message) {
return;
}



$clean = strip_tags($message->message);
$metadata = [
'length' => mb_strlen($clean),
'sanitized' => $clean,
'processed_by' => 'ProcessMessage@' . get_class($this),
'processed_at' => now()->toDateTimeString(),
];


$message->update([
'message' => $clean,
'metadata' => $metadata,
'processed_at' => now(),
]);



broadcast(new MessageReceived($message))->toOthers();
}
}
