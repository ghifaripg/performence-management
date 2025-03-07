<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('department_id')->unsigned();
            $table->string('department_name', 500);
            $table->string('department_username', 255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
