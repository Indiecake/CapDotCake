<?php

namespace integradora\Http\Controllers;

use integradora\Models\Cliente;
use integradora\Models\Factura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class FacturaController extends Controller
{

    public function index()
    {
        $facturas=Factura::all();

        return view('factura.index')
        ->with('facturas', Factura::where('entregada',true)->get());
        return view('factura.index',compact('title','Factura'));
    }


    public function create()
    {
        $clientes=Cliente::all();

        return view('factura.new')->with('clientes', Cliente::all());
        return view('factura.new',compact('title','facturas'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'cliente'=>['required'],

        ]);
        Factura::create([
            'cliente_id'=>$request['cliente'],
            'fecha'=>DB::raw('curdate()'),
            'hora'=>DB::raw('curtime()'),
        ]);
        return redirect()->route('facturas');
    }


    public function show(Factura $factura)
    {
        //
    }


    public function edit(Factura $factura)
    {
        return view('factura.edit')
        ->with('factura', $factura)
        ->with('clientes',Cliente::all());
        return view('factura.edit',compact('title','factura'));
    }


    public function update(Request $request, Factura $factura)
    {
       $data = request()->all();
       $data['fecha']=DB::raw('now()');
       $this->validate($request,[
            //'cliente_id'=> ['required',Rule::unique('facturas')->ignore($factura->id)],
            'clientes_id'=>[''],
            'fecha'=>['date'],
       ]);
       $factura->update($data);
       return redirect()->route('facturas');
    }


    public function destroy(Factura $factura)
    {
        //
    }
    public function calcularTotal(Factura $factura)
    {
        $total=0;
        $ordenes=$factura->Ordenes;
        foreach ($ordenes as $orden) {
            $total=$total+$orden->Producto->precio;
        }
        return $total;
    }

    public function detalle(Factura $factura)
    {
        return view('factura.view')
        ->with('factura',$factura)
        ->with('cliente',$factura->Cliente)
        ->with('ordenes',$factura->Ordenes)
        ->with('producto',$factura->Producto)
        ->with('especialidad',$factura->Especialidad)
        ->with('total',self::calcularTotal($factura));
    }

}
