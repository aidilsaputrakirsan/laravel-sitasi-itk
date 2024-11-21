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
        Schema::create('riwayat_pendaftaran_sidang_ta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuan_ta_id');
            $table->unsignedBigInteger('sidang_ta_id');
            $table->unsignedBigInteger('user_id');
            $table->string('riwayat');
            $table->string('keterangan')->nullable();
            $table->string('status');
            $table->foreign('pengajuan_ta_id')->references('id')->on('pengajuan_ta')->onDelete('cascade');
            $table->foreign('sidang_ta_id')->references('id')->on('sidang_ta')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pendaftaran_sidang_t_a_s');
    }
};
