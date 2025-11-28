<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
public function up()
{
Schema::create('messages', function (Blueprint $table) {
$table->id();
$table->unsignedBigInteger('sender_id');
$table->text('message');
$table->json('metadata')->nullable();
$table->timestamp('processed_at')->nullable();
$table->timestamps();
});
}


public function down()
{
Schema::dropIfExists('messages');
}
}
