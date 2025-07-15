<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;

    protected $fillable = ['perusahaan_id', 'judul', 'deskripsi_lowongan', 'lokasi'];

    public function perusahaan()
    {
         return $this->belongsTo(Perusahaan::class, 'perusahaan_id');
    }

    public function lamarans() {
    return $this->hasMany(Lamaran::class);
    }


}