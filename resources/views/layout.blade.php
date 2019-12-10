<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') - CapDotCake</title>
         <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('public/css/style.css') }}">
    </head>
<body>
<div id="app">
      <nav class="navbar navbar-default navbar-static-top">
          <div class="container">
              <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                  <!-- Branding Image -->
                  <a class="navbar-brand" href="{{ url('/') }}">
                      {{ config('app.name', 'Laravel') }}
                  </a>
              </div>

              <div class="collapse navbar-collapse" id="app-navbar-collapse">
                  <!-- Left Side Of Navbar -->
                  <ul class="nav navbar-nav">
                      &nbsp;
                      @if (Auth::guest())

                      @else
                          <li><a href="{{ route('pedido.nuevo') }}">Nuevo pedido</a></li>
                          <li><a href="{{ route('facturas') }}">Facturas</a></li>{{--Retirar--}}
                          <li><a href="{{ route('ordenes') }}">Ordenes</a></li>{{--Retirar--}}
                          <li><a href="{{ route('especialidades') }}">Especialidades</a></li>
                          <li><a href="{{ route('productos') }}">Productos</a></li>
                          
                      @endif
                  </ul>

                  <!-- Right Side Of Navbar -->
                  <ul class="nav navbar-nav navbar-right">
                      <!-- Authentication Links -->
                      @if (Auth::guest())
                          <li><a href="{{ route('login') }}">Iniciar Sesion</a></li>
                          <li><a href="{{ route('register') }}">Registrarse</a></li>
                      @else
                          <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                  {{ Auth::user()->name }} <span class="caret"></span>
                              </a>

                              <ul class="dropdown-menu" role="menu">
                                <li class="dropdown-header">Reportes Basicos</li>
                        	  		<li><a href="{{ route('reporte.gFacturas') }}">Facturas</a></li>
                        		    <li><a href="{{ route('reporte.gProductos') }}">Productos</a></li>
                        		    <li><a href="{{ route('reporte.gEspecialidades') }}">Especialidades</a></li>

                        		    <li><a href="{{ route('reporte.gOrdenes') }}">Ordenes</a></li>
                        		    <li class="dropdown-header">Reportes Compuestos</li>
                        		    <li><a href="{{ route('reporte.ventasXcliente') }}">Ventas por cliente</a></li>
                        		    <li><a href="{{ route('reporte.compraXproducto') }}">Veces vendidas por producto</a></li>
                        		    <li class="dropdown-header">Reportes Por fecha</li>
                        		    <li><a href="{{ route('reporte.periodo') }}">Facturas por Fecha</a></li>
                        		    <li class="dropdown-header">Reporte Sumario</li>
                        		    <li><a href="{{ route('reporte.sumario') }}">Sumario</a></li>
                                <li class="dropdown-header">Sistema</li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Cerrar Sesion
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                              </ul>
                          </li>
                      @endif
                  </ul>
              </div>
          </div>
      </nav>
  </div>


@yield('content')
</body>
 <footer class="footer">
    <div class="container">
      <p class="navbar-text pull-left">© 2018 -El sistema "CapDotCake" fue creado por IndieCake.</p>
    </div>
</footer>
        <script src="{{ asset('js/app.js') }}"></script>

</html>
