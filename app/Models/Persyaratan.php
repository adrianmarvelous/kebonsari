<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persyaratan extends Model
{
    protected $table = 'persyaratan'; // explicitly tell Laravel the correct table
    protected $fillable = [
        'id', // Assuming you want to set the ID manually
        'id_layanan', // Assuming you want to set the ID manually
        'syarat',
        'created_at',
    ];
}
