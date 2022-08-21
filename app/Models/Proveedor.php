<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $fillable = ['nombre', 'nit', 'telefono', 'correo', 'direccion', 'id_usuario'];

    protected $primaryKey = 'id_proveedores';

    public function obtenerProveedores(){
        try {
            $proveedores = Proveedor::all();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $proveedores;
    }
}
