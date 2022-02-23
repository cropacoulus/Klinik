<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'idpasien',
        'namapasien',
        'jk',
        'tanggallahir',
        'nohp',
        'email',
        'alamat'
    ];

    public function rekammedik()
    {
        return $this->hasMany(Rekammedik::class);
    }

    public function resep()
    {
        return $this->hasManyThrough(Resep::class, Rekammedik::class);
    }
}
