<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Products::create([
            'nombre' => 'Café',
            'precio' => 5000,
            'categoria_id' => 1
        ]);

        Products::create([
            'nombre' => 'Empanada',
            'precio' => 2500,
            'categoria_id' => 2
        ]);
    }
}
