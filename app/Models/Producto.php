<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $primaryKey = 'id_productos';

    protected $fillable = ['nombre', 'codigo','peso', 'total', 'id_unidad', 'id_proveedor', 'id_usuario', 'estado_activacion'];

    public function obtenerProductos()
    {
        try {
            $productos = Producto::leftjoin('unidades AS uni', 'productos.id_unidad', '=', 'uni.id_unidades')
            ->where('estado_activacion', true)->get();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $productos;
    }

    public function obtenerProducto($id)
    {
        try {
            $producto = Producto::find($id);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $producto;
    }

    public function obtenerInformacionProductos()
    {
        try {
            $productos = Producto::select('productos.*', 'pro.nombre AS proveedor', 'user.name', 'uni.abreviacion')
                ->leftjoin('proveedores AS pro', 'productos.id_proveedor', '=', 'pro.id_proveedores')
                ->leftjoin('unidades AS uni', 'productos.id_unidad', '=', 'uni.id_unidades')
                ->leftjoin('usuarios AS user', 'productos.id_usuario', '=', 'user.id_usuarios')->where('productos.estado_activacion', true)->get();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $productos;
    }
}
