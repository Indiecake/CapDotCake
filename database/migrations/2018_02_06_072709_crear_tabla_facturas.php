<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaFacturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id'); //integer unsigned - autoincrement

            //$table->string('titular', 45);
            $table->unsignedInteger('cliente_id'); //varchar
            #$table->foreign('cliente_id')->references('id')->on('clientes');
            $table->date('fecha');
            $table->time('hora');
            $table->boolean('entregada')->default('0');
            $table->longText('comentario')->nullable;
            $table->softDeletes();
            #$table->double('total', 8,2);
            #$table->softDeletes();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturas');
    }
}
