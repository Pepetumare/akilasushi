<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            [
                'nombre' => '3 Hand Rolls',
                'descripcion' => 'Base queso crema y cebollín, más una proteína o vegetal por hand roll.',
                'precio' => 10000,
                'categoria_id' => 1, // después configuramos categoría Hand Rolls
                'imagen' => 'handrolls-3.png',
                'opciones' => json_encode([
                    'proteinas' => ['Pollo', 'Kanikama', 'Camarón', 'Salmón', 'Atún'],
                    'vegetales' => ['Palta', 'Champiñón', 'Palmito', 'Choclo', 'Pepino', 'Morrón']
                ]),
            ],
            [
                'nombre' => '4 Hand Rolls',
                'descripcion' => 'Base queso crema y cebollín, más una proteína o vegetal por hand roll.',
                'precio' => 12500,
                'categoria_id' => 1,
                'imagen' => 'handrolls-4.png',
                'opciones' => json_encode([
                    'proteinas' => ['Pollo', 'Kanikama', 'Camarón', 'Salmón', 'Atún'],
                    'vegetales' => ['Palta', 'Champiñón', 'Palmito', 'Choclo', 'Pepino', 'Morrón']
                ]),
            ],
            [
                'nombre' => 'Akila Nikkey - Rolls Dorados',
                'descripcion' => 'Rolls de 10 piezas con pollo crispy, palta y queso crema, envueltos en láminas de oro.',
                'precio' => 6990,
                'categoria_id' => 2, // categoría Rolls Especiales
                'imagen' => 'rolls-dorados.png',
                'opciones' => null,
            ],
            // Puedes seguir agregando más productos aquí
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}
