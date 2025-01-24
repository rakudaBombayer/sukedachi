<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id('image_ID');
            $table->string('image', 255)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('images');
    }
};