@extends('layout')

@section('title','Nuevo pedido')

@section('content')

<div class="container">
	<div class="text-center">
		<h3><p><strong>Levantar un nuevo pedido</strong></p></h3>
	</div>

	@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

	<form action="{!! route('pedido.factura') !!}" method="POST" autocomplete="off">
		{{ csrf_field() }}
		<div class="jumbotron">
		 <div class="container">

			 <div class="text-center"><p><strong>Datos de la factura</strong></p></div>

 			<div class="form-group col-xs-12 col-md-4">
 				<label for="txtTelefono">Telefono</label>
 				<input type="text" class="form-control" id="txtTelefono" name="telefono" placeholder="Ingresa el de telefono" value="{{ old('telefono') }}" aria-describedby="descTelefono">
 				<small id="descTelefono">No utilizar espacios entre numeros</small>
 			</div>
 			<div class="form-group col-xs-12 col-md-4">
 				<label for="txtNombre">Titular de la orden</label>
 				<input type="text" class="form-control" id="txtNombre" name="nombre" value="{{ old('nombre') }}" placeholder="Ingresa el nombre del titular" aria-describedby="descNombre">
 				<small id="descNombre">* Campo obligatorio</small>
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
			<div class="form-group col-xs-12 col-md-4">
 				<label for="txtComment">comentario</label>
 				<textarea class="form-control" name="comentario" id="txtComment" placeholder="Notas adicionales a la factura"></textarea>
 			</div>
			<div class="pull-right">
				<a href="{{ route('inicio') }}" class="btn btn-default">Cancelar</a>
				<button class="btn btn-primary" type="submit">Crear Factura</button>
			</div>
		 </div>
		</div>


	<!/form>
</div>

@endsection
