<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablesAddIndexesAndAutoIncrement extends Migration
{
    public function up()
    {
        // Adding primary keys and indexes for `form_iku` table
        Schema::table('form_iku', function (Blueprint $table) {
            $table->primary('id');
            $table->index('iku_id');
            $table->index('sasaran_id');
            $table->index('isi_iku_id');
        });

        // Adding primary keys and indexes for `form_kontrak_manajemen` table
        Schema::table('form_kontrak_manajemen', function (Blueprint $table) {
            $table->primary('id');
            $table->index('sasaran_id');
        });

        // Adding primary keys and indexes for `iku` table
        Schema::table('iku', function (Blueprint $table) {
            $table->primary('iku_id');
            $table->index('created_by');
        });

        // Adding primary keys and indexes for `iku_evaluations` table
        Schema::table('iku_evaluations', function (Blueprint $table) {
            $table->primary('id');
            $table->index('user_id');
            $table->index('iku_id');
            $table->index('point_id');
        });

        // Adding primary keys and indexes for `iku_point` table
        Schema::table('iku_point', function (Blueprint $table) {
            $table->primary('id');
            $table->index('form_iku_id');
        });

        // Adding primary key for `isi_iku` table
        Schema::table('isi_iku', function (Blueprint $table) {
            $table->primary('id');
        });

        // Adding primary key for `kontrak_manajemen` table
        Schema::table('kontrak_manajemen', function (Blueprint $table) {
            $table->primary('kontrak_id');
        });

        // Adding primary key for `migrations` table
        Schema::table('migrations', function (Blueprint $table) {
            $table->primary('id');
        });

        // Adding primary keys and indexes for `progres` table
        Schema::table('progres', function (Blueprint $table) {
            $table->primary('id');
            $table->index('iku_id');
            $table->index('user_id');
        });

        // Adding primary keys and indexes for `sasaran_strategis` table
        Schema::table('sasaran_strategis', function (Blueprint $table) {
            $table->primary('id');
            $table->index('kontrak_id');
        });

        // Adding primary keys and indexes for `users` table
        Schema::table('users', function (Blueprint $table) {
            $table->primary('id');
            $table->unique('nama');
            $table->index('department_id');
        });

        // Modifying columns for auto-increment
        Schema::table('department', function (Blueprint $table) {
            $table->bigIncrements('department_id')->unsigned()->change();
        });

        Schema::table('form_iku', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->change();
        });

        Schema::table('form_kontrak_manajemen', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->change();
        });

        Schema::table('iku_evaluations', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->change();
        });

        Schema::table('iku_point', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->change();
        });

        Schema::table('isi_iku', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->change();
        });

        Schema::table('progres', function (Blueprint $table) {
            $table->bigIncrements('id')->change();
        });

        Schema::table('sasaran_strategis', function (Blueprint $table) {
            $table->increments('id')->change();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->change();
        });
    }

    public function down()
    {
        // Drop indexes and modify columns back to previous state
        Schema::table('form_iku', function (Blueprint $table) {
            $table->dropPrimary();
            $table->dropIndex(['iku_id', 'sasaran_id', 'isi_iku_id']);
        });

        Schema::table('form_kontrak_manajemen', function (Blueprint $table) {
            $table->dropPrimary();
            $table->dropIndex(['sasaran_id']);
        });

        Schema::table('iku', function (Blueprint $table) {
            $table->dropPrimary();
            $table->dropIndex(['created_by']);
        });

        Schema::table('iku_evaluations', function (Blueprint $table) {
            $table->dropPrimary();
            $table->dropIndex(['user_id', 'iku_id', 'point_id']);
        });

        Schema::table('iku_point', function (Blueprint $table) {
            $table->dropPrimary();
            $table->dropIndex(['form_iku_id']);
        });

        Schema::table('isi_iku', function (Blueprint $table) {
            $table->dropPrimary();
        });

        Schema::table('kontrak_manajemen', function (Blueprint $table) {
            $table->dropPrimary();
        });

        Schema::table('migrations', function (Blueprint $table) {
            $table->dropPrimary();
        });

        Schema::table('progres', function (Blueprint $table) {
            $table->dropPrimary();
            $table->dropIndex(['iku_id', 'user_id']);
        });

        Schema::table('sasaran_strategis', function (Blueprint $table) {
            $table->dropPrimary();
            $table->dropIndex(['kontrak_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropPrimary();
            $table->dropUnique(['nama']);
            $table->dropIndex(['department_id']);
        });

        // Reverting AUTO_INCREMENT changes back to original state
        Schema::table('department', function (Blueprint $table) {
            $table->bigInteger('department_id')->unsigned()->change();
        });

        Schema::table('form_iku', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->change();
        });

        Schema::table('form_kontrak_manajemen', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->change();
        });

        Schema::table('iku_evaluations', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->change();
        });

        Schema::table('iku_point', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->change();
        });

        Schema::table('isi_iku', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->change();
        });

        Schema::table('progres', function (Blueprint $table) {
            $table->bigInteger('id')->change();
        });

        Schema::table('sasaran_strategis', function (Blueprint $table) {
            $table->integer('id')->change();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->change();
        });
    }
}
