<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	 $this->truncateTables([
    	 	'facturas',
    	 	'clientes',
    	 	'especialidades',
    	 	'users',
    	 ]);

         $this->call(UsuariosTableSeeder::class);
         //$this->call(IngredienteSeeder::class);
         $this->call(EspecialidadesSeeder::class);
         $this->call(ClienteSeeder::class);
         $this->call(FacturasSeeder::class);
         $this->call(OrdenesSeeder::class);
         $this->call(ProductoSeeder::class);
    }

    protected function truncateTables(array $tables)
    {
    	foreach ($tables as $table) {
        DB::statement('ALTER TABLE '.$table.' DISABLE TRIGGER ALL;');
    		DB::table($table)->truncate();
        DB::statement('ALTER TABLE '.$table.' ENABLE TRIGGER ALL;');
    	}
    }
}
