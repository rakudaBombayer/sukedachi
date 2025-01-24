<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id('chat_message_ID');
            $table->foreignId('chat_room_ID')->constrained('chat_rooms', 'chat_room_ID');
            $table->foreignId('user_ID')->constrained('users', 'user_ID');
            $table->text('text'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chat_messages');
    }
};