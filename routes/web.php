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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/total_datos', [App\Http\Controllers\HomeController::class, 'obtenerTotalDatos'])->name('totalDatos');
    Route::get('/registros_inventario_dia', [App\Http\Controllers\HomeController::class, 'registrosInventarioPorDia'])->name('inventarioPorDia');
    Route::get('/registros_inventario_mes', [App\Http\Controllers\HomeController::class, 'registrosInventarioPorMes'])->name('inventarioPorMes');
    Route::get('/total_estado_productos', [App\Http\Controllers\HomeController::class, 'totalEstadoProducto'])->name('estadoProductos');
    Route::get('/total_ingresos_productos', [App\Http\Controllers\HomeController::class, 'totalIngresosPoductos'])->name('ingresosProductos');
});

Route::middleware(['auth'])->prefix('proveedores')->group(function () {
    Route::get('/', [App\Http\Controllers\ProveedorController::class, 'index'])->name('proveedores');
    Route::get('/crear', [App\Http\Controllers\ProveedorController::class, 'create'])->name('crearProveedor');
    Route::post('/guardar', [App\Http\Controllers\ProveedorController::class, 'store'])->name('guardarProveedor');
    Route::put('/actualizar/{id}', [App\Http\Controllers\ProveedorController::class, 'update'])->name('actualizarProveedor');
    Route::delete('/eliminar/{id}', [App\Http\Controllers\ProveedorController::class, 'destroy'])->name('eliminarProveedor');
    Route::get('/lista_proveedores', [App\Http\Controllers\ProveedorController::class, 'obtenerListaProveedores'])->name('listaProveedores');
});

Route::middleware(['auth'])->prefix('unidades')->group(function () {
    Route::get('/', [App\Http\Controllers\UnidadController::class, 'index'])->name('unidades');
    Route::post('/guardar', [App\Http\Controllers\UnidadController::class, 'store'])->name('guardarUnidad');
    Route::put('/actualizar/{id}', [App\Http\Controllers\UnidadController::class, 'update'])->name('actualizarUnidad');
    Route::delete('/eliminar/{id}', [App\Http\Controllers\UnidadController::class, 'destroy'])->name('eliminarUnidad');
    Route::get('/lista_unidades', [App\Http\Controllers\UnidadController::class, 'obtenerListaUnidades'])->name('listaUnidades');
});

Route::middleware(['auth'])->prefix('productos')->group(function () {
    Route::get('/', [App\Http\Controllers\ProductoController::class, 'index'])->name('productos');
    Route::get('/crear', [App\Http\Controllers\ProductoController::class, 'create'])->name('crearProducto');
    Route::post('/guardar', [App\Http\Controllers\ProductoController::class, 'store'])->name('guardarProducto');
    Route::put('/actualizar/{id}', [App\Http\Controllers\ProductoController::class, 'update'])->name('actualizarProducto');
    Route::delete('/eliminar/{id}', [App\Http\Controllers\ProductoController::class, 'destroy'])->name('eliminarProducto');
    Route::get('/lista_productos', [App\Http\Controllers\ProductoController::class, 'obtenerListaProductos'])->name('listaProductos');
});

Route::middleware(['auth'])->prefix('inventario')->group(function () {
    Route::get('/', [App\Http\Controllers\InventarioController::class, 'index'])->name('inventario');
    Route::get('/crear', [App\Http\Controllers\InventarioController::class, 'create'])->name('crearInventario');
    Route::post('/guardar', [App\Http\Controllers\InventarioController::class, 'store'])->name('guardarInventario');
    Route::delete('/eliminar/{id}', [App\Http\Controllers\InventarioController::class, 'destroy'])->name('eliminarInventario');
    Route::get('/lista_inventarios', [App\Http\Controllers\InventarioController::class, 'obtenerListaInventarios'])->name('listaInventarios');
    Route::get('/lista_inventario/{id}', [App\Http\Controllers\InventarioController::class, 'obtenerListaInventario'])->name('listaInventario');
    Route::get('/lista_pedidos/{id}', [App\Http\Controllers\InventarioController::class, 'obtenerListaPedidosProveedor'])->name('listaPedidos');
});

Route::middleware(['auth'])->prefix('reportes')->group(function () {
    Route::get('/', [App\Http\Controllers\ReporteController::class, 'index'])->name('reportes');
    Route::get('/exportar', [App\Http\Controllers\ReporteController::class, 'exportarReportes'])->name('exportarReportes')->middleware('auth');
});
