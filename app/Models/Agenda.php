<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class agenda extends Model
{
    protected $table = 'agenda'; // explicitly tell Laravel the correct table
    protected $fillable = [
        'id', // Assuming you want to set the ID manually
        'nama_agenda',
        'foto_cover',
        'narasi',
    ];
    
    public function lampiran()
    {
        return $this->hasMany(agenda_lampiran::class, 'id_agenda', 'id');
    }
}
