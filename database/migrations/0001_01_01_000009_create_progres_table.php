<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgresTable extends Migration
{
    public function up()
    {
        Schema::create('progres', function (Blueprint $table) {
            $table->bigIncrements('id'); // Use bigIncrements for big integer primary key
            $table->string('iku_id', 500);
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->enum('status', ['pending', 'accept', 'reject'])->default('pending');
            $table->boolean('need_discussion')->default(false);
            $table->date('meeting_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('created_at')->useCurrent(); // Automatically set current timestamp
        });
    }

    public function down()
    {
        Schema::dropIfExists('progres');
    }
}
