<?php

use Illuminate\Database\Seeder;
use integradora\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producto::create([
        	'nombre'=>'Pizza mediana'

        ]);
        Producto::create([
        	'nombre'=>'Pizza grande'

        ]);
    }
}
