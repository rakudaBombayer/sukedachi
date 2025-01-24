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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id('applicant_ID'); 
            $table->unsignedBigInteger('user_ID'); 
            $table->unsignedBigInteger('request_ID'); 
            $table->foreign('user_ID')->references('user_ID')->on('users'); $table->foreign('request_ID')->references('request_ID')->on('requests')
        }
    );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};