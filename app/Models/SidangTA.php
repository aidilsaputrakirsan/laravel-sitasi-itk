<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidangTA extends Model
{
    use HasFactory;

    protected $table = 'sidang_ta';
    protected $guarded;

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function penilaianSidang()
    {
        return $this->hasMany(PenilaianSidangTa::class, 'sidang_ta_id');
    }
}
