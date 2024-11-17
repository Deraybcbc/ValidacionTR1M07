<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $archivo_json = './resources/json/categorias.json';
        $json = file_get_contents($archivo_json);
        $categorias = json_decode($json, true);


        foreach ($categorias as $categoria) {
            Categoria::create([
                'name' => $categoria['name'],
                'descripcion' => $categoria['description'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

        }
    }
}
