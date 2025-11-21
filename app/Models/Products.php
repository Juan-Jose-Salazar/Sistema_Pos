<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductsCategorys;

class Products extends Model
{
    protected $fillable = ['product_name', 'price', 'category'];

    public function products_categorys(){
        return $this->belongsTo(ProductsCategorys::class, 'category');
    }

    public function OrderDetail(){
        return $this->hasMany(OrdersDetails::class, 'product');
    }
}
