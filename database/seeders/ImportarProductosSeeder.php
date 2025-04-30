<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Categoria;

class ImportarProductosSeeder extends Seeder
{
    public function run(): void
    {
        $file = database_path('seeders/data/productos.csv');

        if (!file_exists($file) || !is_readable($file)) {
            die("No se encontró el archivo productos.csv");
        }

        $header = null;
        $data = array();

        if (($handle = fopen($file, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    if (count($header) === count($row)) {
                        $data[] = array_combine($header, $row);
                    }
                }
            }
            fclose($handle);
        }

        $importados = 0;

        foreach ($data as $item) {
            $categoria = Categoria::where('nombre', $item['categoria'])->first();

            if ($categoria) {
                Producto::create([
                    'nombre' => $item['nombre'],
                    'descripcion' => $item['descripcion'],
                    'precio' => (int) $item['precio'],
                    'categoria_id' => $categoria->id,
                    'personalizable' => (bool) $item['personalizable'],
                ]);

                $importados++;
            }
        }

        echo "✅ Productos importados correctamente: {$importados}\n";
    }
}
