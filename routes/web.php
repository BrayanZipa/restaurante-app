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

Route::middleware(['auth'])->prefix('proveedores')->group(function () {
    Route::get('/', [App\Http\Controllers\ProveedorController::class, 'index'])->name('proveedores');
});

Route::middleware(['auth'])->prefix('productos')->group(function () {
    Route::get('/', [App\Http\Controllers\ProductoController::class, 'index'])->name('productos');
    Route::post('/crear', [App\Http\Controllers\ProductoController::class, 'store'])->name('crearProductos');
    Route::get('/mostrar/{id}', [App\Http\Controllers\ProductoController::class, 'show'])->name('mostrarProducto');
    Route::put('/actualizar/{id}', [App\Http\Controllers\ProductoController::class, 'update'])->name('actualizarProducto');
    Route::delete('/eliminar/{id}', [App\Http\Controllers\ProductoController::class, 'destroy'])->name('eliminarProducto');
});

Route::middleware(['auth'])->prefix('inventario')->group(function () {
    Route::get('/', [App\Http\Controllers\InventarioController::class, 'index'])->name('inventario');
});
