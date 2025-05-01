<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Hand Rolls', 'slug' => 'hand-rolls'],
            ['nombre' => 'Rolls Especiales', 'slug' => 'rolls-especiales'],
            ['nombre' => 'Combos', 'slug' => 'combos'],
            ['nombre' => 'Gohan', 'slug' => 'gohan'],
            ['nombre' => 'Arma tu Sushi', 'slug' => 'arma-tu-sushi'],
            ['nombre' => 'Hamburguesas', 'slug' => 'hamburguesas'],
            ['nombre' => 'Otros', 'slug' => 'otros'],
        ];

        DB::table('categorias')->insert($categorias);
    }
}
