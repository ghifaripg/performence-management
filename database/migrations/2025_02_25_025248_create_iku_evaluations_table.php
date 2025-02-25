<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('iku_evaluations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('iku_id');
            $table->string('point_id')->nullable(); // Sub-point ID (if applicable)
            $table->integer('year');
            $table->integer('month');
            $table->string('polaritas');
            $table->decimal('bobot', 5, 2);
            $table->string('satuan');
            $table->decimal('base', 10, 2);
            $table->decimal('target_bulan_ini', 10, 2)->nullable();
            $table->decimal('target_sdbulan_ini', 10, 2)->nullable();
            $table->decimal('realisasi_bulan_ini', 10, 2)->nullable();
            $table->decimal('realisasi_sdbulan_ini', 10, 2)->nullable();
            $table->decimal('percent_target', 5, 2)->nullable();
            $table->decimal('percent_year', 5, 2)->nullable();
            $table->decimal('ttl', 5, 2)->nullable();
            $table->decimal('adj', 5, 2)->nullable();
            $table->text('penyebab_tidak_tercapai')->nullable();
            $table->text('program_kerja')->nullable();
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('iku_evaluations');
    }
};

