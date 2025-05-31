<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_ID');
            $table->string('nickname', 50)->nullable(false);
            $table->string('profile_image', 255)->nullable();
            $table->text('address')->nullable(false);
            $table->string('email', 100)->nullable(false)->unique();
            $table->text('self_introduction')->nullable(false);
            $table->string('password')->nullable(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

$table->foreignId('image_ID')->nullable()->constrained('images', 'imageID');