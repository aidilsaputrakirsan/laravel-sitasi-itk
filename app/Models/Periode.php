<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;

    protected $guarded;

    public function jadwalSempros()
    {
        return $this->hasMany(JadwalSempro::class, 'periode_id');
    }

    public function jadwalSidangs()
    {
        return $this->hasMany(JadwalTA::class, 'periode_id');
    }
    
}
