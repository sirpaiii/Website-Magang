<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    public function perusahaan()
{
    return $this->hasOne(Perusahaan::class, 'user_id');
}

    public function mahasiswa()
{
    return $this->hasOne(Mahasiswa::class, 'user_id');
}


}
