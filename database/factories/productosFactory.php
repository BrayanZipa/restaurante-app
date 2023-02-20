<?php

namespace Database\Factories;
use app\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class productosFactory extends Factory
{

    protected $model = Producto::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'nombre' => $this->faker->name(), 
            // 'codigo' => $this->faker->ramdom(999999),
            // 'peso' => $this->faker->ramdom(100), 
            // 'total' => $this->faker->ramdom(1000000), 
            // 'id_unidad' => $this->faker->ramdom(6), 
            // 'id_proveedor' => $this->faker->ramdom(4), 
            // 'id_usuario' => $this->faker->ramdom(1), 
            // 'estado_activacion' => $this->faker->ramdom(1),

            'nombre' => $this->faker->name(), 
            'peso' => str::ramdom(100), 
            'total' => str::ramdom(1000000), 
            'id_unidad' => str::ramdom(6), 
            'id_proveedor' => str::ramdom(4), 
            'id_usuario' => str::ramdom(1), 
            'estado_activacion' => str::ramdom(1)
        ];
    }
}
