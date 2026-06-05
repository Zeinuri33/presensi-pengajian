<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kepalakamar extends Model
{
    //
    protected $table = 'kepalakamars';
    protected $guarded = ['id'];

    public function asrama()
    {
        return $this->belongsTo(Asrama::class);
    }

    public function pembinaan()
    {
        return $this->hasMany(Pembinaan::class);
    }

    // relasi ke absensi
    public function absens()
    {
        return $this->hasMany(Absen::class, 'kepalakamar_id');
    }


}
