<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Productos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id_productos');
            $table->string('nombre', 50);
            $table->string('codigo', 15)->unique();
            $table->integer('total');
            $table->date('fecha_vencimiento');
            $table->unsignedInteger('id_unidad');
            $table->foreign('id_unidad')->references('id_unidades')->on('unidades')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('id_proveedor');
            $table->foreign('id_proveedor')->references('id_proveedores')->on('proveedores')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('productos');
    }
}
