<?php

namespace integradora\Http\Controllers;

use integradora\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
    	$users= User::all();
        $title= 'Listado de Usuarios';

        return view('users.index',compact('title','users'));
    }

    public function show($id)
    {
        $user=User::find($id);
    	return view('users.show',compact('user'));
    }

    public function create()
    {
    	return 'Crear nuevo usuario';
    }
}
