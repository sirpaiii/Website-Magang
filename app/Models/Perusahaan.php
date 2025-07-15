<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nama_perusahaan', 'alamat', 'profil_perusahaan'];

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

    public function lowongans()
    {
        return $this->hasMany(Lowongan::class);
    }

}
