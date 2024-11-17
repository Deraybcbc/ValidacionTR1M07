<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\AutorizacionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AutorizacionController::class, 'login'])->name('login');


Route::get('/getPeliculas', [PeliculaController::class, 'getPelis'])->name('get.peliculas');
Route::post('/getPeliById', [PeliculaController::class, 'getPeliById'])->name('id.pelicula');
Route::get('/getCategory', [CategoriaController::class, 'getCategory'])->name('get.peliculas');


Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/pelicula')->group(function () {
        Route::delete('/delete', [PeliculaController::class, 'deletePelicula'])->name('delete.pelicula');
        Route::post('/update', [PeliculaController::class, 'updatePelicula'])->name('update.pelicula');
        Route::post('/create', [PeliculaController::class, 'createPelicula'])->name('create.pelicula');
    });

    Route::prefix('/categoria')->group(function () {
        Route::delete('/delete', [CategoriaController::class, 'deleteCategoria'])->name('delete.categoria');
        Route::post('/update', [CategoriaController::class, 'updateCategoria'])->name('update.categoria');
        Route::post('/create', [CategoriaController::class, 'createCategoria'])->name('create.categoria');
    });
});