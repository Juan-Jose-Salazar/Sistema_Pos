<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rol;


class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rol::create(['rol_name' => 'Administrador']);
        Rol::create(['rol_name' => 'Mesero']);
        Rol::create(['rol_name' => 'Cajero']);
    }
}
