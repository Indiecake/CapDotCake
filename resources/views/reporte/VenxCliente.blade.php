@extends('layout')

@section('title','Compras por Cliente')

@section('content')

@inject('control','integradora\Http\Controllers\ReporteController')

<div class="container">
	<div class="col">
	 <form class="form-inline" action="{{url("/reportes/comprasPorCliente") }}" autocomplete="off">
	    {{-- csrf_field() --}}
	    <label for="txtNombre">Nombre</label>
	 <input class="form-control mr-sm-2" placeholder="Nombre" type="text" name="nombre" id="txtNombre">
	 <button class="btn btn-primary" type="submit" >Buscar</button>
	 </form>
 </div>
	<div class="row">
	                <div class="pull-right">
	                    <a href="{{ route('reporte.exportarCompuesto') }}" class="btn btn-primary">Exportar a Excel</a>
	                </div>
	                <br>
	            </div>
	            <br>
	            @if (!$clientes->count()==0)


	@foreach ($clientes as $cliente)

		@foreach ($control->getFacturas($cliente) as $factura)
	<div class="panel panel-default">
	  <div class="panel-heading">
	    Folio #{{$factura->id}} ~ {{$factura->fecha}} {{$factura->hora}}
	  </div>
		  <div class="panel-body">
		  	<b>Titular de la Factura:</b> {{$factura->Cliente->nombre}} {{$factura->Cliente->apaterno}} {{$factura->Cliente->amaterno}}
		  	<br>
		  	<b>Detalles de la factura</b>
		</div>

		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Producto</th>
					<th scope="col">Especialidad</th>
					<th scope="col">Precio por unidad</th>
					<th scope="col">cantidad</th>
					<th scope="col">comentario</th>
				</tr>
			</thead>
			@forelse ($factura->Ordenes as $orden)
			<tbody>
				<tr>
					<td>{{$orden->Producto->nombre}}</td>
					<td>{{$orden->Especialidad->nombre}}</td>
					<td>{{ $orden->precio }}</td>
					<td>{{ $orden->cantidad }}</td>
					<td>{{ $orden->comentario }}</td>
				</tr>

			@empty
			</tbody></table>
			<div class="content"><h1>La factura no cuenta con ninguna orden</h1></div>

			@endforelse
			</tbody>


		</table>
		<div class="row">
	                <div class="col-md-offset-9">
	                   total: $ {{$control->calcularTotal($factura)}}
	                </div>
	            </div>
	</div>

	@endforeach
@endforeach

@else
<div class="flex-center position-ref full-height">
    <div class="content">
       <h1> No existe ningun cliente con ese nombre</h1>
    </div>
</div>
@endif
<div class="form-group col-md-12"><a href="{{ route('reportes') }}" class="btn btn-primary">Regresar</a></div>

@endsection
