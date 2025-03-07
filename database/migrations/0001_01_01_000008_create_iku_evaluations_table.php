<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIkuEvaluationsTable extends Migration
{
    public function up()
    {
        Schema::create('iku_evaluations', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('iku_id')->unsigned();
            $table->bigInteger('point_id')->unsigned()->nullable();
            $table->integer('year');
            $table->integer('month');
            $table->string('polaritas', 255);
            $table->string('bobot', 500);
            $table->string('satuan', 255);
            $table->string('base', 255);
            $table->decimal('target_bulan_ini', 10, 2)->nullable();
            $table->decimal('target_sdbulan_ini', 10, 2)->nullable();
            $table->decimal('realisasi_bulan_ini', 10, 2)->nullable();
            $table->decimal('realisasi_sdbulan_ini', 10, 2)->nullable();
            $table->string('percent_target', 10)->nullable();
            $table->string('percent_year', 10)->nullable();
            $table->decimal('ttl', 5, 2)->nullable();
            $table->decimal('adj', 5, 2)->nullable();
            $table->text('penyebab_tidak_tercapai')->nullable();
            $table->text('program_kerja')->nullable();
            $table->timestamps(); // Automatically adds created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('iku_evaluations');
    }
}
