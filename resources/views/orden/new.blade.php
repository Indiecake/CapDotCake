@extends('layout')

@section('title','Nueva orden')

@section('content')

<div class="container">
	<!--div class="row"-->
		<!--div class="col"-->
<p>Agregar el pedido</p>


@if ($errors->any())

	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
        		<li>{{ $error }}</li>
    		@endforeach
		</ul>
	</div>

@endif
	<form action="{{ url('ordenes/crear') }}" method="POST" autocomplete="off">
		{!! csrf_field() !!}
		<div class="form-row">
			<input id="txtFactura" hidden name="factura" value="{{ $factura->id }}"></input>
			<div class="form-group col-xs-12 col-md-4">
				<label for="txtProducto">Producto</label>
				<select class="form-control" id="txtProducto" name="producto" value="{{ old('producto') }}">
					<option value="0" disabled="true" selected>Selecciona un Producto</option>
					@foreach ($productos as $producto)
						<option value="{{ $producto->id }}">{{ $producto->nombre}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group col-xs-12 col-md-4">
				<label for="txtEspecialidad">Especialidad</label>
				<select class="form-control" id="txtEspecialidad" name="especialidad" value="{{ old('especialidad') }}">
					<option value="0" disabled="true" selected>Selecciona una Especialidad</option>
					@foreach ($especialidades as $especialidad)
						<option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group col-xs-12 col-md-4">
				<label for="precio">precio</label>
				<input type="number" step="0.01" class="form-control" name="precio" min="1" value="{{ old('precio') }}" placeholder="ingrese el numero de unidades">
			</div>
			<div class="form-group col-xs-12 col-md-4">
				<label for="cantidad">Cantidad</label>
				<input type="number" class="form-control" min="1" name="cantidad" value="{{ old('cantidad') }}" placeholder="ingrese el numero de unidades">
			</div>
			<div class="form-group col-xs-12 col-md-4">
				<label for="txtComentario">Comentario</label>
				<textarea class="form-control" name="comentario" id="txtComentario" cols="30" rows="4">{{ old('comentario') }}</textarea>
			</div>
			<div class="form-group col-md-12">
				 <a href="{{ route('inicio') }}" class="btn btn-primary">Cancelar</a>
				 <button type="submit" class="btn btn-primary">Guardar</button>
			</div>

		</div>
			</form>
		<!--/div-->
	<!--/div-->

</div>

@endsection
