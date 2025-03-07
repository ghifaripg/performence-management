<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormIkuAndRelatedTables extends Migration
{
    public function up()
    {
        // Create form_iku table
        Schema::create('form_iku', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('iku_id', 500);
            $table->integer('sasaran_id');
            $table->string('iku_atasan', 500)->nullable();
            $table->bigInteger('isi_iku_id')->unsigned();
            $table->string('target', 500)->nullable();
            $table->boolean('is_multi_point')->default(0);
            $table->string('base', 500)->nullable();
            $table->string('stretch', 500)->nullable();
            $table->string('satuan', 500)->nullable();
            $table->string('polaritas', 50)->nullable();
            $table->decimal('bobot', 10, 2)->nullable();
            $table->timestamps(); // Timestamps for created_at and updated_at columns
        });

        // Create iku_point table
        Schema::create('iku_point', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('form_iku_id')->unsigned(); // Foreign key to form_iku
            $table->string('point_name', 500);
            $table->string('base', 500)->nullable();
            $table->string('stretch', 500)->nullable();
            $table->string('satuan', 500)->nullable();
            $table->string('polaritas', 50)->nullable();
            $table->decimal('bobot', 10, 2)->nullable();
            $table->timestamps();

            // Add foreign key constraint (assuming form_iku_id refers to form_iku.id)
            $table->foreign('form_iku_id')->references('id')->on('form_iku')->onDelete('cascade');
        });

        // Create isi_iku table
        Schema::create('isi_iku', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('iku', 500);
            $table->text('proker');
            $table->string('pj', 500);
            $table->timestamps();
        });

        // Create iku table
        Schema::create('iku', function (Blueprint $table) {
            $table->string('iku_id', 500);
            $table->string('department_name', 500);
            $table->bigInteger('tahun');
            $table->string('created_by', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        // Drop tables in reverse order
        Schema::dropIfExists('iku');
        Schema::dropIfExists('isi_iku');
        Schema::dropIfExists('iku_point');
        Schema::dropIfExists('form_iku');
    }
}
