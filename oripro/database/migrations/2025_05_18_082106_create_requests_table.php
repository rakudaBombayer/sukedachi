<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id('request_ID');
            $table->foreignId('user_ID')->constrained('users', 'user_ID');
            $table->foreignId('help_category_ID')->constrained('help_categories', 'help_category_ID');
            $table->string('title', 50)->nullable(false);
            $table->date('requested_date')->nullable(false);
            $table->foreignId('image_ID')->nullable()->constrained('images', 'image_ID');
            $table->integer('estimated_time')->nullable(false);
            $table->string('general_area', 255)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};