<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;

    protected $table = 'unidades';

    protected $primaryKey = 'id_unidades';

    protected $fillable = ['unidad'];

    public function obtenerUnidades()
    {
        try {
            $unidades = Unidad::all();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $unidades;
    }

    public function obtenerUnidad($id)
    {
        try {
            $unidad = Unidad::find($id);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $unidad;
    }
}
