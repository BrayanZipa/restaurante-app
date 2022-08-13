<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/productos', [App\Http\Controllers\ProductoController::class, 'index'])->name('productos');
Route::post('/productos/crear', [App\Http\Controllers\ProductoController::class, 'store'])->name('crearProductos');
Route::get('/productos/mostrar/{id}', [App\Http\Controllers\ProductoController::class, 'show'])->name('mostrarProducto');
Route::put('/productos/actualizar/{id}', [App\Http\Controllers\ProductoController::class, 'update'])->name('actualizarProducto');
Route::delete('/productos/eliminar/{id}', [App\Http\Controllers\ProductoController::class, 'destroy'])->name('eliminarProducto');
