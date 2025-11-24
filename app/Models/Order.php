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

    public function clientRelation()
    {
        return $this->belongsTo(Clients::class, 'client');
    }

    public function waiterRelation()
    {
        return $this->belongsTo(User::class,'waiter');
    }

    public function details(){
        return $this->hasMany(OrdersDetails::class, 'order','id');
    }

    public function invoice(){
        return $this->hasOne(Invoices::class, 'order');
    }

     public function getTotalAttribute()
    {
        return $this->calculateTotal();
    }

    public function getIsPaidAttribute()
    {
        return $this->invoice !== null;
    }

    public function calculateTotal(): float
    {
        $details = $this->relationLoaded('details')
            ? $this->details
            : $this->details()->with('product')->get();

        return $details->sum(function ($detail) {
            $amount = $this->normalizeNumber($detail->amount, 1);
            $unitPrice = $this->normalizeNumber(
                $detail->unit_price,
                optional($detail->product)->price ?? 0
            );

            return $amount * $unitPrice;
        });
    }

    private function normalizeNumber($value, $default = 0): float
    {
        if (is_null($value)) {
            return (float) $default;
        }

        if (is_numeric($value)) {
            return (float) $value;
        }

        if (is_string($value)) {
            $cleaned = str_replace(['$', ',', ' '], '', $value);

            if (is_numeric($cleaned)) {
                return (float) $cleaned;
            }
        }

        return (float) $default;
    }
}