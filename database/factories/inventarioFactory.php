<?php

namespace Database\Factories;

use App\Models\Inventario;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventarioFactory extends Factory
{
    protected $model = Inventario::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'estado' => $this->faker->boolean(true),
            'cantidad' => $this->faker->numberBetween($min = 10, $max = 200),
            'cantidad_producto'  => $this->faker->numberBetween($min = 10, $max = 200),
            'costo' => $this->faker->numberBetween($min = 50000, $max = 220000),
            'costo_unitario'  => $this->faker->numberBetween($min = 1000, $max = 50000),
            'fecha_vencimiento' => $this->faker->date,
            'fecha' => $this->faker->dateTime($max = 'now'),
            'id_producto' => $this->faker->numberBetween($min = 1, $max = 20),
            'id_usuario' => $this->faker->numberBetween($min = 1, $max = 2), 
        ];
    }
}
