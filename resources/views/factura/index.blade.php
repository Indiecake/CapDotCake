@extends('layout')

@section('title','Factura')

@section('content')

<div class="container">
            <div class="row aling-self-end">
                <div class="col ">
                    <a href="{{ route('pedido.nuevo') }}" class="btn btn-primary">Nueva Factura</a>
                </div>
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
            				</tr>
            			</thead>
            			<tbody>
            				@forelse ($facturas as $factura)
            					<tr>
        						<th scope="row">{{ $factura->id }}</th>
                				<td>{{ $factura->Cliente->nombre }}</td>
                                <td>{{ $factura->fecha }} ~ {{$factura->hora}}</td>
                                <td>
                                    <a href="{{ route('factura.view',['factura'=>$factura]) }}"><i class="material-icons">search</i></a>
                                    <a href="{{ route('factura.edit',['id'=>$factura->id]) }}"><i class="material-icons">create</i></a>
                                    <a href="#"><i class="material-icons">delete</i></a></td>
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
            	</div>
            </div>
            <div class="pull-right">
                <a href="{!! route('inicio') !!}" class="btn btn-primary">Regresar</a>
            </div>
            </div>


@endsection
