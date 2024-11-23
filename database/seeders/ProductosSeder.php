<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File as FacadesFile;
class ProductosSeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $json = FacadesFile::get('database/data/productos.json');
        $nombres = json_decode($json);

        foreach ($nombres as $key => $value){
            Producto::create([
                'nombre' => $value->nombre,
                'categoria_id' => $value->categoria_id,
                'cantidad' => $value->cantidad,
                'precio' => $value->precio
            ]);
        }
    }
}
