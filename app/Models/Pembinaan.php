<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembinaan extends Model
{
    //
    protected $fillable = ['kepalakamar_id', 'tanggal', 'keterangan'];

    public function kepalakamar()
    {
        return $this->belongsTo(Kepalakamar::class);
    }
}
