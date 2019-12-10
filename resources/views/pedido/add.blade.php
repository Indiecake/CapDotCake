@extends('layout')

@section('title','Nuevo pedido')

@section('content')

@inject('control','integradora\Http\Controllers\ReporteController')

<div id="listar" class="container">

	@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

	<div class="panel panel-default">
		<div class="panel-heading">Factura {{$factura->fecha}} ~ {{ $factura->hora }}
				<div class="pull-right"><a href="{!! route('inicio') !!}" class="btn btn-default btn-xs">Regresar al Inicio</a></div>
		 </div>
		<div class="panel-body">
			<b>Cliente:</b> {{$factura->Cliente->nombre}} {{$factura->Cliente->apaterno}} {{$factura->Cliente->amaterno}}
			<hr>
			<b>Telefono:</b> {{$factura->Cliente->telefono}}
			<hr>
			<b>Dirreccion:</b> {{$factura->Cliente->calle}} <b>N° </b>{{$factura->Cliente->numero}} <b>Col.</b> {{$factura->Cliente->colonia}}
			<br>
			<h4>Orden</h4>
			<button type="button" class="btn btn-primary , pull-right" data-toggle="modal" data-target="#myModalHorizontal">Añadir productos</button>
		</div>
<table class="table table-striped table-responsive">
		<thead>
			<tr>
				<th scope="row">Producto</th>
				<th scope="row">Especialidad</th>
				<th scope="row">Comentario</th>
				<th scope="row">precio por unidad</th>
				<th scope="row">Cantidad</th>
				<th scope="row">Opciones</th>
			</tr>
		</thead>
		<tbody>
		@forelse ($ordenes as $orden)
			<tr>
				<td>{{$orden->Producto->nombre}}</td>
				<td>{{$orden->Especialidad->nombre}}</td>
				<td>{{ $orden->comentario }}</td>
				<td>$ {{$orden->precio}}</td>
				<td>{{ $orden->cantidad }}</td>

				<td>
					<a href="{!! route('orden.edit', ['id'=>$orden->id]) !!}"><i class="material-icons">create</i></a>
					<button class="btn btn-link btn-xs" onclick="confirm{{ $orden->id }}()"><i class="material-icons">delete</i></button>
				</td>
			</tr>
		@empty

		</tbody>
	</table>



		@endforelse
			<tfoot>
				<tr>
					<td><strong>Total: </strong></td>
					<td></td>
					<td></td>
					<td></td>
					<td><b>$ {{$control->calcularTotal($factura)}}</b></td>
					<td></td>
				</tr>
			</tfoot>
		</tbody>
		</table>
		<div class="panel-body">
			<div class="pull-right">
					<button class="btn btn-link" data-toggle="modal" data-target="#comentarioFac"><i class="material-icons">create</i></button>
			</div>
			<h4>Especificaciones de la factura:</h4>
			<p>{{ $factura->comentario }}</p>
		</div>

		<div class="modal fade" id="comentarioFac" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="">Especificaciones adicionales</h4>
		      </div>
		      <div class="modal-body">
						<form class="form-horizontal" action="{!! url("/pedidos/$factura->id/Modcomment") !!}" method="post">
							{{ method_field('PUT') }}
							{{ csrf_field() }}

						<div class="form-group">
							<label class="col-sm-2 control-label"
										for="txtcantidad">Notas adicionales</label>
							<div class="col-sm-10">
									<textarea class="form-control" name="comentario" placeholder="Notas adicionales de la factura." id="txtComentario" cols="30" rows="4">{{ old('comentario') }} {{ $factura->comentario }}</textarea>
							</div>
						</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        <button type="submit" class="btn btn-primary">Modificar</button>
						</form>
		      </div>
		    </div>
		  </div>
		</div>

		<!-- Modal -->
<div class="modal fade" id="myModalHorizontal" tabindex="-1" role="dialog"
	 aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
			<div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
							<button type="button" class="close"
								 data-dismiss="modal">
										 <span aria-hidden="true">&times;</span>
										 <span class="sr-only">Close</span>
							</button>
							<h4 class="modal-title" id="myModalLabel">
									Añadir un producto
							</h4>
					</div>

					<!-- Modal Body -->
					<div class="modal-body">

							<form class="form-horizontal" action="{!! url('ordenes/crear') !!}" method="post" role="form">
								{{ csrf_field() }}
								<input type="text" name="factura" hidden value="{{ $factura->id }}">
								<div class="form-group">
									<label  class="col-sm-2 control-label"
														for="cmbProducto">Producto</label>
									<div class="col-sm-10">
										<select name="producto" id="cmbProducto" value="{{ old('producto') }}" class="form-control">
											<option value="0" disabled="true" selected>Selecciona un producto</option>
											@foreach ($productos as $producto)
												<option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label"
												for="cmbEspecialidad">Especialidad</label>
									<div class="col-sm-10">
										<select name="especialidad" id="cmbEspecialidad" value="{{ old('especialidad') }}" class="form-control">
											<option value="0" disabled="true" selected>Selecciona un la especialidad</option>
											@foreach ($especialidades as $especialidad)
												<option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label"
												for="txtprecio">Precio</label>
									<div class="col-sm-10">
											<input type="number" min="1" step="0.01" class="form-control"
													id="txtprecio" name="precio" placeholder="Precio por cada producto."/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label"
												for="txtcantidad">Cantidad</label>
									<div class="col-sm-10">
											<input type="number" min="1" class="form-control"
													id="txtcantidad" name="cantidad" placeholder="Cantidad del producto."/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label"
												for="txtcantidad">Comentario</label>
									<div class="col-sm-10">
											<textarea class="form-control" name="comentario" placeholder="Notas adicionales del platillo." id="txtComentario" cols="30" rows="4">{{ old('comentario') }}</textarea>
									</div>
								</div>


					</div>
					<!-- Modal Footer -->
					<div class="modal-footer">
							<button type="button" class="btn btn-default"
											data-dismiss="modal">
													Cancelar
							</button>
							<button type="submit" class="btn btn-primary">
									Añadir
							</button>
							</form>
					</div>
			</div>
	</div>
</div>
	</div>


</div>

<script>

@foreach ($factura->Ordenes as $orden)
		function confirm{{$orden->id}}() {
		var r=confirm("¿Estas seguro de que quieres eliminar este producto de la orden? \n \n 'prod. {{$orden->Producto->nombre}} esp. {{ $orden->especialidad->nombre }} cant. {{ $orden->cantidad }}'");
		if (r== true) {
				window.location.href = "{{ route('orden.del',['id'=>$orden->id]) }}";
		}
}
@endforeach

</script>

@endsection
