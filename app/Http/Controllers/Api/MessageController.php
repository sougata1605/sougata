<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Jobs\ProcessMessage;


class MessageController extends Controller
{
public function store(Request $request)
{
$request->validate([
'sender_id' => 'required|integer',
'message' => 'required|string',
]);


$message = Message::create([
'sender_id' => $request->sender_id,
'message' => $request->message,
]);



ProcessMessage::dispatch($message->id);


return response()->json(['message_id' => $message->id], 201);
}
}