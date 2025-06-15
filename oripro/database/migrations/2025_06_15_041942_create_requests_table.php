<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('request_ID'); // プライマリーキー
            $table->unsignedInteger('user_ID'); // 外部キー
            $table->unsignedInteger('help_category_ID')->notNull();
            $table->text('help_details')->notNull();
            $table->string('title', 50)->notNull();
            $table->date('requested_date')->notNull();
            $table->unsignedInteger('image_ID')->nullable(); // 画像の外部キー（NULL可）
            $table->unsignedInteger('estimated_time')->notNull();
            $table->string('general_area', 255)->notNull();
            $table->timestamps(); // created_at & updated_at

            // 外部キー制約
            $table->foreign('user_ID')->references('user_ID')->on('users')->onDelete('cascade');
            $table->foreign('image_ID')->references('image_ID')->on('images')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};