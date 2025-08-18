<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $table = 'info'; // explicitly tell Laravel the correct table
    protected $fillable = [
        'id', // Assuming you want to set the ID manually
        'info',
        'update_at',
    ];
}
