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
        static $orden = 0;

        $productos = ['Pollo','Carne','Bagre','Mojarra','Costillas BBQ','Arroz','Menudencia','Pierna pernil', 'Ajiaco','Mondongo','Churrasco','Pechuga','Color','Sazon','Papa','Platano','Arepas','Papa francesa','Yuca frita', 'Gaseosa'];

        // $unidades = [2, 2, 2, 2, 2, 1, 1, 2, 1, 1, 2, 2, 1, 1, 7, 7, 1, 1, 1, 3];
        $unidades = [14, 14, 14, 14, 14, 4, 4, 14, 4, 4, 14, 14, 4, 4, 64, 64, 4, 4, 4, 24];

        // $proveedores = [2, 1, 1, 1, 1, 9, 1, 2, 1, 1, 1, 2, 9, 9, 5, 5, 4, 4, 4, 9];
        $proveedores = [14, 4, 4, 4, 4, 84, 4, 14, 4, 4, 4, 14, 84, 84, 44, 44, 34, 34, 34, 84];

        $producto = $productos[$orden];
        $unidad = $unidades[$orden];
        $proveedor = $proveedores[$orden];
    
        $orden++;

        return [
            'nombre' => $producto,
            'codigo' => $this->faker->unique()->numberBetween(10000, 20000),
            'peso' => $this->faker->numberBetween(100, 200),
            'total' => 0,
            'id_unidad' => $unidad,
            'id_proveedor' => $proveedor,
            // 'id_usuario' => $this->faker->numberBetween(1, 2),
            'id_usuario' => $this->faker->randomElement(['4','14']), 
            'estado_activacion' => $this->faker->boolean(true)
        ];
    }
}
