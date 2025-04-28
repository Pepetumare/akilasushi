<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Hand Rolls'],
            ['nombre' => 'Rolls Especiales'],
            ['nombre' => 'Combos'],
            ['nombre' => 'Gohan'],
            ['nombre' => 'Arma tu Sushi'],
            ['nombre' => 'Hamburguesas'],
            ['nombre' => 'Otros'],
        ];

        DB::table('categorias')->insert($categorias);
    }
}
