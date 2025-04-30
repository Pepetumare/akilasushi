<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            // Hand Rolls (Personalizables)
            ['nombre' => '3 Hand Rolls', 'descripcion' => '3 Hand Rolls personalizables. Base queso crema y cebollín.', 'precio' => 10000, 'categoria_id' => 2, 'personalizable' => true],
            ['nombre' => '4 Hand Rolls', 'descripcion' => '4 Hand Rolls personalizables. Base queso crema y cebollín.', 'precio' => 13000, 'categoria_id' => 2, 'personalizable' => true],
            ['nombre' => 'Hand Roll Tradicional', 'descripcion' => 'Hand Roll tradicional a elección. Base queso crema y cebollín.', 'precio' => 3500, 'categoria_id' => 2, 'personalizable' => true],
            ['nombre' => 'Hand Roll Relleno Doble', 'descripcion' => 'Hand Roll de relleno doble. Base queso crema y cebollín.', 'precio' => 4000, 'categoria_id' => 2, 'personalizable' => true],
            ['nombre' => 'Hand Roll XL', 'descripcion' => 'Hand Roll XL a elección. Base queso crema y cebollín.', 'precio' => 4500, 'categoria_id' => 2, 'personalizable' => true],

            // Rolls Tradicionales (No personalizables)
            ['nombre' => 'Kalifornia Roll', 'descripcion' => 'Kanika, palta y queso crema.', 'precio' => 6000, 'categoria_id' => 1, 'personalizable' => false],
            ['nombre' => 'Salmón Palta Roll', 'descripcion' => 'Salmón, palta y queso crema.', 'precio' => 6500, 'categoria_id' => 1, 'personalizable' => false],
            ['nombre' => 'Pollo Palta Roll', 'descripcion' => 'Pollo apanado, palta y queso crema.', 'precio' => 6000, 'categoria_id' => 1, 'personalizable' => false],
            ['nombre' => 'Atún Palta Roll', 'descripcion' => 'Atún, palta y queso crema.', 'precio' => 6000, 'categoria_id' => 1, 'personalizable' => false],

            // Combos (Personalizables)
            ['nombre' => 'Solo Para Ti', 'descripcion' => 'Combo de 20 piezas a elección.', 'precio' => 12000, 'categoria_id' => 3, 'personalizable' => true],
            ['nombre' => 'Un Gustito', 'descripcion' => 'Combo especial de 32 piezas.', 'precio' => 18000, 'categoria_id' => 3, 'personalizable' => true],
            ['nombre' => 'Familiar', 'descripcion' => 'Combo familiar de 100 piezas.', 'precio' => 35000, 'categoria_id' => 3, 'personalizable' => true],
            ['nombre' => 'Para la Familia', 'descripcion' => 'Combo grande para compartir.', 'precio' => 43000, 'categoria_id' => 3, 'personalizable' => true],

            // Gohan
            ['nombre' => 'Gohan Flecha', 'descripcion' => 'Gohan de proteína a elección.', 'precio' => 6500, 'categoria_id' => 4, 'personalizable' => false],
            ['nombre' => 'Gohan Orion', 'descripcion' => 'Gohan mixto de verduras.', 'precio' => 6500, 'categoria_id' => 4, 'personalizable' => false],

            // Especialidades
            ['nombre' => 'Akila Burger', 'descripcion' => 'Hamburguesa de sushi.', 'precio' => 7000, 'categoria_id' => 5, 'personalizable' => false],
            ['nombre' => 'Muchupleto', 'descripcion' => 'Roll gigante de carnes y queso.', 'precio' => 9000, 'categoria_id' => 5, 'personalizable' => false],
            ['nombre' => 'Monumento', 'descripcion' => 'Roll especial con camarón.', 'precio' => 8500, 'categoria_id' => 5, 'personalizable' => false],
            ['nombre' => 'Costanera', 'descripcion' => 'Roll de mariscos frescos.', 'precio' => 8500, 'categoria_id' => 5, 'personalizable' => false],

            // Bebidas
            ['nombre' => 'Agua Mineral', 'descripcion' => 'Botella de agua.', 'precio' => 1500, 'categoria_id' => 6, 'personalizable' => false],
            ['nombre' => 'Bebida Lata', 'descripcion' => 'Lata de bebida tradicional.', 'precio' => 2000, 'categoria_id' => 6, 'personalizable' => false],
            ['nombre' => 'Jugo Natural', 'descripcion' => 'Jugo de fruta natural.', 'precio' => 2500, 'categoria_id' => 6, 'personalizable' => false],

            // Postres
            ['nombre' => 'Cheesecake', 'descripcion' => 'Tarta de queso tradicional.', 'precio' => 3000, 'categoria_id' => 7, 'personalizable' => false],
            ['nombre' => 'Helado Japonés', 'descripcion' => 'Helado de té verde.', 'precio' => 3500, 'categoria_id' => 7, 'personalizable' => false],

            // Extras
            ['nombre' => 'Extra Palta', 'descripcion' => 'Agregar palta extra.', 'precio' => 1000, 'categoria_id' => 8, 'personalizable' => false],
            ['nombre' => 'Extra Kanikama', 'descripcion' => 'Agregar kanikama extra.', 'precio' => 1000, 'categoria_id' => 8, 'personalizable' => false],
            ['nombre' => 'Extra Camarón', 'descripcion' => 'Agregar camarón extra.', 'precio' => 1500, 'categoria_id' => 8, 'personalizable' => false],
            ['nombre' => 'Extra Queso Crema', 'descripcion' => 'Agregar queso crema extra.', 'precio' => 1000, 'categoria_id' => 8, 'personalizable' => false],
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}
