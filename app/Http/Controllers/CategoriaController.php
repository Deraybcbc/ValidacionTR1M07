<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Pelicula;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function createCategoria(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'descripcion' => 'required'
        ]);

        try {
            $categoria = new Categoria();

            $categoria->name = $data['name'];
            $categoria->descripcion = $data['descripcion'];

            $categoria->save();

            return response()->json(['status' => 'success', 'message' => 'Categoria creada']);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => 'success', 'message' => 'Error al crear una categoria']);
        }
    }

    public function updateCategoria(Request $request)
    {
        $data = $request->validate([
            'idCategoria' => 'required',
            'name' => 'required',
            'descripcion' => 'required'
        ]);

        try {
            $categoria = Categoria::findOrFail($data['idCategoria']);

            $categoria->name = $data['name'];
            $categoria->descripcion = $data['descripcion'];

            $categoria->save();

            return response()->json(['status' => 'success', 'message' => 'Categoria actualizada']);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => 'success', 'message' => 'Categoria no encontrada']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error fuerte', "server" => $e->getMessage()]);
        }


    }

    public function deleteCategoria(Request $request)
    {
        try {

            $categoria = Categoria::findOrFail($request->IdCategoria);

            $categoria->delete();
            return response()->json(['status' => 'success', 'message' => 'Categoria Eliminada']);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => 'error', 'message' => 'Categoria no encontrada']);
        }

    }
}
