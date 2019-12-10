<?php

namespace integradora\Http\Controllers;

use integradora\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos=Producto::all();
        return view('producto.index')->with('productos',Producto::all());
        return view('producto.index',compact('title','Producto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('producto.new',compact('title','Producto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //'precio'=>['required','numeric'],
        $this->validate($request,[
            'nombre'=>['required','unique:Productos,nombre'],
        ]);
        Producto::create([
            'nombre'=>$request['nombre'],
        ]);
        return redirect()->route('productos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \integradora\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request['buscar']==null) {
         return view('producto.index')->with('productos',Producto::all());
        }
        else{
        $producto=Producto::where('nombre','like',"%{$request['buscar']}%")->get();
        return view('producto.index')->with('productos',$producto);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \integradora\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        return view('producto.edit',compact('title','producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \integradora\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $data=request()->all();
        $this->validate($request,[
            'nombre'=>['required',Rule::unique('productos')->ignore($producto->id)],
        ]);
        $fresh=Producto::find($producto->id);
        //$producto->update($data);
        $fresh->update($data);
        return redirect()->route('productos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \integradora\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos')->with('productos',Producto::all());
    }
}
