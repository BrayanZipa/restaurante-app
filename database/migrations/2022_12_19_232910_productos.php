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
            $table->double('peso');
            $table->double('total');
            $table->unsignedInteger('id_unidad');
            $table->foreign('id_unidad')->references('id_unidades')->on('unidades')->onUpdate('restrict')->onDelete('restrict');
            $table->unsignedInteger('id_proveedor');
            $table->foreign('id_proveedor')->references('id_proveedores')->on('proveedores')->onUpdate('restrict')->onDelete('restrict');
            $table->unsignedInteger('id_usuario');
            $table->foreign('id_usuario')->references('id_usuarios')->on('usuarios')->onUpdate('restrict')->onDelete('restrict');
            $table->boolean('estado_activacion')->default(true);
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
