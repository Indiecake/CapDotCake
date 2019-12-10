<?php

Route::get('/','PedidoController@LoadFacturasPendientes')
->name('inicio');

Route::get('/usuarios', 'UserController@index')->
name('usuarios');

//Orden Routes
Route::get('/ordenes','OrdenController@index')
->name('ordenes');

Route::get('/ordenes/bus','OrdenController@show')
->name('orden.bus');

Route::get('/ordenes/{factura?}/nueva','OrdenController@create')
->name('orden.nuevo');

Route::post('/ordenes/crear','OrdenController@store');

Route::get('/ordenes/{orden}/editar','PedidoController@modOrden')
->name('orden.edit');

Route::put('/ordenes/{orden}/mod','OrdenController@update');

Route::get('/ordenes/{orden}/del','OrdenController@destroy')
->name('orden.del');
//

//Pedidos Rouetes
Route::get('/pedidos/nuevo', 'PedidoController@create')
->name('pedido.nuevo');

Route::post('/pedidos/crear', 'PedidoController@nuevaFactura')
->name('pedido.factura');

Route::get('/pedidos/{pedido?}/agregar', 'PedidoController@show')
->name('pedido.addOrden');

Route::post('/pedidos/agregar/orden','PedidoController@createOrden')
->name('pedido.StoreOrden');

Route::put('/pedidos/{id}/finish', 'PedidoController@confirmar')
->name('pedido.fin');

Route::delete('/pedidos/{pedido}/del','PedidoController@cancelar')
->name('pedido.del');

Route::put('/pedidos/{factura?}/Modcomment','PedidoController@modFcomment')
->name('pedido.comentario');
//

//Reportes Routes
Route::get('/reportes','ReporteController@index')
->name('reportes');

Route::get('/reportes/generalFacturas','ReporteController@generalFactura')
->name('reporte.gFacturas');

Route::get('/reportes/generalProductos','ReporteController@generalProducto')
->name('reporte.gProductos');

Route::get('/reportes/generalEspecialidades','ReporteController@generalEspecialidad')
->name('reporte.gEspecialidades');

Route::get('/reportes/generalIngredientes','ReporteController@generalIngrediente')
->name('reporte.gIngredientes');

Route::get('/reportes/ventasDeProducto','ReporteController@compraXproducto')
->name('reporte.compraXproducto');

Route::get('/reportes/generalOrdenes','ReporteController@generalOrden')
->name('reporte.gOrdenes');

Route::get('/reportes/sumario','ReporteController@sumarioFactura')
->name('reporte.sumario');

Route::get('/reportes/periodo','ReporteController@fechaFactura')
->name('reporte.periodo');

Route::get('/reportes/comprasPorCliente','ReporteController@ventasXcliente')
->name('reporte.ventasXcliente');

Route::get('/reportes/ventasPorProducto','ReporteController@ventasXproducto')
->name('reporte.ventasXproducto');

#~Exportar Excel

Route::post('/reportes/periodo/excel','ReporteController@exportarPeriodo')
->name('reporte.expPeriodo');

Route::get('/reportes/periodo/inicio-{ini}/fin-{fin}/excel','ReporteController@test')
->name('reporte.expTest');

Route::get('/reportes/basico/{modelo}/excel','ReporteController@exportarBasico')
->name('reporte.exportarBas');

Route::get('/reportes/sumario/excel','ReporteController@exportarSumario')
->name('reporte.expSumario');

Route::get('/reportes/ventasDeProducto/excel','ReporteController@exportarCompraXproducto')
->name('reporte.expComXprod');

Route::get('/reportes/VentasPorCliente/excel','ReporteController@exportarVentasXcliente')
->name('reporte.exportarCompuesto');

#~

//

//Especialidades Routes
Route::get('/especialidades','EspecialidadController@index')
->name('especialidades');

Route::get('/especialidades/bus','EspecialidadController@show')
->name('especialidad.bus');

Route::get('/especialidades/nueva','EspecialidadController@create')
->name('especialidad.nuevo');

Route::post('/especialidades/crear','EspecialidadController@store');

Route::get('/especialidades/{especialidad}/editar','EspecialidadController@edit')
->name('especialidad.edit');

Route::put('/especialidades/{especialidad}/mod','EspecialidadController@update');

Route::get('/especialidades/{especialidad}/del','EspecialidadController@destroy')
->name('especialidad.del');
//

//Clientes Routes
Route::get('/clientes','ClienteController@index')
->name('clientes');

Route::get('/clientes/bus','ClienteController@show')
->name('cliente.bus');

Route::get('/clientes/nuevo','ClienteController@create')
->name('cliente.nuevo');

Route::post('/clientes/crear','ClienteController@store');

Route::get('/clientes/{cliente}/editar','ClienteController@edit')
->name('cliente.edit');

Route::put('/clientes/{cliente}/mod','ClienteController@update');

Route::get('/clientes/{cliente}/del','ClienteController@destroy')
->name('cliente.del');
//

//Productos Routes
Route::get('/productos','ProductoController@index')
->name('productos');

Route::get('/productos/bus','ProductoController@show')
->name('producto.bus');

Route::get('/productos/nuevo','ProductoController@create')
->name('producto.nuevo');

Route::post('/productos/crear','ProductoController@store');

Route::get('/productos/{producto}/editar','ProductoController@edit')
->name('producto.edit');

Route::put('/productos/{producto}/mod','ProductoController@update');

Route::get('/productos/{producto}/del','ProductoController@destroy')
->name('producto.del');
//

//Facturas Routes
Route::get('/facturas','FacturaController@index')
->name('facturas');

Route::get('/facturas/nuevo','FacturaController@create')
->name('factura.nuevo');

Route::post('/facturas/crear','FacturaController@store');

Route::get('/facturas/{factura}/editar','FacturaController@edit')
->name('factura.edit');

Route::put('/facturas/{factura}/mod','FacturaController@update');

Route::get('/facturas/{factura}/del','FacturaController@destroy')
->name('factura.del');

Route::get('/facturas/{factura}/view','FacturaController@detalle')
->name('factura.view');
//

//Ingredientes Routes

//

//usuarios/nuevo != usuarios/[0-9]
Route::get("/usuarios/{id}/editar','UserController@show")->where('id','[0-9]+')
->name('usuario.editar');

Route::get('/usuarios/nuevo','UserController@create')
->name('usuario.nuevo');

//Route::get('/{apodo}/{mote?}','WelcomeUserController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
