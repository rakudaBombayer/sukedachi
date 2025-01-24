<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id('request_ID');
            $table->foreignId('user_ID')->constrained('users', 'user_ID');
            $table->foreignId('help_category_ID')->constrained('help_categories', 'help_category_ID');
            $table->string('title', 50);
            $table->date('requested_date');
            $table->foreignId('image_ID')->nullable()->constrained('images', 'image_ID');
            $table->foreignId('payment_ID')->nullable()->constrained('payments', 'payment_ID');
            $table->string('payment_method', 20);
            $table->integer('estimated_time');
            $table->string('general_area', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('requests');
    }
};