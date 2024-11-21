<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalSempro extends Model
{
    use HasFactory;

    protected $guarded;

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function penguji1()
    {
        return $this->belongsTo(User::class, 'penguji_1');
    }

    public function penguji2()
    {
        return $this->belongsTo(User::class, 'penguji_2');
    }
}
