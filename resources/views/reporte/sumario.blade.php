@extends('layout')

@section('title','Reporte Sumario')

@section('content')

@inject('control','integradora\Http\Controllers\ReporteController')

<div class="container">
	<div class="row">
	                <div class="col-md-offset-10">
	                    <a href="{{ route('reporte.expSumario') }}" class="btn btn-primary">Exportar a Excel</a>
	                </div>
	                <br>
	            </div>
	@foreach ($facturas as $factura)
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
					<td>{{ $orden->Producto->nombre }}</td>
					<td>{{ $orden->Especialidad->nombre }}</td>
					<td>$ {{ $orden->precio }}</td>
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

	<div class="row">
	                <div class="col-md-offset-9">
	                    <h3>Gran total: $ {{$control->ValorTotal()}}</h4>
	                </div>
	            </div>
	            <hr>
	            <br>
	            <div class="form-group col-md-12"><a href="{{ route('inicio') }}" class="btn btn-primary">Regresar</a></div>
	            <br><br>
</div>



@endsection
