<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanTA extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_ta';
    protected $guarded;

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function pembimbing1()
    {
        return $this->belongsTo(User::class, 'pembimbing_1');
    }

    public function pembimbing2()
    {
        return $this->belongsTo(User::class, 'pembimbing_2');
    }

    public function riwayatPengajuan()
    {
        return $this->hasOne(RiwayatPengajuan::class, 'pengajuan_ta_id');
    }

    public function riwayatPengajuans()
    {
        return $this->hasMany(RiwayatPengajuan::class, 'pengajuan_ta_id');
    }

    public function jadwal()
    {
        return $this->hasOne(JadwalSempro::class, 'pengajuan_ta_id');
    }

    public function jadwalTa()
    {
        return $this->hasOne(JadwalTA::class, 'pengajuan_ta_id');
    }

    public function notif()
    {
        return Notifikasi::where('data->pengajuan_id', $this->id)->get();
    }
}
