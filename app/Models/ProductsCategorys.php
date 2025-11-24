<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class ProductsCategorys extends Model
{
    // Asegúrate que coincida con el nombre real de tu tabla
    protected $table = 'products_categorys';

    protected $fillable = ['category_name'];

    public function products()
    {
       return $this->hasMany(Products::class, 'category_id');
    }
}
