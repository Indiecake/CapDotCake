@extends('layout')

@section('title','Cantidad de productos vendidos')


@section('content')

<div class="container">

                    <div class="pull-right">
                        <a href="{{ route('reporte.expComXprod') }}" class="btn btn-primary">Exportar a Excel</a>
                    </div>
                    <br>
                
    <div class="row">
    	<div class="col-sm-auto">
            
            @if ($productos->isNotEmpty())
    		<table class="table table-striped">
    			<thead>
    				<tr>
    					<th scope="col">Producto</th>
    					<th scope="col">Veces Vendidas</th>
    				</tr>
    			</thead>
    			<tbody>
    				@forelse ($productos as $producto)
    					<tr>            					
						<th scope="row">{{ $producto->nombre }}</th>              				
        				<td>{{ $producto->veces }}</td>                    
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
            <div class="form-group col-md-12"><a href="{{ route('reportes') }}" class="btn btn-primary">Regresar</a></div>
    	</div>
    </div>

    </div>
</div>

@endsection