<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'full_name' => 'Administrador General',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'rol_id' => 1, // Administrador
            'estado' => 'Activo',
        ]);
    }
}
