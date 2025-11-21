<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersDetails extends Model
{
    protected $table = 'orders_details';
    protected $fillable = [
        'order',
        'product',
        'amount',
        'unit_price',

    ];

    public function order(){
        return $this->belongsTo(Order::class,'order');
    }

    public function product(){
        return $this->belongsTo(Products::class,'product');
    }
}
