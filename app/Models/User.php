<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Rol;


use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = ['full_name','email','password','estado','id_rol'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function username()
    {
        return 'email';
    }




    public function rol(){
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    public function ordersAsWaiter(){
        return $this->HasMany(Orders::class, 'waiter');
    }

    public function invoicesAsCashier(){
        return $this->hasMany(Invoices::class, 'cashier');
    }
}
