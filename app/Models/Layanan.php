<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanan'; // explicitly tell Laravel the correct table
    
    public function persyaratan()
    {
        return $this->hasMany(Persyaratan::class, 'id_layanan');
    }
}
