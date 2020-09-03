<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');            
            //$table->id();
            $table->string('name');
            $table->string('google_id');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->enum('role',  ['user', 'manager', 'admin'])->default('user');
            $table->string('avatar')->nullable();
            $table->string('avatar_original')->nullable();
            $table->rememberToken();
            $table->timestamps();
           // $table->timestamp('email_verified_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
