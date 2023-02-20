<?php

namespace Database\Factories;

use app\Models\Unidad;
use Illuminate\Database\Eloquent\Factories\Factory;

class unidadFactory extends Factory
{
    protected $model = Unidad::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unidad' => $this->faker->unique()->firstname(),
            'abreviacion' => $this->faker->unique()->suffix(),
        ];
    }
}
