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
            $table->double('cantidad_producto');
            $table->double('costo')->nullable();
            $table->double('costo_unitario', 9, 2)->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->dateTime('fecha');
            $table->unsignedInteger('id_producto');
            $table->foreign('id_producto')->references('id_productos')->on('productos')->onUpdate('restrict')->onDelete('restrict');
            $table->unsignedInteger('id_usuario');
            $table->foreign('id_usuario')->references('id_usuarios')->on('usuarios')->onUpdate('restrict')->onDelete('restrict');
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
