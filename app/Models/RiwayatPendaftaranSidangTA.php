<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPendaftaranSidangTA extends Model
{
    use HasFactory;
    protected $table = 'riwayat_pendaftaran_sidang_ta';
    protected $guarded;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
