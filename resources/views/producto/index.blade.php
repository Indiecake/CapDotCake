@extends('layout')

@section('title','Productos')

@section('content')
<div class="container">

 <div class="pull-right">
     <form class="form-inline" action="{{url("productos/bus") }}" autocomplete="off">
         <input type="search" class="form-control" name="buscar" placeholder="Buscar por nombre">
         <button class="btn btn-primary hidden-xs" type="submit" >Buscar</button>
     </form>
 </div>

</div>

<div class="container">
<a href="{{ route('producto.nuevo') }}" class="btn btn-primary">Nuevo Producto</a>
<div class="clearfix"/>
<div class="col">


        @if($productos->isNotEmpty())
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Nombre</th>

          <th scope="col">Opciones</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($productos as $producto)
					<tr>
					<th scope="row">{{ $producto->id }}</th>
    				<td>{{ $producto->nombre }}</td>                    
                    <td><a href="{{ route('producto.edit',['id'=>$producto->id]) }}"><i class="material-icons">create</i></a> <a href="#" onclick="confirm{{$producto->id}}()"><i class="material-icons">delete</i></a></td>
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
             <!--tfoot>
            <tr>
              <td>Total</td>
              <td></td>
              <td>$ {{--$productos->sum('precio')--}}</td>
              <td></td>

            </tr>
          </tfoot-->
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

</div>

<script type="text/javascript">
    @foreach ($productos as $producto)
        function confirm{{$producto->id}}() {
        var r=confirm("¿Estas seguro de que quieres borrar este registro? \n \n '{{$producto->nombre}}'");
        if (r== true) {
            window.location.href = "{{ route('producto.del',['id'=>$producto->id]) }}";
        }
    }
    @endforeach

</script>
@endsection
