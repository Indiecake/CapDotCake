@extends('layout')

@section('title','Nueva Factura')

@section('content')

<div class="container">
	<!--div class="row"-->
		<!--div class="col"-->
		<p>Crear una Nueva Factura</p>


		@if ($errors->any())
			
			<div class="alert alert-danger">
    			<ul>
        			@foreach ($errors->all() as $error)
                		<li>{{ $error }}</li>
            		@endforeach
        		</ul>
    		</div>

		@endif
			<form action="{{ url('facturas/crear') }}" method="POST" autocomplete="off">
				{!! csrf_field() !!}
				<div class="form-row">
					<div class="form-group col-md-5">
						<label for="txtCliente">cliente</label>
						<select class="form-control" id="txtCliente" name="cliente" value="{{ old('nombre') }}">
							<option value="0" disabled="true" selected>Selecciona un cliente</option>
							@foreach ($clientes as $cliente)
								<option value="{{ $cliente->id }}">{{ $cliente->nombre}}</option>
							@endforeach
						</select>
					</div>
					
					<div class="form-group col-md-12">
						 <a href="{{ route('facturas') }}" class="btn btn-primary">Cancelar</a>	
						 <button type="submit" class="btn btn-primary">Guardar</button>
					</div>

				</div>
			</form>
		<!--/div-->
	<!--/div-->
	
</div>

@endsection