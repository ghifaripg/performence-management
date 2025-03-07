<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormKontrakManajemenAndKontrakManajemenTables extends Migration
{
    public function up()
    {
        // Create form_kontrak_manajemen table
        Schema::create('form_kontrak_manajemen', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('sasaran_id');
            $table->string('kpi_name', 255);
            $table->string('target', 255);
            $table->string('satuan', 50);
            $table->string('milestone', 255)->nullable();
            $table->char('esgc', 1)->nullable();
            $table->string('polaritas', 10)->nullable();
            $table->decimal('bobot', 5, 2)->nullable();
            $table->char('du', 1)->nullable();
            $table->char('dk', 1)->nullable();
            $table->char('do', 1)->nullable();
            $table->timestamps(); // Added timestamps for created_at and updated_at columns
        });

        // Create kontrak_manajemen table
        Schema::create('kontrak_manajemen', function (Blueprint $table) {
            $table->string('kontrak_id', 10);
            $table->integer('year');
            $table->timestamps(); // Added timestamps for created_at and updated_at columns
        });
    }

    public function down()
    {
        // Drop tables in reverse order
        Schema::dropIfExists('kontrak_manajemen');
        Schema::dropIfExists('form_kontrak_manajemen');
    }
}
