<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $table = 'inventario';

    protected $primaryKey = 'id_inventario';

    protected $fillable = ['fecha', 'estado', 'cantidad', 'costo', 'id_producto', 'id_usuario'];

    public function obtenerInventarios(){
        try {
            $inventarios = Inventario::all();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $inventarios;
    }

    public function obtenerInventario($id){    
        try {
            $inventario = Inventario::find($id);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $inventario; 
    }

    public function obtenerInformacionInventarios(){
        try {
            $inventarios = Inventario::select('inventario.*','pdt.nombre As producto','user.name')
            ->leftjoin('productos AS pdt', 'inventario.id_producto', '=', 'pdt.id_productos')
            // ->leftjoin('unidades AS uni', 'pdt.id_unidad', '=', 'uni.id_unidades')
            ->leftjoin('usuarios AS user', 'inventario.id_usuario', '=', 'user.id_usuarios')->get();

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $inventarios; 
    }
}
