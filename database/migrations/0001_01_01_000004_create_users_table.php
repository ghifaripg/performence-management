<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned(); // Big primary key
            $table->string('nama', 255);
            $table->string('password', 255);
            $table->timestamps(); // Automatically adds created_at and updated_at columns
            $table->string('username', 255);
            $table->bigInteger('department_id')->unsigned()->nullable(); // Nullable department_id
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
