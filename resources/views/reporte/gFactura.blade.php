@extends('layout')

@section('title','Reporte general de facturas')

@section('content')

<div class="container">
            <div class="pull-right">

                        <a href="{{ route('reporte.exportarBas',['modelo'=>'facturas']) }}" class="btn btn-primary">Exportar a Excel</a>

                    <br>
                </div>
<div class="row">
	<div class="col-sm-auto">

        @if ($facturas->isNotEmpty())
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Cliente</th>
          <th scope="col">Fecha</th>
          <th scope="col">Comentario</th>
          <th scope="col">Detalle</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($facturas as $factura)
					<tr>
					<th scope="row">{{ $factura->id }}</th>
    				<td>{{ $factura->Cliente->nombre }}</td>
                    <td>{{ $factura->fecha }} ~ {{$factura->hora}}</td>
                    <td>{{ $factura->comentario }}</td>
                    <td>
                        <a href="{{ route('factura.view',['factura'=>$factura]) }}"><i class="material-icons">search</i></a>

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
        @else
        <div class="content">
        <div class="title m-b-md">
        La tabla no tiene registros
        </div>
        </div>
        @endif
        <div class="form-group col-md-12">
            <a href="{{ route('reportes') }}" class="btn btn-primary">Regresar</a>
        </div>
	</div>
</div>

</div>


@endsection
