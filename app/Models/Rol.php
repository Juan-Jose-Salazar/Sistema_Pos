<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //
    protected $fillable = ['rol_name'];

     public function users()
    {
        return $this->hasMany(Users::class, 'id_rol');
    }

}
