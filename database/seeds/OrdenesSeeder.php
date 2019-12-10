<?php

use Illuminate\Database\Seeder;
use integradora\Models\Orden;

class OrdenesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Orden::create([
        	'factura_id'=>'1',
        	'producto_id'=>'1',
        	'especialidad_id'=>'1',
          'precio'=>'120.45',
          'cantidad'=>'1',
          'comentario'=>'Sin jamon'
        ]);
        Orden::create([
        	'factura_id'=>'2',
        	'producto_id'=>'2',
        	'especialidad_id'=>'2',
          'precio'=>'64.21',
          'cantidad'=>'2',
          'comentario'=>'Ninguno'
        ]);
    }
}
