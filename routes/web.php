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
    Route::get('/crear', [App\Http\Controllers\ProveedorController::class, 'create'])->name('crearProveedor');
    Route::post('/guardar', [App\Http\Controllers\ProveedorController::class, 'store'])->name('guardarProveedor');

    Route::get('/lista_proveedores', [App\Http\Controllers\ProveedorController::class, 'obtenerListaProveedores'])->name('listaProveedores');
});


Route::middleware(['auth'])->prefix('productos')->group(function () {
    Route::get('/', [App\Http\Controllers\ProductoController::class, 'index'])->name('productos');
    Route::get('/crear', [App\Http\Controllers\ProductoController::class, 'create'])->name('crearProducto');
    Route::post('/guardar', [App\Http\Controllers\ProductoController::class, 'store'])->name('guardarProducto');
    Route::get('/mostrar/{id}', [App\Http\Controllers\ProductoController::class, 'show'])->name('mostrarProducto');
    Route::put('/actualizar/{id}', [App\Http\Controllers\ProductoController::class, 'update'])->name('actualizarProducto');
    Route::delete('/eliminar/{id}', [App\Http\Controllers\ProductoController::class, 'destroy'])->name('eliminarProducto');

    Route::get('/lista_productos', [App\Http\Controllers\ProductoController::class, 'obtenerListaProductos'])->name('listaProductos');
});

Route::middleware(['auth'])->prefix('inventario')->group(function () {
    Route::get('/', [App\Http\Controllers\InventarioController::class, 'index'])->name('inventario');
    Route::get('/crear', [App\Http\Controllers\InventarioController::class, 'create'])->name('crearInventario');
    Route::post('/guardar', [App\Http\Controllers\InventarioController::class, 'store'])->name('guardarInventario');

    Route::get('/lista_inventarios', [App\Http\Controllers\InventarioController::class, 'obtenerListaInventarios'])->name('listaInventarios');
});
