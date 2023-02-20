<?php

namespace Database\Seeders;

use app\Models\Unidad;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    
       Unidad::factory(50)->create();
    }
}
