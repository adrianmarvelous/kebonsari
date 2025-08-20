<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class agenda_lampiran extends Model
{
    protected $table = 'agenda_lampiran'; // explicitly tell Laravel the correct table
    protected $fillable = [
        'id', // Assuming you want to set the ID manually
        'id_agenda',
        'file',
    ];
    
    public function agenda()
    {
        return $this->belongsTo(Agenda::class, 'id_agenda', 'id');
    }
}
