<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = ['kegiatan_id', 'nokartu', 'waktu_absen'];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function kepalakamar()
    {
        return $this->belongsTo(Kepalakamar::class, 'nokartu', 'nokartu');
    }
}
