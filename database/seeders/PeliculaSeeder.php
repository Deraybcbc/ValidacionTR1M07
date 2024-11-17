<?php

namespace Database\Seeders;

use App\Models\Pelicula;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeliculaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $archivo_json = './resources/json/peliculas.json';
        $json = file_get_contents($archivo_json);
        $peliculas = json_decode($json, true);


        foreach ($peliculas as $pelicula) {
            Pelicula::create([
                'title' => $pelicula['title'],
                'director' => $pelicula['director'],
                'year'=> $pelicula['release_year'],
                'IdCategory'=>$pelicula['idCategory'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

        }
    }
}
