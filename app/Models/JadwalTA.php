<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTA extends Model
{
    use HasFactory;

    protected $table = 'jadwal_ta';

    protected $guarded;

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
