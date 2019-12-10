@extends('layout')

@section('title','Nuevo cliente')

@section('content')

<div class="container">
	<!--div class="row"-->
		<!--div class="col"-->
		<p>Agregar nuevo cliente</p>


		@if ($errors->any())
			
			<div class="alert alert-danger">
    			<ul>
        			@foreach ($errors->all() as $error)
                		<li>{{ $error }}</li>
            		@endforeach
        		</ul>
    		</div>

		@endif
			<form action="{{ url("clientes/crear") }}" method="POST" autocomplete="off">
				{{ csrf_field() }}
												
							<div class="form-group col-xs-12 col-md-6">
								<label for="txtTelefono">Telefono</label>
								<input type="text" class="form-control" id="txtTelefono" name="telefono" placeholder="Ingresa el de telefono" value="{{ old('telefono') }}" aria-describedby="descTelefono">
								<small id="descTelefono">No utilizar espacios entre numeros</small>
							</div>							
							<div class="form-group col-xs-12 col-md-6">
								<label for="txtNombre">Nombre</label>
								<input type="text" class="form-control" id="txtNombre" name="nombre" value="{{ old('nombre') }}" placeholder="Ingresa el nombre del cliente" aria-describedby="descNombre">
								<small id="descNombre">* Campo obligatorio</small>
							</div>
							<div class="form-group col-xs-12 col-md-6">
								<label for="txtApaterno">Apellido paterno</label>
								<input type="text" class="form-control" name="apaterno" value="{{ old('apaterno') }}" id="txtApaterno" placeholder="Ingresa el Apellido paterno del cliente">
							</div>
							<div class="form-group col-xs-12 col-md-6">
								<label for="txtAmaterno">Apellido materno</label>
								<input type="text" class="form-control" name="amaterno" value="{{ old('amaterno') }}" id="txtAmaterno" placeholder="Ingresa el Apellido materno del cliente">
							</div>						
							<div class="form-group col-xs-12 col-md-4">
								<label for="txtCalle">Calle</label>
								<input type="text" class="form-control" name="calle" value="{{ old('calle') }}" id="txtCalle" placeholder="Introduce la Calle del domicilo del cliente" aria-describedby="descCalle">
								<small id="descCalle">* Campo obligatorio</small>
							</div>
							<div class="form-group col-xs-12 col-md-4">
								<label for="txtNumero">Numero</label>
								<input type="text" class="form-control" name="numero" value="{{ old('numero') }}" id="txtNumero" placeholder="Introduce el numero de la casa del cliente" aria-describedby="descNumero">
								<small id="descNumero">* Campo obligatorio</small>
							</div>
							<div class="form-group col-xs-12 col-md-4">
								<label for="txtColonia">Colonia</label>
								<input type="text" class="form-control" name="colonia" value="{{ old('colonia') }}" id="txtColonia" placeholder="Introduce la colonia en donde se ubica el domicilo del cliente" aria-describedby="descColonia">
								<small id="descColonia">* Campo obligatorio</small>
							</div>
						</div>
						<div class="container">
						<div class="form-group col-md-12">
						 <a href="{{ route('clientes') }}" class="btn btn-primary">Cancelar</a>	
						 <button type="submit" class="btn btn-primary">Guardar Cambios</button>
					</div>
					</form>
		<!--/div-->
	<!--/div-->
	
</div>

@endsection