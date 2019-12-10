@extends('layout')

@section('title','Reporte general de ordenes')

@section('content')
<div class="container">

                    <div class="pull-right">
                        <a href="{{ route('reporte.exportarBas',['modelo'=>'ordenes']) }}" class="btn btn-primary">Exportar a Excel</a>
                    </div>
                    <br>

    <div class="row">
    	<div class="col-sm-auto">
    		<table class="table table-striped">
    			<thead>
    				<tr>
    					<th scope="col">#</th>
    					<th scope="col">Folio de Factura</th>
    					<th scope="col">Producto</th>
    					<th scope="col">Especialidad del producto</th>
              <th scope="col">Precio por unidad</th>
              <th scope="col">cantidad</th>
              <th scope="col">comentario</th>
    				</tr>
    			</thead>
    			<tbody>
    				@forelse ($ordenes as $orden)
    					<tr>
						<th scope="row">{{ $orden->id }}</th>
        				<td>factura n°{{ $orden->factura_id }} <b>~</b> {{$orden->Factura->fecha}} {{ $orden->Factura->hora }}</td>
        				<td>{{ $orden->Producto->nombre }}</td>
        				<td>{{ $orden->Especialidad->nombre }}</td>
                <td>{{ $orden->precio }}</td>
                <td>{{ $orden->cantidad }}</td>
                <td>{{ $orden->comentario }}</td>
    					</tr>
    				@empty
            			</tbody>
                		</table>
                		<div class="content">
                		<h1>
                		La tabla No tiene registros
                		</h1>
                		</div>
    				@endforelse
    			</tbody>
    		</table>
    	</div>
        <div class="form-group col-md-12"><a href="{{ route('reportes') }}" class="btn btn-primary">Regresar</a></div>
    </div>

</div>

@endsection
