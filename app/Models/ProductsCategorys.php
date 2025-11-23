<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductsCategorys extends Model
{
    // Asegúrate que coincida con el nombre real de tu tabla
    protected $table = 'products_categorys';

    protected $fillable = ['category_name'];

    public function products()
    {
        // Ajusta 'id_category' si tu FK en products se llama distinto
        return $this->hasMany(Product::class, 'id_category');
    }
}
