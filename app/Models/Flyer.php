<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flyer extends Model
{
    protected $table = 'flyer'; // explicitly tell Laravel the correct table

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan');
    }
}
