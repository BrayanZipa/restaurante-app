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


    public function obtenerInventario(){
        try {
            $inventario = Inventario::all();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $inventario;
    }
}
