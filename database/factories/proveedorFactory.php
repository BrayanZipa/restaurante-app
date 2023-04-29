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
        return [
            'nombre' => $this->faker->unique()->randomElement(['Carnes la mejor','Mac pollo','Oasis S.A.S','Frozen express','Abastos','Fruvana','Idelsa','Colcabie','SurtiMax']), 
            'nit'  =>$this->faker->unique()->numberBetween($min = 100000, $max = 200000),
            'telefono' => $this->faker->e164PhoneNumber,
            'correo' => $this->faker->email,
            'direccion' => $this->faker->streetAddress,
            'id_usuario' => $this->faker->numberBetween($min = 1, $max = 12),
            'estado_activacion' => $this->faker->boolean(true)
        ];
    }
}
