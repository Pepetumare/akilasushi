<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredienteSeeder extends Seeder
{
    public function run(): void
    {
        $ingredientes = [
            // Bases
            ['nombre' => 'Queso Crema', 'tipo' => 'base', 'precio' => 0],
            ['nombre' => 'Cebollín', 'tipo' => 'base', 'precio' => 0],

            // Proteínas
            ['nombre' => 'Salmón', 'tipo' => 'proteina', 'precio' => 2000],
            ['nombre' => 'Atún', 'tipo' => 'proteina', 'precio' => 1000],
            ['nombre' => 'Pollo Apanado', 'tipo' => 'proteina', 'precio' => 1000],
            ['nombre' => 'Kanikama', 'tipo' => 'proteina', 'precio' => 1000],
            ['nombre' => 'Camarón', 'tipo' => 'proteina', 'precio' => 1500],
            ['nombre' => 'Carne', 'tipo' => 'proteina', 'precio' => 1500],

            // Vegetales
            ['nombre' => 'Palta', 'tipo' => 'vegetal', 'precio' => 1000],
            ['nombre' => 'Champiñón', 'tipo' => 'vegetal', 'precio' => 1000],
            ['nombre' => 'Palmito', 'tipo' => 'vegetal', 'precio' => 1000],
            ['nombre' => 'Choclo', 'tipo' => 'vegetal', 'precio' => 1000],
            ['nombre' => 'Pepino', 'tipo' => 'vegetal', 'precio' => 1000],
            ['nombre' => 'Morrón', 'tipo' => 'vegetal', 'precio' => 1000],

            // Envolturas
            ['nombre' => 'Sésamo', 'tipo' => 'envoltura', 'precio' => 0],
            ['nombre' => 'Ciboullete', 'tipo' => 'envoltura', 'precio' => 0],
            ['nombre' => 'Palta', 'tipo' => 'envoltura', 'precio' => 1000],
            ['nombre' => 'Queso Crema', 'tipo' => 'envoltura', 'precio' => 1000],
            ['nombre' => 'Panko', 'tipo' => 'envoltura', 'precio' => 500],
        ];

        DB::table('ingredientes')->insert($ingredientes);
    }
}
