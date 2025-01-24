<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration
{
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id('applicant_ID');
            $table->foreignId('user_ID')->constrained('users', 'user_ID');
            $table->foreignId('request_ID')->constrained('requests', 'request_ID');
        });
    }

    public function down()
    {
        Schema::dropIfExists('applicants');
    }
};