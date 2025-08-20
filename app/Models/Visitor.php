<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $table = 'visitors';

    protected $fillable = [
        'nama',
        'alamat',
        'id_layanan',
        'klik_app',
    ];

    // If you only want created_at (no updated_at):
    const UPDATED_AT = null;

    
    public function layanan()
    {
        return $this->hasOne(Layanan::class, 'id');
    }
}
