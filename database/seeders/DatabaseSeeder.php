<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         Usuario::create([
             'usuario' => 'admin',
             'password' => Hash::make('admin'),
             'perfil' => 'administrador'
         ]);
    }
}
