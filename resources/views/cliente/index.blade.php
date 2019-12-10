@extends('layout')

@section('title','Clientes')

@section('content')
 <div class="container">
    <div class="pull-right">
         <form class="form-inline" action="{{url("clientes/bus") }}" autocomplete="off">
            {{-- csrf_field() --}}
         <input class="form-control" type="search" name="buscar" placeholder="Nombre" aria-label="Search">
         <button class="btn btn-primary hidden-xs" type="submit" >Buscar</button>
         </form>
     </div>
 </div>

<div class="container">
    <a href="{{ route('cliente.nuevo') }}" class="btn btn-primary">Nuevo Cliente</a>
           <div class="col">

	<table class="table table-striped table-responsive">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Nombre</th>
                <th scope="col">Apellido Paterno</th>
                <th scope="col">Apellido Materno</th>
                <th scope="col">Calle</th>
                <th scope="col">Numero</th>
                <th scope="col">Colonia</th>
                <th scope="col">Telefono</th>
                <th scope="col">Opciones</th>
			</tr>
		</thead>
		<tbody>
			@forelse ($clientes as $cliente)
				<tr>            					
				<th scope="row">{{ $cliente->id }}</th>              				
				<td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->apaterno }}</td>
                <td>{{ $cliente->amaterno }}</td>
                <td>{{ $cliente->calle }}</td>
                <td>{{ $cliente->numero }}</td>
                <td>{{ $cliente->colonia }}</td>
                <td>{{ $cliente->telefono }}</td>
                <td><a href="{{ route('cliente.edit',['id'=>$cliente->id]) }}"><i class="material-icons">create</i></a> <a href="#" onclick="confirm{{$cliente->id}}()"><i class="material-icons">delete</i></a></td>
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
</div>
</div>
<script type="text/javascript">
    @foreach ($clientes as $cliente)
        function confirm{{$cliente->id}}() {
        var r=confirm("¿Estas seguro de que quieres borrar este registro? \n \n '{{$cliente->nombre}}'");
        if (r== true) {
            window.location.href = "{{ route('cliente.del',['id'=>$cliente->id]) }}";
        }
    }
    @endforeach
    
</script>
@endsection