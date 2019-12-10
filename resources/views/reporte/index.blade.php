@extends('layout')

@section('title','Reportes')

@section('content')

<div class="container-fluid">
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title">Reportes</h3>
	  </div>
	  <div class="panel-body">
	  	<div class="dropdown">
		  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
		    Reportes
		    <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
		  	<li class="dropdown-header">Reportes Basicos</li>
	  		<li><a href="{{ route('reporte.gFacturas') }}">Facturas</a></li>
		    <li><a href="{{ route('reporte.gProductos') }}">Productos</a></li>
		    <li><a href="{{ route('reporte.gEspecialidades') }}">Especialidades</a></li>
		    <li><a href="{{ route('reporte.gIngredientes') }}">Ingredientes</a></li>
		    <li><a href="{{ route('reporte.gOrdenes') }}">Ordenes</a></li>
		    <li class="dropdown-header">Reportes Compuestos</li>
		    <li><a href="{{ route('reporte.ventasXcliente') }}">Ventas por cliente</a></li>
		    <li><a href="{{ route('reporte.compraXproducto') }}">Veces vendidas por producto</a></li>
		    <li class="dropdown-header">Reportes Por fecha</li>
		    <li><a href="{{ route('reporte.periodo') }}">Facturas por Fecha</a></li>
		    <li class="dropdown-header">Reporte Sumario</li>
		    <li><a href="{{ route('reporte.sumario') }}">Sumario</a></li>
		  </ul>
	  </div>
	</div>
</div>
</div>

@endsection
