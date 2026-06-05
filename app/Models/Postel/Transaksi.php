<?php

namespace App\Models\Postel;

use App\Models\Kepalakamar;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //
    protected $table = 'transaksis';
    protected $guarded = ['id'];

    // Relasi: satu Asrama memiliki banyak KepalaKamar
    public function kepalakamar()
    {
        return $this->belongsTo(Kepalakamar::class);
    }
}
