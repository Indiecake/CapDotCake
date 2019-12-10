<?php

namespace integradora\Http\Controllers;

use integradora\Models\Orden;
use Illuminate\Http\Request;
use integradora\Models\Factura;
use integradora\Models\producto;
use integradora\Models\especialidad;

class OrdenController extends Controller
{

    public function index()
    {
        $ordenes=Orden::all();
        return view('orden.index')->with('ordenes',Orden::all());
        return view('orden.index',compact('title','ordenes'));

    }
    public function create($id)
    {
        return view('orden.new')
        ->with('factura',Factura::find($id))
        ->with('productos',Producto::all())
        ->with('especialidades',Especialidad::all());
        return view('orden.new',compact('title','Ordenes'));
    }
    public function store(Request $request)
    {

        $this->validate($request,[
            'factura' => ['required'],
            'producto' => ['required'],
            'especialidad' => ['required'],
            'precio' => ['required','numeric'],
            'cantidad' => ['required','numeric'],
            'comentario' => ['']
        ]);

        Orden::create([
            'factura_id' => $request['factura'],
            'producto_id' => $request['producto'],
            'especialidad_id' => $request['especialidad'],
            'precio' => $request['precio'],
            'cantidad' => $request['cantidad'],
            'comentario' => $request['comentario']
        ]);
        return redirect()
        ->route('pedido.addOrden',['id' => $request['factura']]);
    }

    public function show(Orden $orden)
    {
        //
    }

    public function edit(Orden $orden)
    {
        return view('orden.edit')
        ->with('orden',$orden)
        ->with('producto',Producto::all())
        ->with('especialidad',Especialidad::all());
        return view('orden.edit',compact('title','Orden'));
    }

    public function update(Request $request, Orden $orden)
    {
        $data=request()->all();
        $this->validate($request,[
            'producto'=>['required'],
            'producto'=>['required'],
            'precio'=>['required'],
            'cantidad'=>['required'],
            'comentario'=>[''],
        ]);
        $orden->update($data);
        return redirect()->route('inicio');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \integradora\Models\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orden $orden)
    {
        $orden->delete();

        return redirect()
        ->route('inicio');
    }


}
