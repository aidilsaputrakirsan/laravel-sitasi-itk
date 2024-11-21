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
        Schema::create('jadwal_sempros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('periode_id');
            $table->unsignedBigInteger('pengajuan_ta_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('penguji_1')->nullable();
            $table->unsignedBigInteger('penguji_2')->nullable();
            $table->date('tanggal_sempro')->nullable();
            $table->string('waktu_mulai')->nullable();
            $table->string('waktu_selesai')->nullable();
            $table->string('ruangan')->nullable();
            $table->timestamps();

            $table->foreign('periode_id')->references('id')->on('periodes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_sempros');
    }
};
