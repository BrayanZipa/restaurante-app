<?php

namespace Database\Factories;

use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProveedorFactory extends Factory
{

    protected $model = Proveedor::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $orden = 0;
        
        $proveedores = ['Carnes la mejor','Mac pollo','Oasis S.A.S','Frozen express','Abastos','Fruvana','Idelsa','Colcabie','SurtiMax'];

        $proveedor = $proveedores[$orden];
    
        $orden++;

        return [
            'nombre' => $proveedor,
            'nit'  =>$this->faker->unique()->numberBetween(100000, 200000),
            'telefono' => $this->faker->numerify('3#########'),
            'correo' => str_replace(' ', '', $proveedor). '@gmail.com',
            'direccion' => $this->faker->randomElement(['Cra','Cl','Av']) .' '. $this->faker->numerify('##') . ' no ' . $this->faker->numerify('## ##'),
            // 'id_usuario' => $this->faker->numberBetween(1, 2),
            'id_usuario' => $this->faker->randomElement(['4','14']), 
            'estado_activacion' => $this->faker->boolean(true)
        ];
    }
}
