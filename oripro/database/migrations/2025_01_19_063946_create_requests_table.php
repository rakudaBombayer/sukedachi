<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() { 
        Schema::create('requests', function (Blueprint $table) { 
            $table->id('request_ID'); 
            $table->integer('user_ID')->references('user_ID')->on('users'); $table->integer('help_category_ID')->references('help_category_ID')->on('help_categories'); 
            $table->string('title', 50); 
            $table->date('requested_date'); 
            $table->integer('image_ID')->references('imageID')->on('images'); $table->integer('payment_ID')->references('payment_ID')->on('payments'); 
            $table->integer('estimated_time'); 
            $table->string('general_area', 255); 
            $table->timestamps(); }); 
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};