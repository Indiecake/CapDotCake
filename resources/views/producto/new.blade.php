@extends('layout')

@section('title','Nuevo producto')

@section('content')

<div class="container">
	<!--div class="row"-->
		<!--div class="col"-->
		<p>Crear un nuevo producto</p>


		@if ($errors->any())

			<div class="alert alert-danger">
    			<ul>
        			@foreach ($errors->all() as $error)
                		<li>{{ $error }}</li>
            		@endforeach
        		</ul>
    		</div>

		@endif
			<form action="{{ url('productos/crear') }}" method="POST" autocomplete="off">
				{{ csrf_field() }}
				<div class="form-row">
					<div class="form-group col-md-5">
						<label for="txtNombre">Producto</label>
						<input type="text" class="form-control" id="txtNombre" name="nombre" placeholder="Ingrese nombre del producto" value="{{ old('nombre') }}">
					</div>
				
					<div class="form-group col-md-12">
						 <a href="{{ route('productos') }}" class="btn btn-primary">Cancelar</a>
						 <button type="submit" class="btn btn-primary">Guardar</button>
					</div>

				</div>
			</form>
		<!--/div-->
	<!--/div-->

</div>

@endsection
