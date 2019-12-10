<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use integradora\Models\Especialidad;

class EspecialidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //\integradora\Models\
    	Especialidad::Create(
            ['nombre'=> 'Vegetariana']          
        );

        Especialidad::Create(
            ['nombre'=> 'Especial']
        );

        DB::table('especialidades')->insert([
        	['nombre'=> 'Carnes Frias'],
            ['nombre'=> 'Mexicana'],
        ]);
    }
}
