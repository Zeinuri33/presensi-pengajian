<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Izin extends Model
{
    //
    use HasFactory;

    protected $fillable = ['kepalakamar_id', 'tanggal', 'keterangan'];

    public function kepalakamar()
    {
        return $this->belongsTo(Kepalakamar::class);
    }
}
