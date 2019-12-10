@extends('layout')

@section('title','Reporte general de ingredientes')

@section('content')

<div class="container">
                    <div class="pull-right">
                        <a href="{{ route('reporte.exportarBas',['modelo'=>'ingredientes']) }}" class="btn btn-primary">Exportar a Excel</a>
                    </div>
                    <br>

    <div class="row">
    	<div class="col-sm-auto">
            <div class="form-row">
                <div class="form-group">
                    
                </div>
            </div>
            @if($ingredientes->isNotEmpty())
    		<table class="table table-striped">
    			<thead>
    				<tr>
    					<th scope="col">#</th>
    					<th scope="col">Nombre</th>                        
    				</tr>
    			</thead>
    			<tbody>
    				@forelse ($ingredientes as $ingrediente)
    					<tr>            					
						<th scope="row">{{ $ingrediente->id }}</th>              				
        				<td>{{ $ingrediente->nombre }}</td>
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