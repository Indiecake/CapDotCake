@extends('layout')

@section('title','Detalle de factura')

@section('content')
	@inject('control','integradora\Http\Controllers\ReporteController')
<div class="container">
	<div class="row">
	<div class="panel panel-default">
	  <div class="panel-heading">Factura {{$factura->fecha}} ~ {{ $factura->hora }}</div>
	  <div class="panel-body">
	  	<b>Cliente:</b> {{$cliente->nombre}} {{$cliente->apaterno}} {{$cliente->amaterno}}
  		<hr>
  		<b>Telefono:</b> {{$cliente->telefono}}
	  	<hr>
	  	<b>Dirreccion:</b> {{$cliente->calle}} <b>N° </b>{{$cliente->numero}} <b>Col.</b> {{$cliente->colonia}}
	  	<br>
	  	<h4>Orden</h4>
	  </div>
	  	<table class="table table-striped table-responsive">
		<thead>
			<tr>
				<th scope="row">Producto</th>
				<th scope="row">Especialidad</th>
				<th scope="row">Comentario</th>
				<th scope="row">precio por unidad</th>
				<th scope="row">Cantidad</th>

			</tr>
		</thead>
			<tbody>
		@forelse ($ordenes as $orden)
			<tr>
				<td>{{$orden->Producto->nombre}}</td>
				<td>{{$orden->Especialidad->nombre}}</td>
				<td>{{ $orden->comentario }}</td>
				<td>$ {{$orden->precio}}</td>
				<td>{{ $orden->cantidad }}</td>
			</tr>
		@empty
			</tbody>
			</table>
			<div class="content">
			<h1>La factura no cuenta con ninguna orden</h1>
			</div>
		@endforelse
			<tfoot>
				<tr>
					<td><strong>Total:</strong></td>
					<td></td>
					<td></td>
					<td><b>$ {{$control->calcularTotal($factura)}}</b></td>
					<td></td>
				</tr>
			</tfoot>
		</tbody>
		</table>
		<div class="panel-body">
			<div class="col-md-offset-9">
				@if ($factura->entregada==1)
					La orden ha sido entregada
				@else
					La orden no ha sido entregada
				@endif
			</div>
		</div>
	</div>

	<div class="row">
	                <div class="pull-right">
	                    <a href="{!! route('facturas') !!}" class="btn btn-primary">Regresar</a>
	                </div>
	            </div>
</div>
</div>
@endsection
