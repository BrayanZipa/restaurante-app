<?php

namespace Database\Seeders;

use App\Models\Unidad;
use App\Models\User;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\Inventario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Brayan Zipa';
        $user->email = 'zipa.fonseca@gmail.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('brayan123456');
        $user->remember_token = Str::random(10);
        $user->save();

        $user2 = new User();
        $user2->name = 'David Botero';
        $user2->email = 'boteronunezdavid@gmail.com';
        $user2->email_verified_at = now();
        $user2->password = Hash::make('david123456');
        $user2->remember_token = Str::random(10);
        $user2->save();

        User::factory(10)->create();
        Unidad::factory(15)->create();
        Proveedor::factory(20)->create();
        Producto::factory(20)->create();
        // Inventario::factory(10)->create();
}
}