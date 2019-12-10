@extends('layout')

@section('title','Modificar Factura')

@section('content')

<div class="container">
	<p>Editar la factura </p>

	@if ($errors->any())

			<div class="alert alert-danger">
    			<ul>
        			@foreach ($errors->all() as $error)
                		<li>{{ $error }}</li>
            		@endforeach
        		</ul>
    		</div>

		@endif
	<!div class="row">
		<!div class="col">
			<form action="{{ url("facturas/$factura->id/mod") }}" method="POST" autocomplete="off">
				{{ method_field('PUT') }}
				{!! csrf_field() !!}
				<div class="form-row">
					<div class="form-group col-md-5">
						<label for="txtCliente">cliente</label>
						<select class="form-control" id="txtCliente" name="cliente_id" value="{{ old('nombre') }}">
							<option value="{{ $factura->Cliente->id }}" selected>{{$factura->Cliente->nombre}}</option>
							@foreach ($clientes as $cliente)
								<option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group col-md-12">
						 <a href="{{ route('facturas') }}" class="btn btn-primary">Cancelar</a>
						 <button type="submit" class="btn btn-primary">Guardar</button>
					</div>

				</div>
			</form>
		<!/div>
	<!/div>

</div>

@endsection
