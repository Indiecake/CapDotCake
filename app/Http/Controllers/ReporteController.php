<?php

namespace integradora\Http\Controllers;

use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use integradora\Models\Cliente;
use integradora\Models\Especialidad;
use integradora\Models\Factura;
use integradora\Models\Ingrediente;
use integradora\Models\Orden;
use integradora\Models\Producto;
use Maatwebsite\Excel\Facades\Excel;

class ReporteController extends Controller
{
	public function index()
	{
		return view('reporte.index',compact('title','Reportes'));
	}

    public function generalCliente()
    {
    	return view('reporte.gCliente')->with('clientes',Cliente::all());
    }

    public function generalProducto()
    {
    	return view('reporte.gProducto')->with('productos',Producto::all());
    }

    public function generalEspecialidad()
    {
    	return view('reporte.gEspecialidad')->with('especialidades',Especialidad::all());
    }

    public function generalIngrediente()
    {
    	return view('reporte.gIngrediente')->with('ingredientes',Ingrediente::all());
    }

    public function generalOrden()
    {
    	return view('reporte.gOrden')->with('ordenes',Orden::all());
    }

    public function generalFactura()
    {
        return view('reporte.gFactura')->with('facturas',Factura::where('entregada',true)->get());
    }

    public function fechaFactura(Request $request)
    {
    	if ($request['ini']==null||$request['fin']==null) {
         return view('reporte.periodo')
         ->with('facturas',Factura::where('entregada',true)->get())
         ->with('total',self::ValorTotal())
         ->with('ini', Factura::where('entregada',true)->get()->sortBy('fecha')->first()->fecha)
         ->with('fin', Factura::where('entregada',true)->get()->sortBy('fecha')->last()->fecha);
        }
        else{
            $filtrado=Factura::where('fecha','>=',$request['ini'])->where('fecha','<=',$request['fin'])->get();
            return view('reporte.periodo')
            ->with('facturas',$filtrado)
            ->with('total',self::TotalFiltrado($filtrado))
            ->with('ini', $request['ini'])
            ->with('fin', $request['fin']);
        }
    }
    public function sumarioFactura()
    {
        return view('reporte.sumario')
        ->with('facturas',Factura::where('entregada', true)->get());
    }
    public function calcularTotal(Factura $factura)
    {
        $total=0;
        $ordenes=$factura->Ordenes;
        foreach ($ordenes as $orden) {
            //$total=$total+$orden->Producto->precio;//cambio del calculo del total
						$total = $total + ($orden->precio * $orden->cantidad);
        }
        return $total;
    }
    public function ValorTotal()
    {
        $granTotal=0;
        $facturas=Factura::where('entregada',true)->get();
        foreach ($facturas as $factura) {
           $granTotal=$granTotal+self::calcularTotal($factura);
        }
        return $granTotal;
    }

    public function TotalFiltrado($facturas)
    {
        $granTotal=0;
        //$facturas=Factura::all();
        foreach ($facturas as $factura) {
           $granTotal=$granTotal+self::calcularTotal($factura);
        }
        return $granTotal;
    }

    public function exportarPeriodo(Request $request)
    {

        if ($request['ini']==null||$request['fin']==null) {
            Excel::create('Reporte por periodo '.date("Y-m-d"), function($excel) {

            $excel->sheet('Datos',function($sheet) {

                //header
                $sheet->mergeCells('A1:D1');
                $sheet->row(1, ['Reporte por periodo']);
                $sheet->setBorder('A1:D1','thin');
                $sheet->row(2,['Folio','Cliente','Fecha','Hora']);
                $sheet->setBorder('A2:D2','thin');
                $sheet->cells("A2:D2",function($cells){
                      $cells->setBackground('#99ccff');
                    });


                $n=3;
                //data
                $facturas=Factura::where('entregada',true)->get();
								dd($facturas);
                $sheet->setOrientation('landscape');
                //$sheet->fromArray($datos);
                foreach ($facturas as $factura) {
                    $row=[];
                    $row[0]= $factura->id;
                    $row[1]= $factura->Cliente->nombre;
                    $row[2]= $factura->fecha;
                    $row[3]= $factura->hora;

                    $sheet->appendRow($row);
                    $sheet->setBorder("A{$n}:D{$n}");

                    $n++;#
                }

            });
        })->export('xls');
        }
        else{
            $filtrado=Factura::where('fecha','>=',$request['ini'])->where('fecha','<=',$request['fin'])->get();

            Excel::create('Reporte del periodo '.$request['ini'].' - '.$request['fin'], function($excel) use($filtrado,$request) {

            $excel->sheet('Datos',function($sheet) use($filtrado,$request) {

                //header
                $sheet->mergeCells('A1:D1');
                $sheet->row(1, ['Reporte por periodo '.$request['ini'].' - '.$request['fin']]);
                $sheet->setBorder('A1:D1','thin');
                $sheet->row(2,['Folio','Cliente','Fecha','Hora']);
                $sheet->setBorder('A2:D2','thin');
                $sheet->cells("A2:D2",function($cells){
                      $cells->setBackground('#99ccff');
                    });


                $n=3;
                //data
                $datos=$filtrado;
                $sheet->setOrientation('landscape');
                //$sheet->fromArray($datos);
                foreach ($datos as $dato) {
                    $row=[];
                    $row[0]= $dato->id;
                    $row[1]= $dato->Cliente->nombre;
                    $row[2]= $dato->fecha;
                    $row[3]= $dato->hora;

                    $sheet->appendRow($row);
                    $sheet->setBorder("A{$n}:D{$n}",'thin');

                    $n++;#
                }

            });
        })->export('xls');
        }
    }

    public function test($ini,$fin)
    {
        $filtrado=Factura::where('fecha','>=',$ini)->where('fecha','<=',$fin)->get();

        Excel::create('Reporte por periodo', function($excel) use($filtrado,$ini,$fin) {

        $excel->sheet('Datos',function($sheet) use($filtrado,$ini,$fin) {

            //header
            $sheet->mergeCells('A1:D1');
            $sheet->row(1, ['Reporte por periodo'.$ini.' - '.$fin]);
            $sheet->setBorder('A1:D1','thin');
            $sheet->row(2,['Folio','Cliente','Fecha','Hora']);
            $sheet->setBorder('A2:D2','thin');
            $sheet->cells("A2:D2",function($cells){
                  $cells->setBackground('#99ccff');
                });


            $n=3;
            //data
            $datos=$filtrado;
            $sheet->setOrientation('landscape');
            //$sheet->fromArray($datos);
            foreach ($datos as $dato) {
                $row=[];
                $row[0]= $dato->id;
                $row[1]= $dato->Cliente->nombre;
                $row[2]= $dato->fecha;
                $row[3]= $dato->hora;

                $sheet->appendRow($row);
                $sheet->setBorder("A{$n}:D{$n}",'thin');

                $n++;#
            }

        });
        })->export('xls');

    }

    public function exportarSumario()
    {
        Excel::create('Reporte sumario', function($excel) {

            $excel->sheet('Datos',function($sheet) {

                //header
                $sheet->setBorder('A1:D1','thin');
                $sheet->setBorder('A2:D2','thin');
                $sheet->mergeCells('A1:D1');
                $sheet->row(1, ['Reporte por sumario']);
                $sheet->mergeCells('A2:C2');
                $sheet->row(2,['granTotal','','','$ '.self::ValorTotal()]);


                //data
                $datos=Factura::where('entregada',true)->get();
                $detalles;
                $n=3;
                $sheet->setOrientation('landscape');
                //$sheet->fromArray($datos);
                foreach ($datos as $dato) {
                    $colu=[
                        0 => 'Factura',
                        1 => 'Cliente',
                        2 => 'Fecha',
                        3 => 'Hora',
                    ];
                    $sheet->appendRow($colu);
                    $sheet->setBorder("A{$n}:D{$n}",'thin');
                    $sheet->cells("A{$n}:D{$n}",function($cells){
                      $cells->setBackground('#99ccff');
                    });

                    $n++;#

                    $row=[
                        0 => $dato->id,
                        1 => $dato->Cliente->nombre,
                        2 => $dato->fecha,
                        3 => $dato->hora,
                    ];
                    $allOrdenes=$dato->Ordenes;
                    $sheet->appendRow($row);
                    $sheet->setBorder("A{$n}:F{$n}",'thin');
                    $n++;
                    foreach ($allOrdenes as $orden) {
                        //$n++;
                        $tip=[
                            0 => 'Orden',
														1 => 'Producto',
                            2 => 'Especialidad',
                            3 => 'Precio por unidad',
														4 => 'Cantidad',
														5 => 'Comentario',
                        ];
                        $sheet->appendRow($tip);
                        $sheet->setBorder("A{$n}:F{$n}",'dashed');
                          /*  $sheet->cells("A{$n}:F{$n}",function($cells){
                            $cells->setBackground('#9999FF');
													}); */
                        $n++;#

                        $fila=[
                            0 => $orden->id,
														1 => $orden->Producto->nombre,
                            2 => $orden->Especialidad->nombre,
                            3 => $orden->precio,
														4 => $orden->cantidad,
														5 => $orden->comentario,
                        ];

                        $sheet->appendRow($fila);
                        $sheet->setBorder("A{$n}:F{$n}",'thin');
                        $n++;#
                    }
                    $n+$dato->Ordenes->count();
                    $fila=[
                        0 => '',
                        1 =>'',
                        2 => 'Total',
                        3 => self::calcularTotal($dato),
                    ];
                    $sheet->appendRow($fila);
                    $sheet->setBorder("C{$n}:D{$n}",'thin');
                    $n++;#
                }
            });
        })->export('xls');
    }

    public function exportarBasico($modelo)
    {
        if ($modelo=='facturas') {
            Excel::create('Reporte general de facturas', function($excel) {

            $excel->sheet('facturas',function($sheet) {

                //header
                $sheet->mergeCells('A1:C1');
                $sheet->row(1, ['Reporte general de facturas']);
                $sheet->row(2,['Folio','Fecha','Hora']);
                $sheet->setBorder('A1:C1','thin');
                $sheet->setBorder('A2:C2','thin');
                $sheet->cells("A2:C2",function($cells){
                    $cells->setBackground('#99ccff');
                });
                $n=3;
                //data
                $datos=Factura::where('entregada', true)->get();
                $sheet->setOrientation('landscape');
                //$sheet->fromArray($datos);
                foreach ($datos as $dato) {
                    $row=[];
                    $row[0]= $dato->id;
                    $row[1]= $dato->fecha;
                    $row[2]= $dato->hora;
                    $sheet->appendRow($row);
                    $sheet->setBorder("A{$n}:C{$n}",'thin');
                    $n++;
                }

            });
        })->export('xls');
        }
        if ($modelo=='productos') {
            Excel::create('Reporte general de productos', function($excel) {

            $excel->sheet('Productos',function($sheet) {

                //header
                $sheet->mergeCells('A1:C1');
                $sheet->row(1, ['Reporte general de productos']);
                $sheet->row(2,['Folio','Nombre','Precio']);
                $sheet->setBorder('A1:C1','thin');
                $sheet->setBorder('A2:C2','thin');
                $sheet->cells("A2:C2",function($cells){
                    $cells->setBackground('#99ccff');
                });
                $n=3;
                //data
                $datos=Producto::all();
                $sheet->setOrientation('landscape');
                //$sheet->fromArray($datos);
                foreach ($datos as $dato) {
                    $row=[];
                    $row[0]= $dato->id;
                    $row[1]= $dato->nombre;
                    $row[2]= $dato->precio;
                    $sheet->appendRow($row);
                    $sheet->setBorder("A{$n}:C{$n}",'thin');
                    $n++;
                }

            });
        })->export('xls');
        }
        if ($modelo=='especialidades') {
            Excel::create('Reporte general de especialidades', function($excel) {

            $excel->sheet('Especialidades',function($sheet) {

                //header
                $sheet->mergeCells('A1:D1');
                $sheet->row(1, ['Reporte general de especialidades']);
                $sheet->row(2,['Folio','Nombre']);
                $sheet->setBorder('A1:D1','thin');
                $sheet->setBorder('A2:B2','thin');
                $sheet->cells("A2:B2",function($cells){
                    $cells->setBackground('#99ccff');
                });
                $n=3;
                //data
                $datos=Especialidad::all();
                $sheet->setOrientation('landscape');
                //$sheet->fromArray($datos);
                foreach ($datos as $dato) {
                    $row=[];
                    $row[0]= $dato->id;
                    $row[1]= $dato->nombre;
                    $sheet->appendRow($row);
                    $sheet->setBorder("A{$n}:B{$n}",'thin');
                    $n++;
                }

            });
        })->export('xls');
        }
        if ($modelo=='ingredientes') {
            Excel::create('Reporte general de ingredientes', function($excel) {

            $excel->sheet('Ingredientes',function($sheet) {

                //header
                $sheet->mergeCells('A1:D1');
                $sheet->row(1, ['Reporte general de ingredientes']);
                $sheet->row(2,['Folio','Nombre']);
                $sheet->setBorder('A1:D1','thin');
                $sheet->setBorder('A2:B2','thin');
                $sheet->cells("A2:B2",function($cells){
                    $cells->setBackground('#99ccff');
                });
                $n=3;
                //data
                $datos=Ingrediente::all();
                $sheet->setOrientation('landscape');
                //$sheet->fromArray($datos);
                foreach ($datos as $dato) {
                    $row=[];
                    $row[0]= $dato->id;
                    $row[1]= $dato->nombre;
                    $sheet->appendRow($row);
                    $sheet->setBorder("A{$n}:B{$n}",'thin');
                    $n++;
                }

            });
        })->export('xls');
        }
        if ($modelo="ordenes") {
            Excel::create('Reporte general de ordenes', function($excel) {

            $excel->sheet('Ordenes',function($sheet) {

                //header
                $sheet->mergeCells('A1:C1');
                $sheet->row(1, ['Reporte general de ordenes']);
                $sheet->row(2,['Factura','Producto','Especialidad']);
                $sheet->setBorder('A1:D1','thin');
                $sheet->setBorder('A2:C2','thin');
                $sheet->cells("A2:C2",function($cells){
                    $cells->setBackground('#99ccff');
                });
                $n=3;
                //data
                $datos=Orden::all();
                $sheet->setOrientation('landscape');
                //$sheet->fromArray($datos);
                foreach ($datos as $dato) {
                    $row=[];
                    $row[0]= $dato->Factura->fecha.' - '.$dato->Factura->hora;
                    $row[1]= $dato->Producto->nombre;
                    $row[2]= $dato->Especialidad->nombre;
                    $sheet->appendRow($row);
                    $sheet->setBorder("A{$n}:C{$n}",'thin');
                    $n++;
                }

            });
        })->export('xls');
        }
        else{
            //
        }
    }

    public function ventasXcliente(Request $request)
    {
        if ($request['nombre']==null) {
            return view('reporte.VenxCliente')
            ->with('clientes',Cliente::all());
        }
        else{
            $clientes=Cliente::where('nombre','like',"%{$request['nombre']}%")->get();

            return view('reporte.VenxCliente')
            ->with('clientes',$clientes);
        }
    }

    public function exportarVentasXcliente()
    {
        Excel::create('Reporte por de ventas por clientes', function($excel) {

            $excel->sheet('Datos',function($sheet) {

                $datos=Factura::where('entregada',true)->get();
                //header
                $sheet->setBorder('A1:D1','thin');
                $sheet->mergeCells('A1:D1');
                $sheet->row(1, ['Reporte por de compras por clientes']);
                //data

                $detalles;
                $n=2;
                $sheet->setOrientation('landscape');
                //$sheet->fromArray($datos);
                foreach ($datos as $dato) {
                    $colu=[
                        0 => 'Factura',
                        1 => 'Cliente',
                        2 => 'Fecha',
                        3 => 'Hora',
                    ];
                    $sheet->appendRow($colu);
                    $sheet->setBorder("A{$n}:D{$n}",'thin');
                    $sheet->cells("A{$n}:D{$n}",function($cells){
                      $cells->setBackground('#99ccff');
                    });

                    $n++;#

                    $row=[
                        0 => $dato->id,
                        1 => $dato->Cliente->nombre,
                        2 => $dato->fecha,
                        3 => $dato->hora,
                    ];
                    $allOrdenes=$dato->Ordenes;
                    $sheet->appendRow($row);
                    $sheet->setBorder("A{$n}:D{$n}",'thin');
                    $n++;
                    foreach ($allOrdenes as $orden) {
                        //$n++;
                        $tip=[
                            0 => 'Orden',
                            1 => 'Especialidad',
                            2 => 'Producto',
                            3 => 'Precio',
                        ];
                        $sheet->appendRow($tip);
                        $sheet->setBorder("A{$n}:D{$n}",'thin');
                            $sheet->cells("A{$n}:D{$n}",function($cells){
                            $cells->setBackground('#FFC300');
                            });
                        $n++;#

                        $fila=[
                            0 => $orden->id,
                            1 => $orden->Especialidad->nombre,
                            2 => $orden->Producto->nombre,
                            3 => $orden->Producto->precio,
                        ];

                        $sheet->appendRow($fila);
                        $sheet->setBorder("A{$n}:D{$n}",'thin');
                        $n++;#
                    }
                    $n+$dato->Ordenes->count();
                    $fila=[
                        0 => '',
                        1 =>'',
                        2 => 'Total',
                        3 => self::calcularTotal($dato),
                    ];
                    $sheet->appendRow($fila);
                    $sheet->setBorder("C{$n}:D{$n}",'thin');
                    $n++;#
                }
            });
        })->export('xls');
    }

    public function getFacturas(Cliente $cliente)
    {
        $facturas=$cliente->facturas;
        return $facturas;
    }

    public function ventasXproducto(Request $request)
    {
        if ($request['Producto']==null)
        {
            return view('reporte.ventasXproducto')
            ->with('productos',Producto::all())
            ->with('combos',Producto::all());
        }
        else{
            $filtrado=Producto::where($request['producto']);
            return view('reporte.ventasXproducto')
            ->with('productos',$filtrado)
            ->with('combos',Producto::all());

        }
    }

    public function getOrdenes(Producto $producto)
    {
        $ordenes=$producto->Ordenes;
        return $ordenes;
    }

    public function compraXproducto()
    {
       //$datos=Orden::all()->Unique('producto_id')->sortBy('producto_id');
       $query=DB::table('ordenes')->join('productos','ordenes.producto_id','=','productos.id')->select(DB::raw("nombre,count('producto_id')as veces"))->groupBy('producto_id')->get();

       return view('reporte.compraXproducto')->with('productos',$query);
    }
    public function exportarCompraXproducto()
    {
        Excel::create('Reporte veces vendidas por producto', function($excel) {

            $excel->sheet('Ingredientes',function($sheet) {

                //header
                $sheet->mergeCells('A1:C1');
                $sheet->row(1, ['Reporte Compuesto']);
                $sheet->row(2,['Nombre','Veces']);
                $sheet->setBorder('A1:C1','thin');
                $sheet->setBorder('A2:B2','thin');
                $sheet->cells("A2:B2",function($cells){
                    $cells->setBackground('#99ccff');
                });
                $n=3;
                //data
                $datos=DB::table('ordenes')
                ->join('productos','ordenes.producto_id','=','productos.id')
                ->select(DB::raw("nombre,count('producto_id')as veces"))
                ->groupBy('producto_id')
                ->get();
                $sheet->setOrientation('landscape');
                //$sheet->fromArray($datos);
                foreach ($datos as $dato) {
                    $row=[
                        0 => $dato->nombre,
                        1 => $dato->veces,
                    ];
                    $sheet->appendRow($row);
                    $sheet->setBorder("A{$n}:B{$n}",'thin');
                    $n++;
                }

            });
        })->export('xls');
    }

}
