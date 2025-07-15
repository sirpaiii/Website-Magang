<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
     use HasFactory;
    protected $fillable = ['user_id', 'nama_mhs', 'nim', 'jurusan', 'univ', 'no_hp', 'alamat', 'foto', 'cv'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function lamarans() {
    return $this->hasMany(Lamaran::class);
}

    

}
