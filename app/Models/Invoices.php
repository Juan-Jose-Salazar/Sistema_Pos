<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    protected $fillable = [
        'date',
        'total',
        'order',
        'cashier'
    ];

    public function order(){
        return $this-> belongsTo(Order::class, 'order');
    }

    public function cashier(){
        return $this-> belongsTo(Users::class,'cashier');
    }
}
