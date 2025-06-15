<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->increments('applicant_ID'); // プライマリーキー
            $table->unsignedInteger('user_ID'); // 外部キー
            $table->unsignedInteger('request_ID'); // 外部キー
            $table->timestamps(); // created_at & updated_at 自動生成

            // 外部キー制約
            $table->foreign('user_ID')->references('user_ID')->on('users')->onDelete('cascade');
            $table->foreign('request_ID')->references('request_ID')->on('requests')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};