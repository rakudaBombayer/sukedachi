<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chat_rooms', function (Blueprint $table) {
            $table->integer('chat_room_ID')->unsigned()->primary(); 
            $table->foreignId('requester_ID')->constrained('requests', 'request_ID');
            $table->foreignId('user_ID')->constrained('users', 'user_ID');
            $table->boolean('isOpen')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_rooms');
    }
};