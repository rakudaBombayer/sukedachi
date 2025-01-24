<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_ID'); // PRIMARY KEY 制約が自動的に適用されます
            $table->string('nickname', 50)->unique();
            $table->string('profile_image', 255)->nullable();
            $table->text('address');
            $table->string('email', 100)->unique();
            $table->text('self_introduction');
            $table->string('password');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}