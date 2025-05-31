<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id('message_ID');
            $table->unsignedInteger('chat_room_ID');
            $table->foreign('chat_room_ID')->references('chat_room_ID')->on('chat_rooms')->onDelete('cascade'); 
            $table->foreignId('user_ID')->constrained('users', 'user_ID');
            $table->text('text')->nullable(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};