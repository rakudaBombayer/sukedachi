<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_ID'); // プライマリーキー
            $table->string('nickname', 50)->notNull();
            $table->string('profile_image', 255)->nullable(); // プロフィール画像はNULL可
            $table->text('address')->notNull();
            $table->string('email', 100)->notNull()->unique(); // Eメールは一意（ユニーク）
            $table->text('self_introduction')->notNull();
            $table->string('password', 255)->notNull();
            $table->timestamps(); // created_at & updated_at 自動生成
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
