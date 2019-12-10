@extends('layout')

@section('title','Facturas por periodo')

@section('content')
<div class="container">
<div class="pull-right">
	 <form class="form-inline" action="{{url("/reportes/periodo") }}" autocomplete="off">
	    {{-- csrf_field() --}}
	    <label for="dtpIni">De</label>
	 <input class="form-control mr-sm-2" type="date" name="ini" id="dtpIni">
	 <label for="dtpFin">A</label>
	 <input class="form-control mr-sm-2" type="date" name="fin" id="dtpFin">
	 <button class="btn btn-primary" type="submit" >Buscar</button>
	 </form>
 </div>
</div>
<div class="container">
	<div class="row">
		<h3>Facturas concertadas correctamente en el preriodo: {{ $ini }} a {{ $fin }}</h3>
		<br><br>
		<form class="form-inline" action="{{ route('reporte.expPeriodo') }}" method="post">
			{{ csrf_field() }}
			<input type="text" name="ini" hidden value="{{ $ini }}">
			<input type="text" name="fin" hidden value="{{ $fin }}">
			<div class="pull-right">
				<button type="submit" class="btn btn-primary">Exportar a Excel</button>
				</form>
			</div>
		</div>



	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">Folio</th>
				<th scope="col">Fecha</th>
				<th scope="col">Cliente</th>
			</tr>
		</thead>
		<tbody>
	@forelse($facturas as $factura)
		<tr>
			<th scope="row">{{$factura->id}}</th>
			<td>{{$factura->fecha}} {{ $factura->hora }}</td>
			<td>{{$factura->Cliente->nombre}} {{$factura->Cliente->apaterno}} {{$factura->Cliente->amaterno}}</td>
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
	<tfoot>
		<tr>
			<td><h4>Total facturado Por periodo $ {{$total}}</h4></td>
			<td></td>
			<td></td>
		</tr>
	</tfoot>
	</table>

	<div class="form-group col-md-12"><a href="{{ route('reportes') }}" class="btn btn-primary">Regresar</a></div>
</div>


@endsection
