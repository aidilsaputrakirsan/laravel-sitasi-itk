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
        Schema::create('pengajuan_ta', function (Blueprint $table) {
            $table->id();
            $table->longText('judul');
            $table->string('bidang_penelitian')->nullable();
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('pembimbing_1');
            $table->unsignedBigInteger('pembimbing_2');
            $table->string('status');
            $table->boolean('approve_pembimbing1')->default(false);
            $table->boolean('approve_pembimbing2')->default(false);
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_ta');
    }
};
