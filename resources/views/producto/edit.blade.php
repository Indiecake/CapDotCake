@extends('layout')

@section('title','Modificar producto')

@section('content')

<div class="container">

	<p>Editar el producto {{$producto->nombre}}</p>

	@if ($errors->any())

			<div class="alert alert-danger">
    			<ul>
        			@foreach ($errors->all() as $error)
                		<li>{{ $error }}</li>
            		@endforeach
        		</ul>
    		</div>

		@endif

			<form method="POST" action="{{ url("productos/$producto->id/mod") }}" autocomplete="off">
				{{ method_field('PUT') }}
				{{ csrf_field() }}
				<div class="form-row">
					<div class="form-group col-md-5">
						<label for="txtNombre">Producto</label>
						<input type="text" class="form-control" id="txtNombre" name="nombre" placeholder="Ingrese el nuevo producto" value="{{ old('nombre',$producto->nombre) }}">
					</div>
					
					<div class="form-group col-md-12">
						 <a href="{{ route('productos') }}" class="btn btn-primary">Cancelar</a>
						 <button type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</div>
			</form>

</div>

@endsection
