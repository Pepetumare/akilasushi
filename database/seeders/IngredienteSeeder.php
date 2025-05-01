<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredienteSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('ingredientes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $ingredientes = [
            ['nombre' => 'Camarón', 'tipo' => 'proteina', 'precio_base' => 1000, 'se_repite' => true, 'mostrar' => true, 'precio_repeticion' => 1000],
            ['nombre' => 'Pollo', 'tipo' => 'proteina', 'precio_base' => 1000, 'se_repite' => true, 'mostrar' => true, 'precio_repeticion' => 1000],
            ['nombre' => 'Kanikama', 'tipo' => 'proteina', 'precio_base' => 1000, 'se_repite' => true, 'mostrar' => true, 'precio_repeticion' => 1000],
            ['nombre' => 'Choclo', 'tipo' => 'proteina', 'precio_base' => 1000, 'se_repite' => true, 'mostrar' => true, 'precio_repeticion' => 1000],
            ['nombre' => 'Palmitos', 'tipo' => 'proteina', 'precio_base' => 1000, 'se_repite' => true, 'mostrar' => true, 'precio_repeticion' => 1000],
            ['nombre' => 'Palta', 'tipo' => 'proteina', 'precio_base' => 1000, 'se_repite' => true, 'mostrar' => true, 'precio_repeticion' => 1000],
            ['nombre' => 'Champiñones', 'tipo' => 'proteina', 'precio_base' => 1000, 'se_repite' => true, 'mostrar' => true, 'precio_repeticion' => 1000],
            ['nombre' => 'Salmón', 'tipo' => 'proteina', 'precio_base' => 2000, 'se_repite' => false, 'mostrar' => true, 'precio_repeticion' => 0],
            ['nombre' => 'Carne', 'tipo' => 'proteina', 'precio_base' => 2000, 'se_repite' => true, 'mostrar' => true, 'precio_repeticion' => 1000],
            ['nombre' => 'Pollo Apanado', 'tipo' => 'proteina', 'precio_base' => 1500, 'se_repite' => true, 'mostrar' => true, 'precio_repeticion' => 1000],
            ['nombre' => 'Camarón Apanado', 'tipo' => 'proteina', 'precio_base' => 1500, 'se_repite' => true, 'mostrar' => true, 'precio_repeticion' => 1000],
            ['nombre' => 'Queso Crema', 'tipo' => 'base', 'precio_base' => 0, 'se_repite' => false, 'mostrar' => false, 'precio_repeticion' => 0],
            ['nombre' => 'Cebollín', 'tipo' => 'base', 'precio_base' => 0, 'se_repite' => false, 'mostrar' => false, 'precio_repeticion' => 0],
            ['nombre' => 'Jamón Serrano', 'tipo' => 'envoltura', 'precio_base' => 0, 'se_repite' => false, 'mostrar' => false, 'precio_repeticion' => 0],
            ['nombre' => 'Salmón Ahumado', 'tipo' => 'extra', 'precio_base' => 0, 'se_repite' => true, 'mostrar' => true, 'precio_repeticion' => 1000],
        ];

        DB::table('ingredientes')->insert($ingredientes);
    }
}
