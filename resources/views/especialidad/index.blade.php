@extends('layout')

@section('title','Especialidades')


@section('content')

<div class="container">
    <div class="pull-right">
        <div class="">
           <form class="form-inline" action="{{url("especialidades/bus") }}" autocomplete="off">
           <input class="form-control" type="search" name="buscar" placeholder="Nombre">

           <button class="btn btn-primary hidden-xs" type="submit">Buscar</button>
           </form>
         </div>
    </div>
 </div>

  <div class="container">
    <div class="col" style="margin-top: 10px; margin-bottom: 10px">
        <div class="row">
        <a href="{{ route('especialidad.nuevo') }}" class="btn btn-primary">Nueva especialidad</a>
        </div>
    </div>

    <div class="col-md-12">

    @if ($especialidades->isNotEmpty())
<table class="table table-responsive">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Nombre</th>
      <th scope="col">Opciones</th>
		</tr>
	</thead>
	<tbody>
		@forelse ($especialidades as $especialidad)
			<tr>
		<th scope="row">{{ $especialidad->id }}</th>
			<td>{{ $especialidad->nombre }}</td>
                <td><a href="{{ route('especialidad.edit',['id'=>$especialidad->id]) }}"><i class="material-icons">create</i></a> <a href="#" onclick="confirm{{$especialidad->id}}()"><i class="material-icons">delete</i></a></td>
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

  </div>
  </div>
  </div>
<script type="text/javascript">
    @foreach ($especialidades as $especialidad)
        function confirm{{$especialidad->id}}() {
        var r=confirm("¿Estas seguro de que quieres borrar este registro? \n \n '{{$especialidad->nombre}}'");
        if (r== true) {
            window.location.href = "{{ route('especialidad.del',['id'=>$especialidad->id]) }}";
        }
    }
    @endforeach

    listar = () =>{
        //console.log('hola')
        $.get({
            url:'{{ route('especialidad.bus') }}'
        }).done((data)=>{
            console.log(data)
        })
    }
</script>

@endsection
