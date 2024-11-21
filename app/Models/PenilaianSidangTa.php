<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianSidangTa extends Model
{
    use HasFactory;

    protected $guarded;

    public function sidang()
    {
        return $this->belongsTo(SidangTA::class, 'sidang_ta_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
