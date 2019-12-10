<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id'); //integer unsigned - autoincrement
            $table->string('nombre', 50); //varchar
            $table->string('apaterno', 50)->nullable();
            $table->string('amaterno', 50)->nullable();
            $table->string('calle', 50);
            $table->string('numero', 12);
            $table->string('colonia', 50);
            $table->string('telefono', 15);  
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
        Schema::dropIfExists('clientes');
    }
}
