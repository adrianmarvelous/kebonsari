<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $table = 'menus'; // explicitly tell Laravel the correct table
    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'role_to_menu', 'menu_id', 'role_id');
    }
}
