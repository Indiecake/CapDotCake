<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use integradora\Models\Cliente;
use integradora\Models\Factura;

class FacturasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//metodo sin utilizar el constructor de consultas fluido de laravel
    	//$Cacliente= DB::select('SELECT id FROM clientes WHERE telefono= ? LIMIT 0,1',['123123123']);
    	//$clientes = DB::table('clientes')->select('id')->take(1)->get();
    	$cliente = DB::table('clientes')->select('id')->first();
      $cliID=Cliente::where('nombre','Manuel')->value('id');

    	//EJEMPLO DE CONSULTA COMPUESTA
    	//$cliente=DB::table('clientes')
    	//->select('id')
    	//->where('nombre','=','Manuel')
    	//->first();

        Factura::create([
            'cliente_id'=>$cliID,
            'fecha'=>DB::raw('curdate()'),
            'hora'=>DB::raw('curtime()'),
            'entregada'=>false,
            'Comentario'=>'El cliente va a pagar con 200 mxn.',
        ]);

        DB::table('facturas')->insert([
        	//'cliente_id'=>$Cacliente[0]->id,
        	['cliente_id'=>$cliente->id,'fecha'=>DB::raw('curdate()'),'hora'=>DB::raw('curtime()'), 'entregada'=>false,'comentario'=>'El cliente va a pagar exacto.'],
          ['cliente_id'=>$cliente->id,'fecha'=>DB::raw('curdate()'),'hora'=>DB::raw('curtime()'), 'entregada'=>false,'comentario'=>'Entre cedro blanco y pithaya madura.'],
        ]);
    }
}
