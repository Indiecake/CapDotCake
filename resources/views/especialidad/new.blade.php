@extends('layout')

@section('title','Nueva Especialidad')

@section('content')

<div class="container">
	<!--div class="row"-->
		<!--div class="col"-->
		<p>Crear una Nueva especialidad</p>


		@if ($errors->any())
			
			<div class="alert alert-danger">
    			<ul>
        			@foreach ($errors->all() as $error)
                		<li>{{ $error }}</li>
            		@endforeach
        		</ul>
    		</div>

		@endif
			<form action="{{ url('especialidades/crear') }}" method="POST" autocomplete="off">
				{!! csrf_field() !!}
				<div class="form-row">
					<div class="form-group col-md-5">
						<label for="txtNombre">Especialidad</label>
						<input type="text" class="form-control" id="txtNombre" name="nombre" placeholder="Ingresa la nueva Especialidad" value="{{ old('nombre') }}">
					</div>
					<div class="form-group col-md-12">
						 <a href="{{ route('especialidades') }}" class="btn btn-primary">Cancelar</a>	
						 <button type="submit" class="btn btn-primary">Guardar</button>
					</div>

				</div>
			</form>
		<!--/div-->
	<!--/div-->
	
</div>

@endsection