<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kegiatan extends Model
{
    //
    use HasFactory;

    protected $fillable = ['kegiatan', 'tempat', 'tanggal', 'waktu', 'batasabsen', 'peserta', 'lingkup'];

    public function presensis()
    {
        return $this->hasMany(Presensi::class);
    }

}
