<?php

namespace Database\Factories;

use App\Models\Unidad;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnidadFactory extends Factory
{
    protected $model = Unidad::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $orden = 0;
        $unidades = ['Gramo','Kilogramo','Litro','Mililitro','Libra','Arroba','Bulto'];
        $abreviaciones = ['Gr','Kg','L','Ml','Lb','@','Bl'];
    
        $unidad = $unidades[$orden];
        $abreviacion = $abreviaciones[$orden];
    
        $orden++;

        return [
            'unidad' => $unidad,
            'abreviacion' => $abreviacion
        ];
    }
}
