<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianSempro extends Model
{
    use HasFactory;

    protected $guarded;

    public function sempro()
    {
        return $this->belongsTo(Sempro::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
