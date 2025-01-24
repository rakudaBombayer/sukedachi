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
        Schema::create('users', function (Blueprint $table) { 
            $table->id('user_ID'); 
            $table->string('nickname', 50); 
            $table->string('profile_image', 255)->nullable(); 
            $table->text('address'); 
            $table->string('email', 100); 
            $table->text('self_introduction'); 
            $table->string('password', 255); $table->timestamps(); });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};