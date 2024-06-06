<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id();
            $table->string('no_rekam_medis');
            $table->foreignId('patient_id')->references('id')->on('pasiens')->cascadeOnDelete();
            $table->foreignId('dokter_id')->references('id')->on('dokters')->cascadeOnDelete();
            $table->string('diagnosa');
            $table->bigInteger('harga');
            $table->enum('status',['PEMERIKSAAN','SELESAI']);
            $table->date('regist_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};
