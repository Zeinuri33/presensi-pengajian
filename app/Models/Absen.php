<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    //
    protected $fillable = ['kepalakamar_id', 'tanggal', 'jam'];

    public function kepalakamar()
    {
        return $this->belongsTo(Kepalakamar::class);
    }
}
