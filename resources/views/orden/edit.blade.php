@extends('layout')

@section('title','Modificar pedido')

@section('content')

<div class="container">
	<p>Editar el pedido. </p>

	@if ($errors->any())
			<div class="alert alert-danger">
    			<ul>
        			@foreach ($errors->all() as $error)
                		<li>{{ $error }}</li>
            		@endforeach
        		</ul>
    		</div>
	@endif
	<div class="row">
		<div class="col">
			<form action="{{ url("ordenes/$orden->id/mod") }}" method="POST" autocomplete="off">
				{{ method_field('PUT') }}
				{!! csrf_field() !!}
				<div class="form-group col-xs-12 col-md-4">
	 		 		<label for="cmbProducto">Producto</label>
	 		 		<select name="producto" id="cmbProducto" value="{{ old('producto') }}" class="form-control">
	 		 			<option value="{{ $orden->producto_id }}" selected> {{ $orden->Producto->nombre }}</option>
	 		 			@foreach ($productos as $producto)
	 		 				<option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
	 		 			@endforeach
	 		 		</select>
	 		 	</div>
	 		 	<div class="form-group col-xs-12 col-md-4">
	 		 		<label for="cmbEspecialidad">Especialidad</label>
	 		 		<select name="especialidad" id="cmbEspecialidad" value="{{ old('especialidad') }}" class="form-control">
	 		 			<option value="{{ $orden->especialidad_id }}" selected> {{ $orden->Especialidad->nombre }}</option>
	 		 			@foreach ($especialidades as $especialidad)
	 		 				<option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
	 		 			@endforeach
	 		 		</select>
	 		 	</div>
				<div class="form-group col-xs-12 col-md-4">
	 		 		<label for="precio">precio</label>
	 		 		<input type="number" step="0.01" class="form-control" name="precio" min="1" value="{{ old('precio') }}{{ $orden->precio }}" placeholder="ingrese el numero de unidades">
	 		 	</div>
	 		 	<div class="form-group col-xs-12 col-md-4">
	 		 		<label for="cantidad">Cantidad</label>
	 		 		<input type="number" class="form-control" min="1" name="cantidad" value="{{ old('cantidad') }}{{ $orden->cantidad }}" placeholder="ingrese el numero de unidades">
	 		 	</div>
	 		 	<div class="form-group col-xs-12 col-md-4">
					<label for="txtComentario">Comentario</label>
	 		 		<textarea class="form-control" name="comentario" id="txtComentario" cols="30" rows="4">{{ old('comentario') }}{{ $orden->comentario }}</textarea>
	 		 	</div>
					<div class="form-group col-md-12">
						 <a href="{{ url()->previous() }}" class="btn btn-primary">Cancelar</a>
						 <button type="submit" class="btn btn-primary">Guardar</button>
					</div>

				</div>
			</form>
		</div>
	</div>

</div>

@endsection
