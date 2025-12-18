<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanan'; // explicitly tell Laravel the correct table
    // ✅ Specify fillable fields
    protected $fillable = [
        'id', // Assuming you want to set the ID manually
        'kategori',
        'sektor',
        'nama_layanan',
        'video',
        'poster',
        'created_at',
    ];
    
    public function persyaratan()
    {
        return $this->hasMany(Persyaratan::class, 'id_layanan');
    }
    public function flyer()
    {
        return $this->hasOne(Flyer::class, 'id_layanan');
    }
}
