<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Katalog extends Model
{
    use HasFactory;
    
    protected $guarded;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sidangTA()
    {
        return $this->belongsTo(SidangTA::class, 'sidang_ta_id');
    }

    // Scope untuk katalog yang dibuat admin
    public function scopeByAdmin($query)
    {
        return $query->where('created_by', 'admin');
    }

    // Scope untuk katalog yang dibuat mahasiswa
    public function scopeByMahasiswa($query)
    {
        return $query->where('created_by', 'mahasiswa');
    }

    // Scope untuk katalog yang sudah diapprove
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }
}