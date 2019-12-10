@extends('layout')

@section('title','Modificar Especialidad')

@section('content')

<div class="container">
	
	<p>Editar la especialidad " {{$especialidad->nombre}} "</p>

	@if ($errors->any())
			
			<div class="alert alert-danger">
    			<ul>
        			@foreach ($errors->all() as $error)
                		<li>{{ $error }}</li>
            		@endforeach
        		</ul>
    		</div>

		@endif

			<form method="POST" action="{{ url("especialidades/$especialidad->id/mod") }}" autocomplete="off">
				{{ method_field('PUT') }}
				{{ csrf_field() }}
				<div class="form-row">
					<div class="form-group col-md-5">
						<label for="txtNombre">Especialidad</label>
						<input type="text" class="form-control" id="txtNombre" name="nombre" value="{{ old('nombre', $especialidad->nombre) }}">
					</div>
					<div class="form-group col-md-12">
						 <a href="{{ route('especialidades') }}" class="btn btn-primary">Cancelar</a>	
						 <button type="submit" class="btn btn-primary">Guardar Cambios</button>
					</div>

				</div>
			</form>
	
	
</div>

@endsection