<?php

namespace integradora\Http\Controllers;

use integradora\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{

    public function index()
    {
        $clientes=Cliente::all();

        return view('cliente.index')->with('clientes',Cliente::all());
        return view('cliente.index',compact('title','Clientes'));
    }


    public function create()
    {
        return view('cliente.new',compact('title','clientes'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre' =>['required'],
            'apaterno' =>[''],
            'amaterno' =>[''],
            'calle' =>['required'],
            'numero' =>['required','numeric'],
            'colonia' =>['required'],
            'telefono' =>['required','numeric'],
        ]);
        Cliente::create([
            'nombre' =>$request['nombre'],
            'apaterno' =>$request['apaterno'],
            'amaterno' =>$request['amaterno'],
            'calle' =>$request['calle'],
            'numero' =>$request['numero'],
            'colonia' =>$request['colonia'],
            'telefono' =>$request['telefono']
        ]);
        return redirect()->route('clientes');
    }


    public function show(Request $request)
    {
        if ($request['buscar']==null) {
         return view('cliente.index')->with('clientes',Cliente::all());
        }
        else{
        $cliente=Cliente::where('nombre','like',"%{$request['buscar']}%")->get();
        return view('cliente.index')->with('clientes',$cliente);
        }
    }


    public function edit(Cliente $cliente)
    {
        return view('cliente.edit',compact('title','cliente'));
    }


    public function update(Request $request, Cliente $cliente)
    {
        $data=request()->all();
        $this->validate($request,[
            'nombre' =>['required'],
            'apaterno' =>[''],
            'amaterno' =>[''],
            'calle' =>['required'],
            'numero' =>['required','numeric'],
            'colonia' =>['required'],
            'telefono' =>['required','numeric'],
        ]);
        $cliente->update($data);
        return redirect()->route('clientes');
    }


    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes');
    }
}
