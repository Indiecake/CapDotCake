<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaOrdenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id'); //integer unsigned - autoincrement
            $table->integer('factura_id')->unsigned;
            $table->integer('producto_id')->unsigned;
            $table->unsignedInteger('especialidad_id');
            $table->double('precio', 8,2);
            $table->integer('cantidad');
            $table->longText('comentario')->nullable;
           #$table->foreign('factura_id')->references('id')->on('facturas');
            $table->softDeletes();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenes');
    }
}
