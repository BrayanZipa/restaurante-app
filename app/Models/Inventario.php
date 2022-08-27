<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $table = 'inventario';

    protected $fillable = ['fecha', 'estado', 'cantidad', 'costo', 'id_producto', 'id_usuario'];

    protected $primaryKey = 'id_inventario';


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
            ->leftjoin('usuarios AS user', 'inventario.id_usuario', '=', 'user.id_usuarios')->get();

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $inventarios; 
    }
}
