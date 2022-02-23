<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $fillable = [
        'idresep',
        'rekammedik_id',
        'obat_id',
        'tanggalresep',
        'dosis',
        'status'
    ];

    public function rekammedik()
    {
        return $this->belongsTo(Rekammedik::class);
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}
