<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\Translator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $casts = [
        'data' => 'array'
    ];

    protected $guarded;

    public function from()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    public function to()
    {
        return $this->belongsTo(User::class, 'to_id');
    }

    public function displayTime()
    {
        $createdAt = Carbon::parse($this->created_at);
        $now = Carbon::now();

        $lang = 'en';
        $translation = Translator::get($lang);
        $translation->setTranslations([
            'before' => ':time ago',
            'after' => 'in :time',
        ]);

        return $createdAt->locale($lang)->diffForHumans($now);
    }
}
