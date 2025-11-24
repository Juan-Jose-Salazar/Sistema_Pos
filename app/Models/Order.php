<?php

namespace App\Models;

use App\Models\Clients;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
     protected $fillable = [
        'date',
        'estado',
        'client',
        'waiter',
    ];

    public function client(){
        return $this->belongsTo(Clients::class, 'client');
    }

    public function waiter(){
        return $this->belongsTo(User::class,'waiter');
    }

    public function details(){
        return $this->hasMany(OrdersDetails::class, 'order','id');
    }

    public function invoice(){
        return $this->hasOne(Invoices::class, 'order');
    }
}
