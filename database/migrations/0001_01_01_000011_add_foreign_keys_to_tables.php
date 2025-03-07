<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTables extends Migration
{
    public function up()
    {
        // Adding constraints for `form_iku` table
        Schema::table('form_iku', function (Blueprint $table) {
            $table->foreign('iku_id')->references('iku_id')->on('iku')->onDelete('cascade');
            $table->foreign('sasaran_id')->references('id')->on('sasaran_strategis')->onDelete('cascade');
            $table->foreign('isi_iku_id')->references('id')->on('isi_iku')->onDelete('cascade');
        });

        // Adding constraints for `form_kontrak_manajemen` table
        Schema::table('form_kontrak_manajemen', function (Blueprint $table) {
            $table->foreign('sasaran_id')->references('id')->on('sasaran_strategis')->onDelete('cascade');
        });

        // Adding constraints for `iku` table
        Schema::table('iku', function (Blueprint $table) {
            $table->foreign('created_by')->references('nama')->on('users')->onDelete('cascade');
        });

        // Adding constraints for `iku_evaluations` table
        Schema::table('iku_evaluations', function (Blueprint $table) {
            $table->foreign('iku_id')->references('id')->on('form_iku')->onDelete('cascade');
            $table->foreign('point_id')->references('id')->on('iku_point')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Adding constraints for `iku_point` table
        Schema::table('iku_point', function (Blueprint $table) {
            $table->foreign('form_iku_id')->references('id')->on('form_iku')->onDelete('cascade');
        });

        // Adding constraints for `progres` table
        Schema::table('progres', function (Blueprint $table) {
            $table->foreign('iku_id')->references('iku_id')->on('iku')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Adding constraints for `sasaran_strategis` table
        Schema::table('sasaran_strategis', function (Blueprint $table) {
            $table->foreign('kontrak_id')->references('kontrak_id')->on('kontrak_manajemen')->onDelete('cascade');
        });

        // Adding constraints for `users` table
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('department_id')->references('department_id')->on('department')->onDelete('cascade');
        });
    }

    public function down()
    {
        // Dropping foreign key constraints
        Schema::table('form_iku', function (Blueprint $table) {
            $table->dropForeign(['iku_id']);
            $table->dropForeign(['sasaran_id']);
            $table->dropForeign(['isi_iku_id']);
        });

        Schema::table('form_kontrak_manajemen', function (Blueprint $table) {
            $table->dropForeign(['sasaran_id']);
        });

        Schema::table('iku', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
        });

        Schema::table('iku_evaluations', function (Blueprint $table) {
            $table->dropForeign(['iku_id']);
            $table->dropForeign(['point_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::table('iku_point', function (Blueprint $table) {
            $table->dropForeign(['form_iku_id']);
        });

        Schema::table('progres', function (Blueprint $table) {
            $table->dropForeign(['iku_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::table('sasaran_strategis', function (Blueprint $table) {
            $table->dropForeign(['kontrak_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
        });
    }
}
