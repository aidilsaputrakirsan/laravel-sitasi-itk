<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'nim',
        'telpon',
        'judul_ta',
        'signature',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'user_id');
    }

    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'user_id');
    }

    public function isDosen()
    {
        return $this->hasRole('dosen');
    }

    public function isMahasiswa()
    {
        return $this->hasRole('mahasiswa');
    }

    public function isTendik()
    {
        return $this->hasRole('tendik');
    }

    public function isKoorpro()
    {
        return $this->hasRole('koorpro');
    }

    public function sempro()
    {
        return $this->hasOne(Sempro::class);
    }

    public function sidang()
    {
        return $this->hasOne(SidangTA::class);
    }
    public function katalog()
    {
        return $this->hasOne(Katalog::class, 'user_id');
    }

    public function katalogs()
    {
        return $this->hasMany(Katalog::class, 'user_id');
    }

    // Helper method untuk cek kelengkapan revisi sidang TA
    public function hasCompletedSidangRevisi()
    {
        $sidang = $this->sidang()->where('status', 'Diterima')->first();
        
        if (!$sidang) {
            return false;
        }

        return $sidang->revisi_pembimbing_1 && 
               $sidang->revisi_pembimbing_2 && 
               $sidang->revisi_penguji_1 && 
               $sidang->revisi_penguji_2;
    }

    // Helper method untuk cek apakah mahasiswa bisa mengisi katalog
    public function canCreateKatalog()
    {
        return $this->isMahasiswa() && $this->hasCompletedSidangRevisi();
    }
}
