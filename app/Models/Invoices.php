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

    public function orderRelation()
    {
        return $this->belongsTo(Order::class, 'order');
    }

    public function cashierRelation()
     {
        return $this->belongsTo(User::class, 'cashier');
    }
}