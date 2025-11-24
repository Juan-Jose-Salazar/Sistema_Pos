<?php

namespace App\Models;

use App\Models\products;
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

    public function productRelation(){
        return $this->belongsTo(Products::class,'product');
    }
}
