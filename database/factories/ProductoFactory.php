<?php

namespace Database\Factories;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductoFactory extends Factory
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
            'nombre' => $this->faker->unique()->randomElement(['Pollo','Carne asada','Bagre','Mojarra','Cotillas BBQ','Arroz','Menudencia','Pierna Pernil',
            'Ajiaco','Mondongo','Churrasco','Pechuga','Color','Sazon','Arroz con pollo','Papa','Platano','Arepas','Papa franceza'
            ,'Yuca frita']), 
            'codigo' => $this->faker->unique()->numberBetween($min = 10000, $max = 20000),
            'peso' => $this->faker->numberBetween($min = 10, $max = 200),
            'total' => 0,
            // 'id_unidad' => $this->faker->numberBetween($min = 1, $max = 5),
            'id_unidad' => $this->faker->randomElement(['4','14','24','34','44']), 
            // 'id_proveedor' => $this->faker->numberBetween($min = 1, $max = 9),
            'id_proveedor' => $this->faker->randomElement(['4','14','24','34','44','54','64','74','84']),
            // 'id_usuario' => $this->faker->numberBetween($min = 1, $max = 2),
            'id_usuario' => $this->faker->randomElement(['4','14']), 
            'estado_activacion' => $this->faker->boolean(true)
        ];
    }
}
