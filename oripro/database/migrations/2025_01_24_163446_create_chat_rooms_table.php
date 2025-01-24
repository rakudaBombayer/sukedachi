<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatRoomsTable extends Migration
{
    public function up()
    {
        Schema::create('chat_rooms', function (Blueprint $table) {
            $table->id('chat_room_ID');
            $table->foreignId('user_ID')->constrained('users', 'user_ID');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chat_rooms');
    }
};