<?php

use Illuminate\Database\Seeder;
use integradora\User;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
    		'nombre'=>'Daniel',
    		'email'=>'dani_daniel97@live.com',
    		'password'=>bcrypt('123456'),
    	]);

        factory(User::class,3)->create();
    }
}
