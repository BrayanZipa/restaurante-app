<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Proveedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->increments('id_proveedores');
            $table->string('nombre', 50);
            $table->string('nit', 15)->unique();
            $table->string('telefono', 10)->unique();
            $table->string('correo', 50)->unique()->nullable();
            $table->string('direccion', 50)->nullable();
            $table->unsignedInteger('id_usuario');
            $table->foreign('id_usuario')->references('id_usuarios')->on('usuarios')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedores');
    }
}
