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
        Schema::create('penilaian_sidang_tas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sidang_ta_id');
            $table->unsignedBigInteger('user_id');
            $table->double('media_presentasi')->default(0);
            $table->double('komunikasi')->default(0);
            $table->double('penguasaan_materi')->default(0);
            $table->double('isi_laporan_ta')->default(0);
            $table->double('struktur_penulisan')->default(0);
            $table->double('sikap_kinerja')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_sidang_tas');
    }
};
