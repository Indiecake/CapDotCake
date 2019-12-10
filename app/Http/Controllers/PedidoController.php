<?php

namespace integradora\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use integradora\Models\Orden;
use integradora\Models\Producto;
use integradora\Models\Especialidad;
use integradora\Models\Factura;
use integradora\Models\Cliente;

class PedidoController extends Controller
{

    public function index()
    {
        //
    }

    public function addproducto(Request $request, Orden $obj)
    {

    }
    public function nuevaFactura(Request $request)
    {
      $this->validate($request,[
          'telefono' =>['required','numeric'],
          'nombre' =>['required'],
          'apaterno' =>[''],
          'amaterno' =>[''],
          'calle' =>['required'],
          'numero' =>['required','numeric'],
          'colonia' =>['required'],
          'comentario' =>[''],
      ]);
      self::SearchCliente($request);
      $idCli=Cliente::where('telefono',$request->telefono)
      ->where('nombre',$request->nombre)
      ->where('calle', $request->calle)
      ->where('numero',$request->numero)
      ->get()->first();
      $factura=self::nuevaFac($idCli->id , $request);
      return redirect()->route('pedido.addOrden',['id'=>$factura->id]);
    }

    public function createOrden(Request $request)
    {
      $orden = new Orden();
      $orden->factura_id = $request->factura_id;
      $orden->producto_id = $request->producto;
      $orden->especialidad_id = $request->especialidad;
      $orden->cantidad = $request->cantidad;
      $orden->comentario = $request->comentario;
      $orden->save();
    }
    public function nuevaFac($id_Cli , Request $request )
    {
      #Factura::create
      $factura = new factura();
      $factura->cliente_id = $id_Cli;
      $factura->fecha = DB::raw('curdate()');
      $factura->hora = DB::raw('curtime()');
      if ($request->comentario== null) {
        $factura->comentario= "Ninguno.";
      }
      else {
          $factura->comentario = $request->comentario;
      }
      $factura->save();
      return $factura;
    }

    public function updateProducto(Request $request)
    {
      $orden = Orden::find($request->id);
      $orden->producto_id = $request->id;
      $orden->especialidad_id = $request->especialidad;
      $this->validate($request,[
        'cantidad'=>[''],
        'comentario'=>[''],
      ]);
      $orden->cantidad = $request->cantidad;
      $orden->comentario = $request->comentario;
      $orden->save();
    }

    public function SearchCliente(Request $request)
    {

      $cliente = Cliente::where('nombre',$request['nombre'])
      ->where('calle',$request['calle'])
      ->where('numero',$request['numero'])
      ->where('colonia',$request['colonia'])
      ->get()->first();
      if ($cliente == null) {
        $cliente = new Cliente();
        $cliente->id=null;
        $cliente->nombre=$request->nombre;
        $cliente->calle=$request->calle;
        $cliente->numero=$request->numero;
        $cliente->colonia=$request->colonia;
        $cliente->telefono=$request->telefono;
        $cliente->save();
        #dd($cliente);
        return true;
      }
      else {
        return false;
      }

    }

    public function delOrden($id)
    {
      Orden::find($id)->delete();
      return redirect()
      ->route('inicio')
      ->with('facturas',Factura::where('entregada',0)->get());
    }
    public function modOrden($id)
    {
      $cambio = Orden::find($id);
      return view('orden.edit')
      ->with('orden',$cambio)
      ->with('productos',Producto::all())
      ->with('especialidades',Especialidad::all());
    }

    public function create()
    {
        return view('pedido.new')
        ->with('productos',Producto::all())
        ->with('especialidades',Especialidad::all());
        return view('pedido.new', compact('title','Nuevo pedido'));
    }


    public function store(Request $request)
    {
        //
    }

    public function LoadFacturasPendientes()
    {
      return view('welcome')
      ->with('facturas',Factura::where('entregada',0)->get());
    }


    public function show($id)
    {
        return view('pedido.add')
        ->with('factura',Factura::find($id))
        ->with('ordenes',Orden::where('factura_id',$id)->get())
        ->with('productos',Producto::all())
        ->with('especialidades',Especialidad::all());
    }

    public function modFcomment($id, Request $request)
    {
      $cambio=Factura::find($id);
      $cambio->comentario=$request['comentario'];
      $cambio->save();
      return redirect()->route('pedido.addOrden',['id'=>$cambio->id]);
    }

    public function confirmar($id)
    {
      $cambio=Factura::find($id);
      $cambio->entregada=true;
      $cambio->save();
      return redirect()
      ->route('inicio')
      ->with('facturas',Factura::where('entregada',0)->get());
    }
    public function cancelar($id)
    {
      Factura::find($id)->delete();
      return redirect()
      ->route('inicio')
      ->with('facturas',Factura::where('entregada',0)->get());
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
