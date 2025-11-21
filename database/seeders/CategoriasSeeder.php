<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductsCategorys;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProdcutsCategorys::create(['category_name' => 'Bebidas']);
        ProductsCategorys::create(['category_name' => 'Comidas']);
        ProductsCategorys::create(['category_name' => 'Postres']);
    }
}
