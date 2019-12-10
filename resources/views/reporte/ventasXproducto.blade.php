@extends('layout')

@section('title','Compras por Cliente')

@section('content')

@inject('control','integradora\Http\Controllers\ReporteController')

<div class="container">
	<div class="col">
	 <form class="form-inline" action="{{url("/reportes/ventasPorProducto") }}" autocomplete="off">
	    {{-- csrf_field() --}}
	    <label for="txtProducto">Productos</label>
						<select class="form-control" id="txtProducto" name="producto" value="{{ old('factura') }}">
							<option value="0" disabled="true" selected>Selecciona una Factura</option>
							@foreach ($combos as $prod)
								<option value="{{ $prod->id }}">{{ $prod->nombre}}</option>
							@endforeach
						</select>
	 <button class="btn btn-primary" type="submit" >Buscar</button>
	 </form>
 </div>
	<div class="row">
	                <div class="col-md-offset-11">
	                    <a href="#" class="btn btn-primary">Exportar a Excel</a>
	                </div>
	                <br>
	            </div>
	            @if (!$productos->count()==0)
	            	
	            
	@foreach ($productos as $producto)			
		@foreach ($control->getOrdenes($producto) as $ordenes)
		@if (!$ordenes->count()==0)
			
		
			@foreach ($ordenes as $orden)
			
		
	<div class="panel panel-default">
	  <div class="panel-heading">
	    Folio #{{$orden->Factura->id}} ~ {{$orden->Factura->fecha}} {{$orden->Factura->hora}}
	  </div>
		  <div class="panel-body">
		  	<b>Titular de la Factura:</b> {{$orden->Factura->Cliente->nombre}} {{$orden->Factura->Cliente->apaterno}} {{$orden->Factura->Cliente->amaterno}}
		  	<br>
		  	<b>Detalles de la factura</b>
		</div>
		
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Producto</th>
					<th scope="col">Especialidad</th>
					<th scope="col">Costo</th>
				</tr>
			</thead>
			@forelse ($orden->Factura->Ordenes as $ordenn)
			<tbody>
				<tr>
					<td>{{$ordenn->Producto->nombre}}</td>
					<td>{{$ordenn->Especialidad->nombre}}</td>
					<td>$ {{$ordenn->Producto->precio}}</td>
				</tr>

			@empty
			</tbody></table>
			<div class="content"><h1>La factura no cuenta con ninguna orden</h1></div>

			@endforelse
			</tbody>
			
			
		</table>
		<div class="row">
	                <div class="col-md-offset-9">
	                   total: $ {{$control->calcularTotal($orden->Factura)}}
	                </div>
	            </div>
	</div>
@endforeach
@else
	<div class="content"><h1>Ese Producto aun no ha sido vendido</h1></div>
@endif
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