<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSasaranStrategisTable extends Migration
{
    public function up()
    {
        Schema::create('sasaran_strategis', function (Blueprint $table) {
            $table->increments('id'); // Auto-increment primary key (integer)
            $table->string('kontrak_id', 10);
            $table->text('name');
            $table->integer('position')->default(0); // Default value for position is 0
            $table->timestamps(); // Automatically adds created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('sasaran_strategis');
    }
}
