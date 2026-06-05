<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asrama extends Model
{
    //
    protected $table = 'asramas';
    protected $guarded = ['id'];

    // Relasi: satu Asrama memiliki banyak KepalaKamar
    public function kepalakamar()
    {
        return $this->hasMany(Kepalakamar::class);
    }
}
