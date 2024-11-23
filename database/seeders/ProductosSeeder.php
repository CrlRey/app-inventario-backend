<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use File;
use Illuminate\Support\Facades\File as FacadesFile;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = FacadesFile::get('database/data/categorias.json');
        $nombres = json_decode($json);

        foreach ($nombres as $key => $value){
            Categoria::create([
                'nombre' => $value->nombre
            ]);
        }
    }
}
