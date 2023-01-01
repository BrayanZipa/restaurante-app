<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Inventario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventario', function (Blueprint $table) {
            $table->increments('id_inventario');
            $table->boolean('estado');
            $table->double('cantidad');
            $table->double('costo');
            $table->date('fecha_vencimiento');
            $table->dateTime('fecha');
            $table->unsignedInteger('id_producto');
            $table->foreign('id_producto')->references('id_productos')->on('productos')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('inventario');
    }
}
