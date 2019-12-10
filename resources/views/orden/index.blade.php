@extends('layout')

@section('title','Ordenes')

@section('content')
<div class="container">
    
 </div>

<div class="container">
<div class="row aling-self-end">
    <div class="col ">

    </div>
</div>
<div class="row">
	<div class="col-sm-auto">
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Folio de Factura</th>
					<th scope="col">Producto</th>
					<th scope="col">Especialidad del producto</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($ordenes as $orden)
					<tr>
					<th scope="row">{{ $orden->id }}</th>
    				<td>{{ $orden->factura_id }} <b>~</b> {{$orden->Factura->fecha}}</td>
    				<td>{{ $orden->Producto->nombre }}</td>
    				<td>{{ $orden->Especialidad->nombre }}</td>
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
</div>


            </div>

@endsection
