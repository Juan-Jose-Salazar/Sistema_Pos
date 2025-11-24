<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductsCategorys;
use App\Models\OrdersDetails;

class Products extends Model
{
    protected $fillable = ['product_name', 'price', 'category_id'];

     public function products_categorys()
    {
        return $this->belongsTo(ProductsCategorys::class, 'category_id');
    }

    public function OrderDetail(){
        return $this->hasMany(OrdersDetails::class, 'product');
    }
}
