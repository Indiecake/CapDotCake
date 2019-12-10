@extends('layout')

@section('title','Bienvenido')
@inject('control','integradora\Http\Controllers\ReporteController')
@section('content')
  @if (Auth::guest())
  <div class="container">
          <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">CapDotCake</h3>
              </div>
              <div class="panel-body">
                Para continuar debes de ingresar con tu cuenta al sistema.
              </div>

            </div>
          </div>
  </div>
  @else

  <div class="container">


 @forelse ($facturas as $factura)
    <div class="col-sm-12 col-md-12">
      <div class="panel panel-default bootcards-file">
        <div class="panel-heading">
          <h3 class="panel-title">
            <strong>#{{ $factura->id }}</strong>
          Cliente:  {{ $factura->Cliente->nombre }} ~ {{ $factura->fecha}} ~ {{ $factura->hora }}</h3>
        </div>
        <div class="list-group">
          <div class="list-group-item">
            <h4 class="list-group-item-heading">
					    <p class="text-primary">
					     Calle. {{ $factura->Cliente->calle }} ~ Num.{{ $factura->Cliente->numero}} Col. {{ $factura->Cliente->colonia }}
					    </p>
					    </h4>
            <table class="table table-striped">
              <thead>
                <th scope="row">Producto</th>
                <th scope="row">Especialidad</th>
                <th scope="row">comentario</th>
                <th scope="row">Cantidad</th>
                <th scope="row">Precio unitario</th>
                <th scope="row">Opciones</th>
              </thead>
              <tbody>
                @forelse ($factura->Ordenes as $orden)
                <tr>
                  <td>{{ $orden->Producto->nombre }}</td>
                  <td>{{ $orden->Especialidad->nombre }}</td>
                  <td>{{ $orden->comentario }}</td>
                  <td>{{ $orden->cantidad }}</td>
                  <td>$ {{ $orden->precio }}</td>

                  <td>
                    <a href="{!! route('orden.edit', ['id'=>$orden->id]) !!}"><i class="material-icons">create</i></a>
                    <button class="btn btn-link btn-xs" onclick="confirm{{ $orden->id }}()"><i class="material-icons">delete</i></button>
                  </td>
                </tr>
                @empty
                <div class="alert alert-danger , text-center">¡la factura esta vacia!</div>

                @endforelse
                <div class="text-right"><a href="{!! route('pedido.addOrden',['id'=>$factura->id]) !!}" class="btn btn-default">Añadir productos.</a></div>
              </tbody>
              <tfoot>
                <tr>
                  <td><strong>Total:</strong></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td><strong>$ {{ $control->calcularTotal($factura) }}</strong></td>
                  <td></td>
                </tr>
              </tfoot>
            </table>
          </div>
          <div class="list-group-item">
            <p class="list-group-item-text">Entrada del pedido: {{ $factura->hora }}</p>
          </div>
          <div class="list-group-item">
            <p class="list-group-item-text">Comentario de la factura: {{ $factura->comentario }}</p>
          </div>
        </div>
        <div class="panel-footer">
          <div class="btn-group btn-group-justified">
            <div class="btn-group">
              <form action="{{ route('pedido.del',['id'=>$factura->id]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-default">
  					      Cancelar
  					    </button>

              </form>
            </div>
            <div class="btn-group">
              <form method="post" action="{{ route('pedido.fin',['id'=>$factura->id]) }}">
                {{ method_field('PUT') }}
        				{{ csrf_field() }}
                <button type="submit" class="btn btn-default">
  					      Confirmar
  					    </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  @empty
<div class="col-md-6 col-md-offset-3">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">CapDotCake</h3>
    </div>
    <div class="panel-body">
      No hay ninguna factura pendiente. ;)
    </div>
  </div>
</div>
  @endforelse

</div>

  @endif

<script type="text/javascript">
  @foreach ($facturas as $factura)


    @foreach ($factura->Ordenes as $orden)
        function confirm{{$orden->id}}() {
        var r=confirm("¿Estas seguro de que quieres eliminar este producto de la orden? \n \n 'prod. {{$orden->Producto->nombre}} esp. {{ $orden->especialidad->nombre }} cant. {{ $orden->cantidad }}'");
        if (r== true) {
            window.location.href = "{{ route('orden.del',['id'=>$orden->id]) }}";
        }
    }
    @endforeach

  @endforeach
</script>
@endsection
