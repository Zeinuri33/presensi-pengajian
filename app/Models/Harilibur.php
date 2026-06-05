<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Harilibur extends Model
{
    //
    protected $table = 'hariliburs';

    protected $fillable = ['mulai', 'sampai', 'keterangan'];
}
