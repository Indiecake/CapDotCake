<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use integradora\Models\Cliente;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('clientes')->insert([
        	'nombre'=>'Manuel',
        	'apaterno'=>'Ramirez',
        	'amaterno'=>'Valenzuela',
        	'calle'=>'Villas del madrid',
        	'numero'=>'12',
        	'colonia'=>'Altares',
        	'telefono'=>'123123123',
        ]);
        Cliente::create([
            'nombre'=>'Anna',
            'apaterno'=>'West',
            'amaterno'=>'De la Rosa',
            'calle'=>'Happines',
            'numero'=>'31',
            'colonia'=>'Los bosques',
            'telefono'=>'9922114451'
        ]);
    }
}
