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
        return [
            'unidad' => $this->faker->unique()->randomElement(['Gramo','Kilogramo','Litro','Mililitro','Libra']),
            'abreviacion' => $this->faker->unique()->randomElement(['Gr','Kg','L','Ml','Lb']),
        ];
    }
}
