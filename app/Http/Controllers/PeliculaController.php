<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    public function getPelis(Request $request)
    {


        $peliculas = Pelicula::with('categoria')->get();

        return response()->json(['status' => 'succes', 'peliculas' => $peliculas]);

    }

    public function getPeliById(Request $request)
    {
        $data = $request->validate([
            'id' => 'required'
        ]);

        $pelicula = Pelicula::with('categoria')->findOrFail($data['id']);

        return response()->json(['status' => 'succes', 'peliculas' => $pelicula]);
    }

    public function createPelicula(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'director' => 'required',
            'year' => 'required',
            'IdCategory' => 'required'
        ]);
        try {
            $pelicula = new Pelicula();
            $pelicula->title = $data['title'];
            $pelicula->director = $data['director'];
            $pelicula->year = $data['year'];
            $pelicula->IdCategory = $data['IdCategory'];

            $pelicula->save();
            return response()->json(['status' => 'success', 'message' => 'Pelicula creada']);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => 'error', 'message' => 'Pelicula no creada']);
        }
    }

    public function updatePelicula(Request $request)
    {
        $data = $request->validate([
            'id' => 'required',
            'title' => 'required',
            'director' => 'required',
            'year' => 'required',
            'IdCategory' => 'required'
        ]);
        try {
            $pelicula = Pelicula::findOrFail($data['id']);

            $pelicula->title = $data['title'];
            $pelicula->director = $data['director'];
            $pelicula->year = $data['year'];
            $pelicula->IdCategory = $data['IdCategory'];

            $pelicula->save();
            return response()->json(['status' => 'success', 'message' => 'Pelicula actualizada']);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => 'error', 'message' => 'Pelicula no encontrada']);
        }
    }

    public function deletePelicula(Request $request)
    {

        $data = $request->validate([
            'idPelicula' => 'required'
        ]);

        try {
            $pelicula = Pelicula::findOrFail($data['idPelicula']);
            $pelicula->delete();

            return response()->json(['status' => 'succes', 'message' => 'Pelicula eliminada correctamente']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => 'error', 'message' => 'No se ha podido encontrar la peli'], 404);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Ocurrio un error inesperado', 'error' => $e->getMessage()], 500);
        }

    }
}
