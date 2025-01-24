<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('help_categories', function (Blueprint $table) {
            $table->id('help_category_ID');
            $table->string('help_name', 100);
            $table->text('help_details');
        });
    }

    public function down()
    {
        Schema::dropIfExists('help_categories');
    }
};