<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Campos que se pueden llenar desde formularios
    protected $fillable = [
        'product_name',
        'price',
        'category_id',
    ];

    // Relación: un producto pertenece a una categoría
    public function category()
    {
        return $this->belongsTo(ProductsCategorys::class, 'category_id');
    }
}
