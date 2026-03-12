<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'WebController@index')->name('pagina.index');
Route::get('/generar', 'WebController@generar');
Route::get('/contacto', 'WebController@contacto')->name('pagina.contacto');
Route::get('/quienes-somos', 'WebController@quienesSomos')->name('pagina.quienes_somos');
Route::get('/marcas', 'WebController@marcas')->name('pagina.marcas');
Route::get('/marca/{id}', 'WebController@verMarca')->name('pagina.ver_marca');
Route::get('/catalogos', 'WebController@catalogos')->name('pagina.catalogos');
Route::get('/boletines', 'WebController@boletines')->name('pagina.boletines');
Route::get('/productos', 'WebController@productos')->name('pagina.productos');
Route::get('/autocompletar', 'WebController@autocompletar')->name('pagina.autocompletar');
Route::get('/detalles_producto/{clave}', 'WebController@detalleProducto')->name('pagina.detalles_producto');
Route::get('/autenticarse', 'WebController@autenticarse')->name('pagina.autenticarse');
Route::get('/filtros_catalogo', 'WebController@filtrosCatalogos')->name('pagina.filtros_catalogos');
Route::post('/generar_catalogo', 'WebController@generaCatalogo')->name('pagina.generar_catalogo');
Route::get('/actualizacion_automatica', 'ProductosController@actualizarAhora');
//Route::get('/actualizacion_automatica', 'WebController@index')->name('pagina.index');



Route::group(['prefix' => 'api', 'middleware' => ['cors']], function () {
	Route::get('/busqueda', 'WebController@apiBusqueda')->name('pagina.api.busqueda');
	Route::get('/imagenes', 'WebController@apiImagenes')->name('pagina.api.imagenes');
	Route::get('/subgrupos', 'WebController@apiSubgrupos')->name('pagina.api.subgrupos');
	Route::get('/soma/productos', 'ProductosController@somaProductos')->name('pagina.api.soma.productos');
	Route::get('/soma/marcas', 'ProductosController@somaMarcas')->name('pagina.api.soma.marcas');
	Route::get('/soma/lineas', 'ProductosController@somaLineas')->name('pagina.api.soma.lineas');
	Route::get('/soma/productos/aplicaciones', 'ProductosController@somaProductosAplicaciones')->name('pagina.api.soma.aplicaciones');
	Route::get('/soma/productos/equivalencias', 'ProductosController@somaProductosEquivalencias')->name('pagina.api.soma.equivalencias');
	Route::get('/soma/productos/web', 'ProductosController@somaProductosWeb')->name('pagina.api.soma.web');
});


Route::get('/promociones', 'PageController@promociones')->name('pagina.promociones');
Route::get('/soporte', 'PageController@soporte')->name('pagina.soporte');
Route::get('/oportunidades', 'PageController@oportunidades')->name('pagina.oportunidades');
Route::get('/denso', 'PageController@denso')->name('pagina.denso');
Route::get('/ctr', 'PageController@ctr')->name('pagina.ctr');
Route::get('/bando', 'PageController@bando')->name('pagina.bando');
Route::get('/gmb', 'PageController@gmb')->name('pagina.gmb');
Route::get('/best-cooling', 'PageController@bestCooling')->name('pagina.best-cooling');
Route::get('/fp', 'PageController@fp')->name('pagina.fp');
Route::get('/voltmax', 'PageController@voltmax')->name('pagina.voltmax');
Route::get('/top-engine', 'PageController@topEngine')->name('pagina.top-engine');
Route::get('/buscador', 'PageController@buscador')->name('pagina.buscador');
Route::get('/resultados', 'PageController@resultados')->name('pagina.resultados');
Route::get('/aviso_privacidad', 'PageController@aviso')->name('pagina.aviso');
Route::get('/terminos_uso', 'PageController@terminos')->name('pagina.terminos');
Route::get('/informate', 'PageController@informate')->name('pagina.informate');
Route::get('/informate/entrada/{id}', 'PageController@verEntrada')->name('pagina.ver_entrada');
Route::get('/socios-comerciales', 'PageController@sociosComerciales')->name('pagina.socios_comerciales');
Route::get('/usuarios_registrados/nuevo_registro', 'UsuariosRegistradosController@nuevoRegistro')->name('usuarios_registrados.nuevo_registro');
Route::get('/notinikko', 'PageController@notinikko')->name('pagina.notinikko');
Route::get('/filtros', 'PageController@filtros')->name('pagina.filtros');


Route::get('/ver_360/{codigo}', 'PageController@pagina360')->name('pagina.pagina_360');
Route::get('/boletin_tecnico', 'PageController@boletinTecnico')->name('pagina.boletin_tecnico');
Route::get('/videos', 'PageController@videos')->name('pagina.videos');
Route::get('/buzon', 'PageController@buzon')->name('pagina.buzon');

Route::get('/documentos', 'PageController@documentos')->name('pagina.documentos');
Route::post('/enviar_email', 'PageController@enviarEmail')->name('pagina.enviar_email');


Route::get('storage/informate/{id}/{filename}', function ($id, $filename) {
	$path = storage_path('app/public/informate/' . $id . '/' . $filename);
	if (!File::exists($path)) {
		abort(404);
	}

	$file = File::get($path);
	$type = File::mimeType($path);

	$response = Response::make($file, 200);
	$response->header("Content-Type", $type);

	return $response;
});


Route::get('storage/productos/{producto}/{filename}', function ($producto, $filename) {
	$path = storage_path('app/public/productos/' . $producto . '/' . $filename);
	if (!File::exists($path)) {
		abort(404);
	}

	$file = File::get($path);
	$type = File::mimeType($path);

	$response = Response::make($file, 200);
	$response->header("Content-Type", $type);

	return $response;
});

Route::get('archivos/360/{producto}/{filename}', function ($producto, $filename) {

	$path = storage_path('app/public/productos/' . $producto . '_360/' . $filename);
	if (!File::exists($path)) {
		abort(404);
	}

	$file = File::get($path);
	$type = File::mimeType($path);

	$response = Response::make($file, 200);
	$response->header("Content-Type", $type);

	return $response;
});

Route::get('archivos/360/{producto}/{filename}/{otro_mas}', function ($producto, $filename, $otro_mas) {



	if ($filename == $producto)
		$path = storage_path('app/public/productos/' . $producto . '_360/' . $otro_mas);
	else
		$path = storage_path('app/public/productos/' . $producto . '_360/' . $filename . '/' . $otro_mas);

	if ($filename == "orbitvu12")
		$path = public_path($filename . '/' . $otro_mas);

	if (!File::exists($path)) {
		abort(404);
	}

	$file = File::get($path);
	$type = File::mimeType($path);

	$response = Response::make($file, 200);
	$response->header("Content-Type", $type);

	return $response;
});

Route::get('archivos/360/{producto}/{filename}/{otro_mas}/{foto}', function ($producto, $filename, $otro_mas, $foto) {


	$path = storage_path('app/public/productos/' . $producto . '_360/' . $otro_mas . '/' . $foto);
	if (!File::exists($path)) {
		abort(404);
	}

	$file = File::get($path);
	$type = File::mimeType($path);

	$response = Response::make($file, 200);
	$response->header("Content-Type", $type);

	return $response;
});
Route::get('/buscar', 'PageController@buscar')->name('pagina.buscar');


Route::get('/admin', 'LoginController@index')->name('admin');
Route::get('/fotos_malas', 'LoginController@eliminarFotosMac')->name('fotosmalas');
Route::post('/admin/login', 'LoginController@login')->name('login');
Route::get('/admin/logout', 'LoginController@logout')->name('logout');


Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
	Route::get('/inicio', 'SistemaController@index')->name('inicio');
	Route::get('/test', 'SistemaController@test')->name('empresa.test');
	Route::get('/empresa', 'SistemaController@verEmpresa')->name('empresa.ver');
	Route::put('/empresa_guardar/{id}', 'SistemaController@empresaGuardar')->name('empresa.guardar');

	Route::get('/informacion_general', 'SistemaController@verInformacionGeneral')->name('empresa.informacion_general');
	Route::put('/guardar_informacion_general/{id}', 'SistemaController@guardadInformacionGeneral')->name('empresa.guardar_informacion_general');

	Route::get('/aviso_privacidad', 'SistemaController@verAvisoPrivacidad')->name('empresa.aviso_privacidad');
	Route::put('/guardar_aviso_privacidad/{id}', 'SistemaController@guardadAvisoPrivacidad')->name('empresa.guardar_aviso_privacidad');

	Route::get('/terminos_uso', 'SistemaController@verTerminosUso')->name('empresa.terminos_uso');
	Route::put('/guardar_terminos_uso/{id}', 'SistemaController@guardadTerminosUso')->name('empresa.guardar_terminos_uso');

	Route::get('/pop_up', 'SistemaController@verPopUp')->name('empresa.pop_up');
	Route::put('/guardar_pop_up/{id}', 'SistemaController@guardadPopUp')->name('empresa.guardar_pop_up');

	Route::get('/usuarios/data', 'UsuariosController@data')->name('usuarios.data');
	Route::resource('usuarios', 'UsuariosController');

	Route::post('/marcas/ordenar', 'MarcasController@ordenamiento')->name('marcas.ordenamiento');
	Route::get('/marcas/data', 'MarcasController@data')->name('marcas.data');
	Route::resource('marcas', 'MarcasController');


	Route::post('/banner_principal/ordenar', 'BannerPrincipalController@ordenamiento')->name('banner_principal.ordenamiento');
	Route::get('/banner_principal/data', 'BannerPrincipalController@data')->name('banner_principal.data');
	Route::resource('banner_principal', 'BannerPrincipalController');


	//Route::get('/banner_principal', 'BannerPrincipalController@bannerPrincipal')->name('banner_principal.index');
	//Route::post('/banner_principal/guardar', 'BannerPrincipalController@agregar')->name('banner_principal.agregar');
	//Route::post('/banner_principal/eliminar', 'BannerPrincipalController@eliminar')->name('banner_principal.eliminar');
	//Route::get('/banner_principal/subidas', 'BannerPrincipalController@subidas')->name('banner_principal.subidas');



	Route::post('/productos/agregar_imagenes', 'ProductosController@agregarImagenes')->name('productos.agregar_imagenes');
	Route::post('/productos/agregar_360_imagenes', 'ProductosController@agregarImagenes360')->name('productos.agregar_360_imagenes');
	Route::post('/productos/eliminar_imagenes', 'ProductosController@eliminarImagenes')->name('productos.eliminar_imagenes');
	Route::post('/productos/eliminar_imagenes_360', 'ProductosController@eliminarImagenes360')->name('productos.eliminar_imagenes_360');

	Route::get('/productos/subidas', 'ProductosController@subidas')->name('productos.subidas');


	Route::get('/productos/excel', 'ProductosController@excel')->name('productos.excel');
	Route::get('/productos/data', 'ProductosController@data')->name('productos.data');
	Route::post('/productos/upload_excel', 'ProductosController@uploadExcel')->name('productos.upload_excel');
	Route::get('/productos/vaciar_tabla', 'ProductosController@vaciarTabla')->name('productos.vaciar_tabla');
	Route::get('/productos/respaldo_tabla', 'ProductosController@respaldoTabla')->name('productos.respaldo_tabla');
	Route::get('/productos/actualizar_magenes', 'ProductosController@actualizarImagenes')->name('productos.actualizar_magenes');
	Route::get('/productos/anexar_imagenes', 'ProductosController@anexarImagenes')->name('productos.anexar_imagenes');
	Route::get('/productos/ver_carpeta_fotos', 'ProductosController@verCarpetasFotos')->name('productos.ver_carpeta_fotos');
	Route::get('/productos/ver_carpetas', 'ProductosController@verCarpetas')->name('productos.ver_carpetas');
	Route::get('/productos/editar/{id}', 'ProductosController@editar')->name('productos.editar');
	Route::get('/productos/borrar/{id}', 'ProductosController@borrar')->name('productos.borrar');

	Route::resource('productos', 'ProductosController');

	Route::get('/movimientos_sistema/data', 'SistemaController@dataAcciones')->name('movimientos_sistema.data');
	Route::get('/movimientos_sistema', 'SistemaController@verLog')->name('movimientos_sistema.ver_log');



	Route::get('/paginas_inicio', 'PaginasController@inicio')->name('paginas.inicio');
	Route::put('/guardar_paginas_inicio/{id}', 'PaginasController@guardarPaginaInicio')->name('paginas.guardar_inicio');


	Route::get('/paginas_soporte_tecnico', 'PaginasController@soporteTecnico')->name('paginas.soporte_tecnico');
	Route::put('/guardar_paginas_soporte_tecnico/{id}', 'PaginasController@guardarSoporteTecnico')->name('paginas.guardar_soporte_tecnico');

	Route::get('/paginas_bolsa_trabajo', 'PaginasController@bolsaTrabajo')->name('paginas.bolsa_trabajo');
	Route::put('/guardar_paginas_bolsa_trabajo/{id}', 'PaginasController@guardarBolsaTrabajo')->name('paginas.guardar_bolsa_trabajo');

	Route::get('/paginas_contacto', 'PaginasController@contacto')->name('paginas.contacto');
	Route::put('/guardar_paginas_contacto/{id}', 'PaginasController@guardarContacto')->name('paginas.guardar_contacto');

	Route::get('/empresa_promociones', 'SistemaController@promociones')->name('empresa.promociones');
	Route::put('/guardar_promociones/{id}', 'SistemaController@guardadPromociones')->name('empresa.guardar_promociones');


	Route::get('/empresa_notinikko', 'SistemaController@notinikko')->name('empresa.notinikko');
	Route::put('/guardar_notinikko/{id}', 'SistemaController@guardadNotinikko')->name('empresa.guardar_notinikko');


	Route::get('/boletines/data', 'BoletinesController@data')->name('boletines.data');
	Route::resource('boletines', 'BoletinesController');

	Route::get('/publicaciones/data', 'PublicacionesController@data')->name('publicaciones.data');
	Route::resource('publicaciones', 'PublicacionesController');

	Route::post('/catalogos/ordenar', 'CatalogosController@ordenamiento')->name('catalogos.ordenamiento');
	Route::get('/catalogos/data', 'CatalogosController@data')->name('catalogos.data');
	Route::resource('catalogos', 'CatalogosController');

	Route::get('/usuarios_registrados/nuevos', 'UsuariosRegistradosController@nuevos')->name('usuarios_registrados.nuevos');
	Route::get('/usuarios_registrados/aceptados', 'UsuariosRegistradosController@aceptados')->name('usuarios_registrados.aceptados');
	Route::get('/usuarios_registrados/rechazados', 'UsuariosRegistradosController@rechazados')->name('usuarios_registrados.rechazados');
	Route::get('/usuarios_registrados/ver_detalle/{id}', 'UsuariosRegistradosController@verDetalle')->name('usuarios_registrados.ver_detalle');
	Route::put('/usuarios_registrados/guardar_cambio/{id}', 'UsuariosRegistradosController@guardarCambio')->name('usuarios_registrados.guardar_cambio');
	Route::delete('/usuarios_registrados/eliminar/{id}', 'UsuariosRegistradosController@eliminar')->name('usuarios_registrados.eliminar');
	Route::get('/usuarios_registrados/data_nuevos', 'UsuariosRegistradosController@dataNuevos')->name('usuarios_registrados.data_nuevos');
	Route::get('/usuarios_registrados/data_aceptados', 'UsuariosRegistradosController@dataAceptados')->name('usuarios_registrados.data_aceptados');
	Route::get('/usuarios_registrados/data_rechazados', 'UsuariosRegistradosController@dataRechazados')->name('usuarios_registrados.data_rechazados');


	Route::post('/informate/agregar_imagenes', 'InformateController@agregarImagenes')->name('informate.agregar_imagenes');
	Route::post('/informate/eliminar_imagenes', 'InformateController@eliminarImagenes')->name('informate.eliminar_imagenes');
	Route::get('/informate/subidas', 'InformateController@subidas')->name('informate.subidas');
	\
		Route::get('/informate/data', 'InformateController@data')->name('informate.data');
	Route::resource('informate', 'InformateController');


	Route::get('/socios/data', 'SociosController@data')->name('socios.data');
	Route::resource('socios', 'SociosController');




});