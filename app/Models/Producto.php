<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = ['nombre', 'codigo', 'unidad', 'total', 'id_proveedor', 'id_usuario'];

    protected $primaryKey = 'id_productos';


    public function obtenerProductos(){
        try {
            $productos = Producto::all();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $productos;
    }

    public function obtenerProducto($id){
        try {
            $producto = Producto::find($id);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $producto; 
    }

    public function obtenerInformacionProductos(){
        try {
            $productos = Producto::select('productos.*', 'pro.nombre AS proveedor', 'user.name')
            ->leftjoin('proveedores AS pro', 'productos.id_proveedor', '=', 'pro.id_proveedores')
            ->leftjoin('usuarios AS user', 'productos.id_usuario', '=', 'user.id_usuarios')->get();

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $productos; 
    }
}
