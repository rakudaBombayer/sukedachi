<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->increments('message_ID'); // プライマリーキー
            $table->unsignedInteger('chat_room_ID'); // 外部キー
            $table->unsignedInteger('user_ID'); // 外部キー
            $table->text('text')->notNull(); // メッセージ内容（必須）
            $table->timestamps(); // created_at & updated_at 自動生成

            // 外部キー制約
            $table->foreign('chat_room_ID')->references('chat_room_ID')->on('chat_rooms')->onDelete('cascade');
            $table->foreign('user_ID')->references('user_ID')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};