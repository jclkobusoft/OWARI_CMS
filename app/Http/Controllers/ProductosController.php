<?php

namespace App\Http\Controllers;

use App\Models\Autocompletar;
use App\Models\ProductoBusqueda;
use App\Models\ProductoBusquedaDos;
use App\Models\AutocompletarDos;
use DataTables;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;

class ProductosController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
		$seccion = "Productos";
		$breadcrumb = [
			['route' => 'productos.index', 'nombre' => 'Productos'],
		];

		$productos = \DB::select("WITH ranked AS (
			SELECT
				codigo_nikko, descripcion_1, marca_comercial, precio_normal, especial, id,
				ROW_NUMBER() OVER (PARTITION BY codigo_nikko ORDER BY id) AS rn
			FROM productos_busqueda where deleted_at is null
			)
			SELECT marca_comercial, codigo_nikko, descripcion_1, precio_normal ,especial, id
			FROM ranked
			WHERE rn = 1 ORDER BY descripcion_1;");


		return view('productos.index', compact('seccion', 'breadcrumb','productos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//$seccion = "Productos";
		$seccion = "Productos";
		$breadcrumb = [
			['route' => 'productos.index', 'nombre' => 'Productos'],
			['route' => 'productos.create', 'nombre' => 'Agregar'],
		];

		$estampa = date("YmdHis");
		return view('productos.agregar', compact('seccion', 'breadcrumb', 'estampa'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
		extract($request->all());
		$buscar = $request->all();

		unset($buscar['nuevo'], $buscar['vendido'], $buscar['promocion'], $buscar['precio_normal'], $buscar['_token'], $buscar['estampa'], $buscar['minimo_compra_oferta'], $buscar['fecha_promocion_inicio'], $buscar['fecha_promocion_final']);

		if (isset($buscar['archivo'])) {
			unset($buscar['archivo']);
		}

		$data = [
			'codigo_nikko' => $codigo_nikko,
			'descripcion_1' => $descripcion_1,
			'descripcion_2' => $descripcion_2,
			'descripcion_3' => $descripcion_3,
			'marca_comercial' => $marca_comercial,
			'grupo' => $grupo,
			'subgrupo' => $subgrupo,
			'caracteristicas_1' => $caracteristicas_1,
			'caracteristicas_2' => $caracteristicas_2,
			'caracteristicas_3' => $caracteristicas_3,
			'caracteristicas_4' => $caracteristicas_4,
			'equivalencia_1' => $equivalencia_1,
			'equivalencia_2' => $equivalencia_2,
			'equivalencia_3' => $equivalencia_3,
			'equivalencia_4' => $equivalencia_4,
			'equivalencia_5' => $equivalencia_5,
			'oem' => $oem,
			'armadora' => $armadora,
			'modelo' => $modelo,
			'generacion_mexico' => $generacion_mexico,
			'version' => $version,
			'ano_inicial' => $ano_inicial,
			'ano_final' => $ano_final,
			'litros' => $litros,
			'unidad_litros' => $unidad_litros,
			'cilindros' => $cilindros,
			'unidad_cilindros' => $unidad_cilindros,
			'bloqueo_motor' => $bloqueo_motor,
			'aspiracion' => $aspiracion,
			'arbol_levas' => $arbol_levas,
			'valvulas' => $valvulas,
			'eje_transmision' => $eje_transmision,
			'traccion_operacion' => $traccion_operacion,
			'especificacion' => $especificacion,
			'nuevo' => $nuevo,
			'vendido' => $vendido,
			'promocion' => $promocion,
			'precio_normal' => $precio_normal,
			'extra' => $extra,
			'pagina_principal' => $pagina_principal,
			'invocacion' => $invocacion,
			'pruebas_ilc' => $pruebas_ilc,
			'minimo_compra_oferta' => $minimo_compra_oferta,
			'fecha_promocion_inicio' => $fecha_promocion_inicio,
			'fecha_promocion_final' => $fecha_promocion_final,
			'extra_clave_1' => $extra_clave_1,
			'extra_marca_1' => $extra_marca_1,
			'extra_clave_2' => $extra_clave_2,
			'extra_marca_2' => $extra_marca_2,
			'extra_clave_3' => $extra_clave_3,
			'extra_marca_3' => $extra_marca_3,
			'codigo_barras' => $codigo_barras,
		];

		$texto_motor = ($litros != "" && $litros != "---" ? $litros : "") . " " . ($unidad_litros != "" && $unidad_litros != "---" ? $unidad_litros : "") . " " . ($cilindros != "" && $cilindros != "---" ? $cilindros : "") . " " . ($unidad_cilindros != "" && $unidad_cilindros != "---" ? $unidad_cilindros : "") . " " . ($bloqueo_motor != "" && $bloqueo_motor != "---" ? $bloqueo_motor : "");
		$data['motor'] = trim($texto_motor);

		$producto = Producto::create($data);

		$anos = range($producto->ano_inicial, $producto->ano_final);
		$invocacion = "";
		foreach ($anos as $key => $ano) {
			$texto = $ano . " " . $producto->modelo . " " . ($producto->litros != "" && $producto->litros != "---" ? $producto->litros : "") . " " . ($producto->unidad_litros != "" && $producto->unidad_litros != "---" ? $producto->unidad_litros : "") . " " . ($producto->cilindros != "" && $producto->cilindros != "---" ? $producto->cilindros : "") . " " . ($producto->unidad_cilindros != "" && $producto->unidad_cilindros != "---" ? $producto->unidad_cilindros : "") . " " . ($producto->bloqueo_motor != "" && $producto->bloqueo_motor != "---" ? $producto->bloqueo_motor : "");
			$texto = trim($texto);
			$invocacion .= " " . $texto;
			$autocompletar = Autocompletar::where('texto', $texto)->first();
			if ($autocompletar) {
				continue;
			} else {
				Autocompletar::create(['texto' => $texto]);
			}

		}

		$producto->fill(['invocacion' => $invocacion])->save();

		if ($request->archivo) {
			$extension = $request->archivo->getClientOriginalExtension();
			$name = $producto->codigo_nikko;
			$request->archivo->move(public_path() . "/fichas_tecnicas/", $name . "." . $extension);
		}

		$ruta = storage_path('app/imagenes/' . $estampa);

		if (file_exists($ruta)) {
			$ruta_nueva = storage_path('app/public/productos/' . $producto->codigo_nikko);
			$file = new Filesystem();
			$file->moveDirectory($ruta, $ruta_nueva);
		}

		$ruta = storage_path('app/imagenes/' . $estampa . "_360");

		if (file_exists($ruta)) {
			$ruta_nueva = storage_path('app/public/productos/' . $producto->codigo_nikko . "_360");
			$file = new Filesystem();
			$file->moveDirectory($ruta, $ruta_nueva);
		}

		(new SistemaController)->accion([\Auth::user()->id, 'producto', $producto->id, 'agregar', 'El usuario ' . \Auth::user()->name . ' agrego el producto ' . $producto->codigo_nikko]);

		return redirect()->route('productos.index');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
		$seccion = "Productos";
		$breadcrumb = [
			['route' => 'productos.index', 'nombre' => 'Productos'],
			['route' => 'productos.create', 'nombre' => 'Editar'],
		];
		$estampa = date("YmdHis");
		$producto = ProductoBusqueda::find($id);
		return view('productos.editar', compact('seccion', 'breadcrumb', 'producto', 'estampa'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//

		extract($request->all());
		$producto = ProductoBusqueda::find($id);

		$productos = ProductoBusqueda::where('codigo_nikko',$producto->codigo_nikko)->get();

		foreach ($productos as $producto) {
			# code...
				
				$producto->fill([
					'marca_comercial' => $marca_comercial, 
					'codigo_nikko' => $codigo_nikko, 
					'grupo' => $grupo, 
					'subgrupo' => $subgrupo, 
					'descripcion_1' => $descripcion_1, 
					'descripcion_2' => $descripcion_2, 
					'descripcion_3' => $descripcion_3, 
					'caracteristicas_1' => $caracteristicas_1, 
					'caracteristicas_2' => $caracteristicas_2, 
					'caracteristicas_3' => $caracteristicas_3, 
					'caracteristicas_4' => $caracteristicas_4, 
					'equivalencia_1' => $equivalencia_1, 
					'equivalencia_2' => $equivalencia_2, 
					'equivalencia_3' => $equivalencia_3, 
					'equivalencia_4' => $equivalencia_4, 
					'equivalencia_5' => $equivalencia_5, 
					'nuevo' => $nuevo, 
					'vendido' => $vendido, 
					'promocion' => $promocion, 
					'precio_normal' => $precio_normal, 
					'precio_final' => $precio_final, 
					'extra' => $extra, 
					'pagina_principal' => $pagina_principal, 
					'pruebas_ilc' => $pruebas_ilc, 
					'existencias' => $existencias, 
					'minimo_compra_oferta' => $minimo_compra_oferta, 
					'fecha_promocion_inicio' => $fecha_promocion_inicio, 
					'fecha_promocion_final' => $fecha_promocion_final, 
					'extra_clave_1' => $extra_clave_1, 
					'extra_marca_1' => $extra_marca_1, 
					'extra_clave_2' => $extra_clave_2, 
					'extra_marca_2' => $extra_marca_2, 
					'extra_clave_3' => $extra_clave_3, 
					'extra_marca_3' => $extra_marca_3, 
					'codigo_barras' => $codigo_barras, 
					'especial' => $especial, 
					'disponibilidad' => $disponibilidad, 
					'proveedor' => $proveedor, 
					'lo_mas_nuevo' => $lo_mas_nuevo, 
					'clave_producto_proveedor' => $clave_producto_proveedor, 
					'linea' => $linea, 
					'utilidad' => $utilidad, 
					'subfijo' => $subfijo, 
					'multiplo_compra' => $multiplo_compra, 
					'ventas'=>  $ventas
				])->save();
			
				
				

				$textos = $producto->toArray();
				if (isset($textos['id'])) {
					unset($textos['id']);
				}
				unset($textos['nuevo']);
				unset($textos['existencias']);
				unset($textos['minimo_compra_oferta']);
				unset($textos['vendido']);
				unset($textos['promocion']);
				unset($textos['pagina_principal']);
				unset($textos['precio_normal']);
				unset($textos['precio_final']);
				unset($textos['fecha_promocion_inicio']);
				unset($textos['fecha_promocion_final']);
				unset($textos['disponibilidad']);
				unset($textos['proveedor']);
				unset($textos['clave_producto_proveedor']);
				unset($textos['linea']);
				unset($textos['utilidad']);
				unset($textos['subfijo']);
				unset($textos['multiplo_compra']);
				unset($textos['ventas']);


				$anos = range($textos['ano_inicial'], $textos['ano_final']);
				unset($textos['ano_inicial']);
				unset($textos['ano_final']);

				$sin_signos = preg_replace('/[^A-Za-z0-9]/', '', $textos['codigo_nikko']) . " " . ($textos['equivalencia_1'] != "" ? preg_replace('/[^A-Za-z0-9]/', '', $textos['equivalencia_1']) : "") . " " . ($textos['equivalencia_2'] != "" ? preg_replace('/[^A-Za-z0-9]/', '', $textos['equivalencia_2']) : "") . " " . ($textos['equivalencia_3'] != "" ? preg_replace('/[^A-Za-z0-9]/', '', $textos['equivalencia_3']) : "") . " " . ($textos['equivalencia_4'] != "" ? preg_replace('/[^A-Za-z0-9]/', '', $textos['equivalencia_4']) : "") . " " . ($textos['equivalencia_5'] != "" ? preg_replace('/[^A-Za-z0-9]/', '', $textos['equivalencia_5']) : "");

				$buscar = implode(" ", $textos) . " " . implode(" ", $anos) . " " . $sin_signos;
				
				$data_nueva = [];
				$data_nueva['anos'] = implode(" ", $anos);
				$data_nueva['buscador'] = $buscar;
				$data_nueva['codigosinguiones'] = str_replace("-", "", $textos['codigo_nikko']);


				$texto_motor = ($textos['litros'] != "" && $textos['litros'] != "---" ? $textos['litros'] : "") . " " . ($textos['unidad_litros'] != "" && $textos['unidad_litros'] != "---" ? $textos['unidad_litros'] : "") . " " . ($textos['cilindros'] != "" && $textos['cilindros'] != "---" ? $textos['cilindros'] : "") . " " . ($textos['unidad_cilindros'] != "" && $textos['unidad_cilindros'] != "---" ? $textos['unidad_cilindros'] : "") . " " . ($textos['bloqueo_motor'] != "" && $textos['bloqueo_motor'] != "---" ? $textos['bloqueo_motor'] : "");

				$data_nueva['motor'] = trim($texto_motor);

				
				$anos = range($producto->ano_inicial, $producto->ano_final);
				$invocacion = "";
				foreach ($anos as $key => $ano) {
					$texto = $ano . " " . $producto->modelo . " " . ($producto->litros != "" && $producto->litros != "---" ? $producto->litros : "") . " " . ($producto->unidad_litros != "" && $producto->unidad_litros != "---" ? $producto->unidad_litros : "") . " " . ($producto->cilindros != "" && $producto->cilindros != "---" ? $producto->cilindros : "") . " " . ($producto->unidad_cilindros != "" && $producto->unidad_cilindros != "---" ? $producto->unidad_cilindros : "") . " " . ($producto->bloqueo_motor != "" && $producto->bloqueo_motor != "---" ? $producto->bloqueo_motor : "");
					$texto = trim($texto);
					$invocacion .= " " . $texto;
					$autocompletar = Autocompletar::where('texto', $texto)->first();

					if ($autocompletar) {
						continue;
					} else {
						Autocompletar::create(['texto' => $texto]);
					}

				}

				$data_nueva['invocacion'] = $invocacion;

				
				//(new SistemaController)->accion([1, 'producto', $producto->id, 'agregar', 'Se agrego el producto ' . $producto->codigo_nikko . ' via Excel automatico']);

				$productos_extras = [];

				if ($extra_clave_1 != "") {
					$aux = [
						'codigo_destino' => $extra_clave_1,
						'codigos' => [
							'extra_clave_1' => $codigo_nikko,
							'extra_marca_1' => $marca_comercial,
							'extra_clave_2' => $extra_clave_2,
							'extra_marca_2' => $extra_marca_2,
							'extra_clave_3' => $extra_clave_3,
							'extra_marca_3' => $extra_marca_3,

						],
					];
					array_push($productos_extras, $aux);
				}

				if ($extra_clave_2 != "") {

					$aux = [
						'codigo_destino' => $extra_clave_2,
						'codigos' => [
							'extra_clave_1' => $extra_clave_1,
							'extra_marca_1' => $extra_marca_1,
							'extra_clave_2' => $codigo_nikko,
							'extra_marca_2' => $marca_comercial,
							'extra_clave_3' => $extra_clave_3,
							'extra_marca_3' => $extra_marca_3,
						],
					];
					array_push($productos_extras, $aux);
				}

				if ($extra_clave_3 != "") {

					$aux = [
						'codigo_destino' => $extra_clave_3,
						'codigos' => [
							'extra_clave_1' => $extra_clave_1,
							'extra_marca_1' => $extra_marca_1,
							'extra_clave_2' => $extra_clave_2,
							'extra_marca_2' => $extra_marca_2,
							'extra_clave_3' => $codigo_nikko,
							'extra_marca_3' => $marca_comercial,
						],
					];
					array_push($productos_extras, $aux);
				}

				$producto->fill($data_nueva)->save();


				foreach ($productos_extras as $key => $producto_extra) {
					$existe = ProductoBusqueda::where('codigo_nikko', $producto['codigo_destino'])->first();
					if ($existe) {
						$existe->fill($producto_extra['codigos'])->save();
					}

				}
		}


		(new SistemaController)->accion([\Auth::user()->id, 'producto', $producto->id, 'editar', 'El usuario ' . \Auth::user()->name . ' edito el producto ' . $producto->codigo]);
		return redirect()->route('productos.index');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, $id) {
		/*if (Gate::denies('permiso', 'eliminar_publicaciones'))
			           return response()->json([
			                    'code' => 0,
			                    'message' => 'No tienes autorización para realizar esta accion.'
			                ]);
		*/

		if ($request->ajax()) {
			$producto = ProductoBusqueda::findOrFail($id);
			//movimiento del sistema
			(new SistemaController)->accion([\Auth::user()->id, 'producto', $producto->id, 'eliminar', 'El usuario ' . \Auth::user()->name . ' elimino el producto ' . $producto->codigo_nikko]);
			if ($producto->delete()) {
				return response()->json([
					'code' => 1,
					'message' => 'El registro fue eliminado correctamente.',
				]);
			} else {
				return response()->json([
					'code' => 0,
					'message' => 'Ocurrio un error, intentalo nuevamente.',
				]);
			}

		} else {
			abort(403);
		}

	}

	public function data() {
		return DataTables::of(\DB::select("WITH ranked AS (
        SELECT
            codigo_nikko, descripcion_1, marca_comercial, precio_normal, especial,id,
            ROW_NUMBER() OVER (PARTITION BY codigo_nikko ORDER BY id) AS rn
        FROM productos_busqueda
        )
        SELECT marca_comercial, codigo_nikko, descripcion_1, precio_normal ,especial, id
        FROM ranked
        WHERE rn = 1 ORDER BY descripcion_1;"))->addColumn('acciones', function ($producto) {
			return '<a href="' . route('productos.edit', $producto->codigo_nikko) . '" class="btn mr-1 mb-1 btn-outline-success btn-sm btn-block"><i class="fa fa-edit"></i> Editar</a>
            <button type="button" class="btn mr-1 mb-1 btn-outline-danger btn-sm btn-block" data-toggle="modal" data-target="#danger" data-id="' . $producto->codigo_nikko . '" data-funcion="eliminar"><i class="fa fa-close"></i> Eliminar</button>';
		})->rawColumns(['acciones'])->make(true);
	}

	public function agregarImagenes(Request $request) {

		extract($request->all());

		if (isset($carpeta)) {
			$ruta = storage_path('app/public/productos/' . $carpeta);
		} else {
			$ruta = storage_path('app/imagenes/' . $estampa);
		}

		if (!file_exists($ruta)) {
			mkdir($ruta, 0777, true);
		}

		$extension = $request->file->getClientOriginalExtension();
		$name = $request->file->getFilename();
		$request->file->move($ruta, $request->file->getClientOriginalName());

	}

	public function agregarImagenes360(Request $request) {
		extract($request->all());
		if (isset($carpeta)) {
			$ruta = storage_path('app/public/productos/' . $carpeta . "_360");
		} else {
			$ruta = storage_path('app/imagenes/' . $estampa . "_360");
		}

		if (!file_exists($ruta)) {
			mkdir($ruta, 0777, true);
		}

		$extension = $request->file->getClientOriginalExtension();
		$name = $request->file->getFilename();
		$request->file->move($ruta, $request->file->getClientOriginalName());
	}

	public function eliminarImagenes(Request $request) {
		extract($request->all());
		if (isset($estampa)) {
			$ruta = storage_path('app/imagenes/' . $estampa . "/");
		} else {
			$ruta = storage_path('app/public/productos/' . $id_producto . "/");
		}

		unlink($ruta . $name);

	}

	public function eliminarImagenes360(Request $request) {
		extract($request->all());
		if (isset($estampa)) {
			$ruta = storage_path('app/imagenes/' . $estampa . "_360/");
		} else {
			$ruta = storage_path('app/public/productos/' . $id_producto . "_360/");
		}

		unlink($ruta . $name);
	}

	public function subidas(Request $request) {

		extract($request->all());
		if ($tipo == "galeria") {
			$carpeta = 'productos/' . $id;
		} else {
			$carpeta = 'productos/' . $id . '_360';
		}

		$ruta = storage_path('app/public/' . $carpeta);
		$archivos = scandir($ruta);

		$json = array();
		foreach ($archivos as $key => $value) {
			# code...
			if ($value == "." || $value == "..") {
				continue;
			}

			$data = array();
			$archivo = $ruta . "/" . $value;
			$data['name'] = $value;
			$data['size'] = filesize($archivo);
			$data['url'] = asset("storage/" . $carpeta . "/" . $value);
			array_push($json, $data);

		}

		return response()->json($json);
	}

	public function excel() {
		$seccion = "Productos";
		$breadcrumb = [
			['route' => 'productos.index', 'nombre' => 'Productos'],
		];
		return view('productos.subir_excel', compact('seccion', 'breadcrumb'));

	}

	public function uploadExcel(Request $request) {
		ini_set('memory_limit', '-1');
		extract($request->all());
		$mensaje = "";
		$verificador = 0;
		$campos = [
			'id' => true,
			'marca_comercial' => true,
			'codigo_owari' => true,
			'grupo' => true,
			'subgrupo' => true,
			'descripcion_1' => true,
			'descripcion_2' => true,
			'descripcion_3' => true,
			'caracteristicas_1' => true,
			'caracteristicas_2' => true,
			'caracteristicas_3' => true,
			'caracteristicas_4' => true,
			'equivalencia_1' => true,
			'equivalencia_2' => true,
			'equivalencia_3' => true,
			'equivalencia_4' => true,
			'equivalencia_5' => true,
			'oem' => true,
			'armadora' => true,
			'modelo' => true,
			'generacion_mexico' => true,
			'version' => true,
			'ano_inicial' => true,
			'ano_final' => true,
			'litros' => true,
			'unidad_litros' => true,
			'cilindros' => true,
			'unidad_cilindros' => true,
			'bloqueo_motor' => true,
			'aspiracion' => true,
			'arbol_levas' => true,
			'valvulas' => true,
			'eje_transmision' => true,
			'traccion_operacion' => true,
			'especificacion' => true,
			'nuevo' => true,
			'vendido' => true,
			'promocion' => true,
			'precio_normal' => true,
			'precio_final' => true,
			'extra' => true,
			'pagina_principal' => true,
			'pruebas_ilc' => true,
			'existencias' => true,
			'minimo_compra_oferta' => true,
			'fecha_promocion_inicio' => true,
			'fecha_promocion_final' => true,
			'extra_clave_1' => true,
			'extra_marca_1' => true,
			'extra_clave_2' => true,
			'extra_marca_2' => true,
			'extra_clave_3' => true,
			'extra_marca_3' => true,
			'codigo_barras' => true,
			'especial'=> true,
			'disponibilidad'=> true,
			'proveedor'=> true,
			'lo_mas_nuevo'=> true,
			'clave_producto_proveedor' => true,
			'linea' => true,
			'utilidad' => true,
			'subfijo' => true,
			'multiplo_compra' => true,
			'ventas' => true,

		];

		$productos_extras = [];

		if ($request->hasFile('archivo')) {

			$path = $request->file('archivo')->getRealPath();
			$data = \Excel::load($path, function ($reader) {})->get();
			if (!empty($data) && $data->count()) {
				switch ($operacion) {
				case 'agregar':
				case 'actualizar':


					if (!isset($data[0]['codigo_owari'])) {
						$mensaje .= "No existe el campo codigo_owari en tu archivo<br>";
						$verificador = 1;
					}

					if ($operacion == "agregar") {

						if (!isset($data[0]['grupo'])) {
							$mensaje .= "No existe el campo grupo en tu archivo<br>";
							$verificador = 1;
						}
						if (!isset($data[0]['subgrupo'])) {
							$mensaje .= "No existe el campo subgrupo en tu archivo<br>";
							$verificador = 1;
						}
						if (!isset($data[0]['armadora'])) {
							$mensaje .= "No existe el campo armadora en tu archivo<br>";
							$verificador = 1;
						}
						if (!isset($data[0]['modelo'])) {
							$mensaje .= "No existe el campo modelo en tu archivo<br>";
							$verificador = 1;
						}
						if (!isset($data[0]['ano_inicial'])) {
							$mensaje .= "No existe el campo ano_inicial en tu archivo<br>";
							$verificador = 1;
						}
						if (!isset($data[0]['ano_final'])) {
							$mensaje .= "No existe el campo ano_final en tu archivo<br>";
							$verificador = 1;
						}
					}

					foreach ($data[0] as $key => $value) {
						# code...
						if (!isset($campos[$key])) {
							$mensaje .= "El campo " . $key . " no debe de existir en el archivo, verificalo<br>";
							$verificador = 1;
						}
					}

					if ($verificador == 1) {
						\Session::flash('message', $mensaje);
						return redirect()->route('productos.excel');
					}

					foreach ($data as $key => $value) {
						# code...
						$informacion = $value->toArray();
						if ($informacion['codigo_owari'] == "" || $informacion['codigo_owari'] == null) {
							continue;
						}

						$informacion['codigo_nikko'] = $informacion['codigo_owari'];
						unset($informacion['codigo_owari']);
						$textos = $value->toArray();
						if (isset($textos['id'])) {
							unset($textos['id']);
						}

						unset($textos['nuevo']);
						unset($textos['existencias']);
						unset($textos['minimo_compra_oferta']);
						unset($textos['vendido']);
						unset($textos['promocion']);
						unset($textos['pagina_principal']);
						unset($textos['precio_normal']);
						unset($textos['precio_final']);
						unset($textos['fecha_promocion_inicio']);
						unset($textos['fecha_promocion_final']);
						unset($textos['disponibilidad']);
						unset($textos['proveedor']);
						unset($textos['clave_producto_proveedor']);
						unset($textos['linea']);
						unset($textos['utilidad']);
						unset($textos['subfijo']);
						unset($textos['multiplo_compra']);
						unset($textos['ventas']);
						
						$anos = range($textos['ano_inicial'], $textos['ano_final']);
						unset($textos['ano_inicial']);
						unset($textos['ano_final']);
						//unset($textos['codigo_barras']);

						$sin_signos = preg_replace('/[^A-Za-z0-9]/', '', $informacion['codigo_nikko']) . " " . ($informacion['equivalencia_1'] != "" ? preg_replace('/[^A-Za-z0-9]/', '', $informacion['equivalencia_1']) : "") . " " . ($informacion['equivalencia_2'] != "" ? preg_replace('/[^A-Za-z0-9]/', '', $informacion['equivalencia_2']) : "") . " " . ($informacion['equivalencia_3'] != "" ? preg_replace('/[^A-Za-z0-9]/', '', $informacion['equivalencia_3']) : "") . " " . ($informacion['equivalencia_4'] != "" ? preg_replace('/[^A-Za-z0-9]/', '', $informacion['equivalencia_4']) : "") . " " . ($informacion['equivalencia_5'] != "" ? preg_replace('/[^A-Za-z0-9]/', '', $informacion['equivalencia_5']) : "");

						$buscar = implode(" ", $textos) . " " . implode(" ", $anos) . " " . $sin_signos;

						$informacion['anos'] = implode(" ", $anos);
						$informacion['buscador'] = $buscar;
						$informacion['codigosinguiones'] = str_replace("-", "", $informacion['codigo_nikko']);

						$texto_motor = ($informacion['litros'] != "" && $informacion['litros'] != "---" ? $informacion['litros'] : "") . " " . ($informacion['unidad_litros'] != "" && $informacion['unidad_litros'] != "---" ? $informacion['unidad_litros'] : "") . " " . ($informacion['cilindros'] != "" && $informacion['cilindros'] != "---" ? $informacion['cilindros'] : "") . " " . ($informacion['unidad_cilindros'] != "" && $informacion['unidad_cilindros'] != "---" ? $informacion['unidad_cilindros'] : "") . " " . ($informacion['bloqueo_motor'] != "" && $informacion['bloqueo_motor'] != "---" ? $informacion['bloqueo_motor'] : "");
						$informacion['motor'] = trim($texto_motor);

						if ($operacion == 'agregar') {
							$producto = ProductoBusqueda::create($informacion);

							$anos = range($producto->ano_inicial, $producto->ano_final);
							$invocacion = "";
							foreach ($anos as $key => $ano) {
								$texto = $ano . " " . $producto->modelo . " " . ($producto->litros != "" && $producto->litros != "---" ? $producto->litros : "") . " " . ($producto->unidad_litros != "" && $producto->unidad_litros != "---" ? $producto->unidad_litros : "") . " " . ($producto->cilindros != "" && $producto->cilindros != "---" ? $producto->cilindros : "") . " " . ($producto->unidad_cilindros != "" && $producto->unidad_cilindros != "---" ? $producto->unidad_cilindros : "") . " " . ($producto->bloqueo_motor != "" && $producto->bloqueo_motor != "---" ? $producto->bloqueo_motor : "");
								$texto = trim($texto);
								$invocacion .= " " . $texto;
								$autocompletar = Autocompletar::where('texto', $texto)->first();
								if ($autocompletar) {
									continue;
								} else {
									Autocompletar::create(['texto' => $texto]);
								}

							}
							$producto->fill(['invocacion' => $invocacion])->save();

							(new SistemaController)->accion([\Auth::user()->id, 'producto', $producto->id, 'agregar', 'El usuario ' . \Auth::user()->name . ' agrego el producto ' . $producto->codigo_nikko . ' via Excel']);

						} else {
							$producto = ProductoBusqueda::where('id', $informacion['id'])->first();
							if (!$producto) {
								continue;
							}

							$producto->fill($informacion)->save();

							$anos = range($producto->ano_inicial, $producto->ano_final);
							$invocacion = "";
							foreach ($anos as $key => $ano) {
								$texto = $ano . " " . $producto->modelo . " " . ($producto->litros != "" && $producto->litros != "---" ? $producto->litros : "") . " " . ($producto->unidad_litros != "" && $producto->unidad_litros != "---" ? $producto->unidad_litros : "") . " " . ($producto->cilindros != "" && $producto->cilindros != "---" ? $producto->cilindros : "") . " " . ($producto->unidad_cilindros != "" && $producto->unidad_cilindros != "---" ? $producto->unidad_cilindros : "") . " " . ($producto->bloqueo_motor != "" && $producto->bloqueo_motor != "---" ? $producto->bloqueo_motor : "");
								$texto = trim($texto);
								$invocacion .= " " . $texto;
								$autocompletar = Autocompletar::where('texto', $texto)->first();
								if ($autocompletar) {
									continue;
								} else {
									Autocompletar::create(['texto' => $texto]);
								}

							}
							$producto->fill(['invocacion' => $invocacion])->save();

							(new SistemaController)->accion([\Auth::user()->id, 'producto', $producto->id, 'agregar', 'El usuario ' . \Auth::user()->name . ' actualizo el producto ' . $producto->codigo_nikko . ' via Excel']);

						}

						if ($producto->extra_clave_1 != "") {
							$aux = [
								'codigo_destino' => $producto->extra_clave_1,
								'codigos' => [
									'extra_clave_1' => $producto->codigo_nikko,
									'extra_marca_1' => $producto->marca_comercial,
									'extra_clave_2' => $producto->extra_clave_2,
									'extra_marca_2' => $producto->extra_marca_2,
									'extra_clave_3' => $producto->extra_clave_3,
									'extra_marca_3' => $producto->extra_marca_3,

								],
							];
							array_push($productos_extras, $aux);
						}

						if ($producto->extra_clave_2 != "") {

							$aux = [
								'codigo_destino' => $producto->extra_clave_2,
								'codigos' => [
									'extra_clave_1' => $producto->extra_clave_1,
									'extra_marca_1' => $producto->extra_marca_1,
									'extra_clave_2' => $producto->codigo_nikko,
									'extra_marca_2' => $producto->marca_comercial,
									'extra_clave_3' => $producto->extra_clave_3,
									'extra_marca_3' => $producto->extra_marca_3,
								],
							];
							array_push($productos_extras, $aux);
						}

						if ($producto->extra_clave_3 != "") {

							$aux = [
								'codigo_destino' => $producto->extra_clave_3,
								'codigos' => [
									'extra_clave_1' => $producto->extra_clave_1,
									'extra_marca_1' => $producto->extra_marca_1,
									'extra_clave_2' => $producto->extra_clave_2,
									'extra_marca_2' => $producto->extra_marca_2,
									'extra_clave_3' => $producto->codigo_nikko,
									'extra_marca_3' => $producto->marca_comercial,
								],
							];
							array_push($productos_extras, $aux);
						}

						$ruta = storage_path('app/upload_excel/' . $producto->codigo_nikko);

						if (file_exists($ruta)) {
							$ruta_nueva = storage_path('app/public/productos/' . $producto->codigo_nikko);
							$this->deleteDirectory($ruta_nueva);

							if (!file_exists($ruta_nueva)) {
								mkdir($ruta_nueva, 0777, true);
							}

							$archivos = scandir($ruta);

							foreach ($archivos as $llave => $valor) {
								# code...
								if ($valor != "" && $valor != "." && $valor != "..") {
									$ruta_archivo = storage_path('app/upload_excel/' . $producto->codigo_nikko . '/' . $valor);
									if (file_exists($ruta_archivo)) {
										$file = new Filesystem();
										$file->move($ruta_archivo, $ruta_nueva . '/' . $valor);
									}
								}
							}
							$this->deleteDirectory($ruta);

						}

						$ruta = storage_path('app/upload_excel/' . $producto->codigo_nikko . "_360");

						if (file_exists($ruta)) {
							$ruta_nueva = public_path() . "/360/" . $valor;
							if (file_exists($ruta_nueva)) {
								$this->deleteDirectory($ruta_nueva);
							}

							if (!file_exists($ruta_nueva)) {
								mkdir($ruta_nueva, 0777, true);
							}

							$this->copyDirectory($ruta, $ruta_nueva);
							$this->deleteDirectory($ruta);
						}

					}

					foreach ($productos_extras as $key => $producto) {
						$existe = ProductoBusqueda::where('codigo_nikko', $producto['codigo_destino'])->first();
						if ($existe) {
							$existe->fill($producto['codigos'])->save();
						}

					}

					$mensaje = "La informacion fue migrada correctamente";
					\Session::flash('message', $mensaje);
					\Session::flash('code', 1);
					return redirect()->route('productos.excel');

					break;
				case 'eliminar':
					foreach ($data as $key => $value) {
						$informacion = $value->toArray();
						$producto = ProductoBusqueda::where('id', $informacion['id'])->first();
						if ($producto) {
							$producto->delete();
						}

					}
					$mensaje = "La informacion del catalogo fue eliminada correctamente";
					\Session::flash('message', $mensaje);
					\Session::flash('code', 1);
					return redirect()->route('productos.excel');

					break;

				default:
					\Session::flash('message', 'Opcion seleccionada incorrecta, intenta mas tarde');
					break;
				}

			} else {
				\Session::flash('message', 'El archivo esta vacio, rellena con la informacion correcta.');
			}

		} else {
			\Session::flash('message', 'Archivo invalido, intenta nuevamente.');
		}

		return redirect()->route('productos.excel');

	}

	public function vaciarTabla() {
		ProductoBusqueda::query()->truncate();
		$mensaje = "La informacion del catalogo fue eliminada correctamente";
		\Session::flash('message', $mensaje);
		\Session::flash('code', 1);
		(new SistemaController)->accion([\Auth::user()->id, 'producto', 0, 'vaciar_tabla', 'El usuario ' . \Auth::user()->name . ' vacio la tabla de productos del sistema']);
		return redirect()->route('productos.excel');
	}

	public function respaldoTabla() {
		ini_set('memory_limit', '-1');

		$productos = \DB::table('productos_busqueda')->orderBy('codigo_nikko', 'asc')->orderBy('armadora', 'asc')->get()->toArray();
		$arreglo_productos[] = array(
			'ID',
			'marca_comercial',
			'codigo_owari',
			'grupo',
			'subgrupo',
			'descripcion_1',
			'descripcion_2',
			'descripcion_3',
			'caracteristicas_1',
			'caracteristicas_2',
			'caracteristicas_3',
			'caracteristicas_4',
			'equivalencia_1',
			'equivalencia_2',
			'equivalencia_3',
			'equivalencia_4',
			'equivalencia_5',
			'oem',
			'armadora',
			'modelo',
			'generacion_mexico',
			'version',
			'ano_inicial',
			'ano_final',
			'litros',
			'unidad_litros',
			'cilindros',
			'unidad_cilindros',
			'bloqueo_motor',
			'aspiracion',
			'arbol_levas',
			'valvulas',
			'eje_transmision',
			'traccion_operacion',
			'especificacion',
			'nuevo',
			'promocion',
			'vendido',
			'precio_normal',
			'precio_final',
			'extra',
			'pagina_principal',
			'pruebas_ilc',
			'existencias',
			'minimo_compra_oferta',
			'fecha_promocion_inicio',
			'fecha_promocion_final',
			'extra_clave_1',
			'extra_marca_1',
			'extra_clave_2',
			'extra_marca_2',
			'extra_clave_3',
			'extra_marca_3',
			'codigo_barras',
			'especial',
			'disponibilidad',
			'proveedor',
			'lo_mas_nuevo',
			'clave_producto_proveedor',
			'linea',
			'utilidad',
			'subfijo',
			'multiplo_compra',
			'ventas'
			
		);
		foreach ($productos as $producto) {
			$arreglo_productos[] = array(
				'ID' => $producto->id,
				'marca_comercial' => $producto->marca_comercial,
				'codigo_owari' => $producto->codigo_nikko,
				'grupo' => $producto->grupo,
				'subgrupo' => $producto->subgrupo,
				'descripcion_1' => $producto->descripcion_1,
				'descripcion_2' => $producto->descripcion_2,
				'descripcion_3' => $producto->descripcion_3,
				'caracteristicas_1' => $producto->caracteristicas_1,
				'caracteristicas_2' => $producto->caracteristicas_2,
				'caracteristicas_3' => $producto->caracteristicas_3,
				'caracteristicas_4' => $producto->caracteristicas_4,
				'equivalencia_1' => $producto->equivalencia_1,
				'equivalencia_2' => $producto->equivalencia_2,
				'equivalencia_3' => $producto->equivalencia_3,
				'equivalencia_4' => $producto->equivalencia_4,
				'equivalencia_5' => $producto->equivalencia_5,
				'oem' => $producto->oem,
				'armadora' => $producto->armadora,
				'modelo' => $producto->modelo,
				'generacion_mexico' => $producto->generacion_mexico,
				'version' => $producto->version,
				'ano_inicial' => $producto->ano_inicial,
				'ano_final' => $producto->ano_final,
				'litros' => $producto->litros,
				'unidad_litros' => $producto->unidad_litros,
				'cilindros' => $producto->cilindros,
				'unidad_cilindros' => $producto->unidad_cilindros,
				'bloqueo_motor' => $producto->bloqueo_motor,
				'aspiracion' => $producto->aspiracion,
				'arbol_levas' => $producto->arbol_levas,
				'valvulas' => $producto->valvulas,
				'eje_transmision' => $producto->eje_transmision,
				'traccion_operacion' => $producto->traccion_operacion,
				'especificacion' => $producto->especificacion,
				'nuevo' => $producto->nuevo,
				'promocion' => $producto->promocion,
				'vendido' => $producto->vendido,
				'precio_normal' => $producto->precio_normal == "" ? 0 : $producto->precio_normal,
				'precio_final' => $producto->precio_final == "" ? 0 : $producto->precio_final,
				'extra' => $producto->extra,
				'pagina_principal' => $producto->pagina_principal,
				'pruebas_ilc' => $producto->pruebas_ilc,
				'existencias' => $producto->existencias,
				'minimo_compra_oferta' => $producto->minimo_compra_oferta,
				'fecha_promocion_inicio' => $producto->fecha_promocion_inicio,
				'fecha_promocion_final' => $producto->fecha_promocion_final,
				'extra_clave_1' => $producto->extra_clave_1,
				'extra_marca_1' => $producto->extra_marca_1,
				'extra_clave_2' => $producto->extra_clave_2,
				'extra_marca_2' => $producto->extra_marca_2,
				'extra_clave_3' => $producto->extra_clave_3,
				'extra_marca_3' => $producto->extra_marca_3,
				'codigo_barras' => $producto->codigo_barras,
				'especial' => $producto->especial,
				'disponibilidad' => $producto->disponibilidad,
				'proveedor' => $producto->proveedor,
				'lo_mas_nuevo' => $producto->lo_mas_nuevo,
				'clave_producto_proveedor' => $producto->clave_producto_proveedor,
				'linea' => $producto->linea,
				'utilidad' => $producto->utilidad,
				'subfijo' => $producto->subfijo,
				'multiplo_compra' => $producto->multiplo_compra,
				'ventas' => $producto->ventas
			);
		}

		\Excel::create('ProductosOwari', function ($excel) use ($arreglo_productos) {
			$excel->setTitle('Productos catalogo Owari');
			$excel->sheet('Producto', function ($sheet) use ($arreglo_productos) {
				$sheet->fromArray($arreglo_productos, null, 'A1', false, false);
			});
		})->download('xlsx');

	}

	public function actualizarImagenes() {

		//genera las carpetas

		$ruta = storage_path('app/upload_excel');
		$archivos = scandir($ruta);

		foreach ($archivos as $llave => $valor) {

			if ($valor == ".." || $valor == "." || $valor == ".DS_Store") {
				continue;
			}

			if (is_dir($ruta . '/' . $valor)) {
				continue;
			}

			$ext = pathinfo($valor, PATHINFO_EXTENSION);
			$file = basename($valor, "." . $ext);

			$nombre_repetido = explode(' (', $valor);
			if (count($nombre_repetido) >= 2) {
				$file = $nombre_repetido[0];
			}

			$ruta_nueva = storage_path('app/upload_excel') . "/" . $file;
			if (!file_exists($ruta_nueva)) {
				mkdir($ruta_nueva, 0777, true);
			}

			$file = new Filesystem();
			$file->move($ruta . "/" . $valor, $ruta_nueva . '/' . str_replace(' ', '-', $valor));

		}
		//Mueve las carpeta

		$ruta = storage_path('app/upload_excel');
		$archivos = scandir($ruta);

		foreach ($archivos as $llave => $valor) {
			# code...
			if (is_file($ruta . '/' . $valor)) {
				continue;
			}

			if ($valor != "" && $valor != "." && $valor != "..") {
				if (is_dir($ruta . "/" . $valor)) {

					$len = strlen('_360');
					if ($len == 0) {
						return true;
					}
					$es360 = (substr($valor, -$len) === '_360');

					if ($es360) {
						$ruta_nueva = public_path() . "/360/" . $valor;
						$this->deleteDirectory($ruta_nueva);
						if (!file_exists($ruta_nueva)) {
							mkdir($ruta_nueva, 0777, true);
						}

						$this->copyDirectory($ruta . "/" . $valor, $ruta_nueva);
						$this->deleteDirectory($ruta . "/" . $valor);
					} else {
						$ruta_nueva = storage_path('app/public/productos/' . $valor);
						$this->deleteDirectory($ruta_nueva);
						if (!file_exists($ruta_nueva)) {
							mkdir($ruta_nueva, 0777, true);
						}

						$nuevos_archivos = scandir($ruta . "/" . $valor);

						foreach ($nuevos_archivos as $key => $value) {
							# code...
							if ($value != "" && $value != "." && $value != "..") {
								$ruta_archivo = storage_path('app/upload_excel/' . $valor . '/' . $value);
								if (file_exists($ruta_archivo)) {
									$file = new Filesystem();
									$file->move($ruta_archivo, $ruta_nueva . '/' . $value);
								}
							}
						}
						$this->deleteDirectory($ruta . "/" . $valor);
					}
				} else {
					unlink($ruta . "/" . $valor);
				}

			}
		}

		$mensaje = "Las imagenes fueron actualizadas correctamente.";
		\Session::flash('message', $mensaje);
		\Session::flash('code', 1);
		(new SistemaController)->accion([\Auth::user()->id, 'producto', 0, 'actualizar_imagenes', 'El usuario ' . \Auth::user()->name . ' actualizo las imagenes del sistema.']);
		return redirect()->route('productos.excel');
	}

	function deleteDirectory($dir) {
		if (!file_exists($dir)) {
			return true;
		}

		if (!is_dir($dir)) {
			return unlink($dir);
		}

		foreach (scandir($dir) as $item) {
			if ($item == '.' || $item == '..') {
				continue;
			}

			if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
				return false;
			}

		}

		return rmdir($dir);
	}

	function copyDirectory($src, $dst) {

		// open the source directory
		$dir = opendir($src);

		// Make the destination directory if not exist
		@mkdir($dst);

		// Loop through the files in source directory
		while ($file = readdir($dir)) {

			if (($file != '.') && ($file != '..')) {
				if (is_dir($src . '/' . $file)) {

					// Recursively calling custom copy function
					// for sub directory
					$this->copyDirectory($src . '/' . $file, $dst . '/' . $file);

				} else {
					copy($src . '/' . $file, $dst . '/' . $file);
				}
			}
		}

		closedir($dir);
	}

	public function verCarpetas() {
		$seccion = "Productos";
		$breadcrumb = [
			['route' => 'productos.index', 'nombre' => 'Productos'],
		];

		$ruta = storage_path('app/public/productos');
		$archivos = scandir($ruta);

		$data = [];
		foreach ($archivos as $key => $value) {
			if ($value != '.' && $value != "..") {
				array_push($data, ['carpeta' => $value]);
			}
		}

		\Excel::create('CarpetasFotosOwari', function ($excel) use ($data) {
			$excel->setTitle('Carpetas fotos');
			$excel->sheet('Carpetas', function ($sheet) use ($data) {
				$sheet->fromArray($data, null, 'A1', false, false);
			});
		})->download('xlsx');

		return view('productos.carpetas', compact('seccion', 'breadcrumb', 'archivos'));
	}

	public function verCarpetasFotos() {
		$seccion = "Productos";
		$breadcrumb = [
			['route' => 'productos.index', 'nombre' => 'Productos'],
		];

		$ruta = storage_path('app/public/productos');
		$archivos = scandir($ruta);

		return view('productos.carpetas_fotos', compact('seccion', 'breadcrumb', 'archivos'));
	}

	public function anexarImagenes() {

		$ruta = storage_path('app/upload_excel');
		$archivos = scandir($ruta);

		foreach ($archivos as $llave => $valor) {

			if ($valor == ".." || $valor == "." || $valor == ".DS_Store") {
				continue;
			}

			if (is_dir($ruta . '/' . $valor)) {
				continue;
			}

			$ext = pathinfo($valor, PATHINFO_EXTENSION);
			$file = basename($valor, "." . $ext);

			$nombre_repetido = explode(' (', $valor);
			if (count($nombre_repetido) >= 2) {
				$file = $nombre_repetido[0];
			}

			$ruta_nueva = storage_path('app/public/productos/' . $file);
			if (!file_exists($ruta_nueva)) {
				mkdir($ruta_nueva, 0777, true);
			}

			$ruta_archivo = storage_path('app/upload_excel/' . $valor);
			$file = new Filesystem();
			$file->move($ruta_archivo, $ruta_nueva . '/' . str_replace(' ', '-', $valor));

		}

		$mensaje = "Las imagenes fueron anexadas correctamente.";
		\Session::flash('message', $mensaje);
		\Session::flash('code', 1);
		(new SistemaController)->accion([\Auth::user()->id, 'producto', 0, 'actualizar_imagenes', 'El usuario ' . \Auth::user()->name . ' anexo las imagenes del sistema.']);
		return redirect()->route('productos.excel');

	}

	public function actualizarAhora() {
		// Paso 1: Obtener el sql_mode actual
		$sqlModeOriginal = \DB::selectOne("SELECT @@SESSION.sql_mode as mode")->mode;

		// Paso 2: Quitar el modo estricto
		\DB::statement("SET SESSION sql_mode = ''");
		ini_set('memory_limit', '-1');
		$archivo = '/var/www/vhosts/owari.com.mx/automatico/plantilla.xlsx';
		if (!is_file($archivo)) {
			$mensaje = "No existe el archivo";
			return $mensaje;
		}

		$operacion = "agregar";
		$mensaje = "";
		$verificador = 0;
		$campos = [
			'id' => true,
			'marca_comercial' => true,
			'codigo_owari' => true,
			'grupo' => true,
			'subgrupo' => true,
			'descripcion_1' => true,
			'descripcion_2' => true,
			'descripcion_3' => true,
			'caracteristicas_1' => true,
			'caracteristicas_2' => true,
			'caracteristicas_3' => true,
			'caracteristicas_4' => true,
			'equivalencia_1' => true,
			'equivalencia_2' => true,
			'equivalencia_3' => true,
			'equivalencia_4' => true,
			'equivalencia_5' => true,
			'oem' => true,
			'armadora' => true,
			'modelo' => true,
			'generacion_mexico' => true,
			'version' => true,
			'ano_inicial' => true,
			'ano_final' => true,
			'litros' => true,
			'unidad_litros' => true,
			'cilindros' => true,
			'unidad_cilindros' => true,
			'bloqueo_motor' => true,
			'aspiracion' => true,
			'arbol_levas' => true,
			'valvulas' => true,
			'eje_transmision' => true,
			'traccion_operacion' => true,
			'especificacion' => true,
			'nuevo' => true,
			'vendido' => true,
			'promocion' => true,
			'precio_normal' => true,
			'precio_final' => true,
			'extra' => true,
			'pagina_principal' => true,
			'pruebas_ilc' => true,
			'existencias' => true,
			'minimo_compra_oferta' => true,
			'fecha_promocion_inicio' => true,
			'fecha_promocion_final' => true,
			'extra_clave_1' => true,
			'extra_marca_1' => true,
			'extra_clave_2' => true,
			'extra_marca_2' => true,
			'extra_clave_3' => true,
			'extra_marca_3' => true,
			'codigo_barras' => true,
			'especial' =>true,
			'disponibilidad' =>true,
			'proveedor' =>true,
			'lo_mas_nuevo' => true,
			'clave_producto_proveedor' => true,
			'linea' => true,
			'utilidad' => true,
			'subfijo' => true,
			'multiplo_compra' => true,
			'ventas' => true
		];

		$productos_extras = [];

		$path = $archivo;
		$data = \Excel::load($path, function ($reader) {})->get();
		if (!empty($data) && $data->count()) {

			if (!isset($data[0]['codigo_owari'])) {
				$mensaje .= "No existe el campo codigo_owari en tu archivo<br>";
				$verificador = 1;
			}

			if ($operacion == "agregar") {

				if (!isset($data[0]['grupo'])) {
					$mensaje .= "No existe el campo grupo en tu archivo<br>";
					$verificador = 1;
				}
				if (!isset($data[0]['subgrupo'])) {
					$mensaje .= "No existe el campo subgrupo en tu archivo<br>";
					$verificador = 1;
				}
				if (!isset($data[0]['armadora'])) {
					$mensaje .= "No existe el campo armadora en tu archivo<br>";
					$verificador = 1;
				}
				if (!isset($data[0]['modelo'])) {
					$mensaje .= "No existe el campo modelo en tu archivo<br>";
					$verificador = 1;
				}
				if (!isset($data[0]['ano_inicial'])) {
					$mensaje .= "No existe el campo ano_inicial en tu archivo<br>";
					$verificador = 1;
				}
				if (!isset($data[0]['ano_final'])) {
					$mensaje .= "No existe el campo ano_final en tu archivo<br>";
					$verificador = 1;
				}
			}

			foreach ($data[0] as $key => $value) {
				# code...
				if (!isset($campos[$key])) {
					$mensaje .= "El campo " . $key . " no debe de existir en el archivo, verificalo<br>";
					$verificador = 1;
				}
			}

			if ($verificador == 1) {
				return $mensaje;
			}

			ProductoBusquedaDos::query()->truncate();
			AutocompletarDos::query()->truncate();
			
			$data_productos = [];
			$data_autocompletar = [];
			$data_autocompletar_completo = [];
			$contado = 0;
			foreach ($data as $key => $value) {
				# code...
				$informacion = $value->toArray();
				if ($informacion['codigo_owari'] == "" || $informacion['codigo_owari'] == null) {
					continue;
				}

				$informacion['codigo_nikko'] = $informacion['codigo_owari'];
				unset($informacion['codigo_owari']);
				$textos = $value->toArray();
				if (isset($textos['id'])) {
					unset($textos['id']);
				}

				unset($textos['nuevo']);
				unset($textos['existencias']);
				unset($textos['minimo_compra_oferta']);
				unset($textos['vendido']);
				unset($textos['promocion']);
				unset($textos['pagina_principal']);
				unset($textos['precio_normal']);
				unset($textos['precio_final']);
				unset($textos['fecha_promocion_inicio']);
				unset($textos['fecha_promocion_final']);


				unset($textos['disponibilidad']);
				unset($textos['proveedor']);

				unset($textos['clave_producto_proveedor']);
				unset($textos['linea']);
				unset($textos['utilidad']);
				unset($textos['subfijo']);
				unset($textos['multiplo_compra']);
				unset($textos['ventas']);
				

				$anos = range($textos['ano_inicial'], $textos['ano_final']);
				unset($textos['ano_inicial']);
				unset($textos['ano_final']);
				//unset($textos['codigo_barras']);

				$sin_signos = preg_replace('/[^A-Za-z0-9]/', '', $informacion['codigo_nikko']) . " " . ($informacion['equivalencia_1'] != "" ? preg_replace('/[^A-Za-z0-9]/', '', $informacion['equivalencia_1']) : "") . " " . ($informacion['equivalencia_2'] != "" ? preg_replace('/[^A-Za-z0-9]/', '', $informacion['equivalencia_2']) : "") . " " . ($informacion['equivalencia_3'] != "" ? preg_replace('/[^A-Za-z0-9]/', '', $informacion['equivalencia_3']) : "") . " " . ($informacion['equivalencia_4'] != "" ? preg_replace('/[^A-Za-z0-9]/', '', $informacion['equivalencia_4']) : "") . " " . ($informacion['equivalencia_5'] != "" ? preg_replace('/[^A-Za-z0-9]/', '', $informacion['equivalencia_5']) : "");

				$buscar = implode(" ", $textos) . " " . implode(" ", $anos) . " " . $sin_signos;

				$informacion['anos'] = implode(" ", $anos);
				$informacion['buscador'] = $buscar;
				$informacion['codigosinguiones'] = str_replace("-", "", $informacion['codigo_nikko']);


				$texto_motor = ($informacion['litros'] != "" && $informacion['litros'] != "---" ? $informacion['litros'] : "") . " " . ($informacion['unidad_litros'] != "" && $informacion['unidad_litros'] != "---" ? $informacion['unidad_litros'] : "") . " " . ($informacion['cilindros'] != "" && $informacion['cilindros'] != "---" ? $informacion['cilindros'] : "") . " " . ($informacion['unidad_cilindros'] != "" && $informacion['unidad_cilindros'] != "---" ? $informacion['unidad_cilindros'] : "") . " " . ($informacion['bloqueo_motor'] != "" && $informacion['bloqueo_motor'] != "---" ? $informacion['bloqueo_motor'] : "");
				$informacion['motor'] = trim($texto_motor);

				//$producto = ProductoBusqueda::create($informacion);
				$producto = (object) $informacion;
				

				$anos = range($producto->ano_inicial, $producto->ano_final);
				$invocacion = "";
				foreach ($anos as $key => $ano) {
					$texto = $ano . " " . $producto->modelo . " " . ($producto->litros != "" && $producto->litros != "---" ? $producto->litros : "") . " " . ($producto->unidad_litros != "" && $producto->unidad_litros != "---" ? $producto->unidad_litros : "") . " " . ($producto->cilindros != "" && $producto->cilindros != "---" ? $producto->cilindros : "") . " " . ($producto->unidad_cilindros != "" && $producto->unidad_cilindros != "---" ? $producto->unidad_cilindros : "") . " " . ($producto->bloqueo_motor != "" && $producto->bloqueo_motor != "---" ? $producto->bloqueo_motor : "");
					$texto = trim($texto);
					$invocacion .= " " . $texto;
					//$autocompletar = Autocompletar::where('texto', $texto)->first();

					if (in_array($texto, $data_autocompletar_completo)) {
						continue;
					} else {
						array_push($data_autocompletar_completo,['texto' => $texto]);
						array_push($data_autocompletar,['texto' => $texto]);
						//Autocompletar::create(['texto' => $texto]);
					}

				}
				//$producto->fill(['invocacion' => $invocacion])->save();
				$informacion['invocacion'] = $invocacion;
				array_push($data_productos,$informacion); 
				//(new SistemaController)->accion([1, 'producto', $producto->id, 'agregar', 'Se agrego el producto ' . $producto->codigo_nikko . ' via Excel automatico']);

				if ($producto->extra_clave_1 != "") {
					$aux = [
						'codigo_destino' => $producto->extra_clave_1,
						'codigos' => [
							'extra_clave_1' => $producto->codigo_nikko,
							'extra_marca_1' => $producto->marca_comercial,
							'extra_clave_2' => $producto->extra_clave_2,
							'extra_marca_2' => $producto->extra_marca_2,
							'extra_clave_3' => $producto->extra_clave_3,
							'extra_marca_3' => $producto->extra_marca_3,

						],
					];
					array_push($productos_extras, $aux);
				}

				if ($producto->extra_clave_2 != "") {

					$aux = [
						'codigo_destino' => $producto->extra_clave_2,
						'codigos' => [
							'extra_clave_1' => $producto->extra_clave_1,
							'extra_marca_1' => $producto->extra_marca_1,
							'extra_clave_2' => $producto->codigo_nikko,
							'extra_marca_2' => $producto->marca_comercial,
							'extra_clave_3' => $producto->extra_clave_3,
							'extra_marca_3' => $producto->extra_marca_3,
						],
					];
					array_push($productos_extras, $aux);
				}

				if ($producto->extra_clave_3 != "") {

					$aux = [
						'codigo_destino' => $producto->extra_clave_3,
						'codigos' => [
							'extra_clave_1' => $producto->extra_clave_1,
							'extra_marca_1' => $producto->extra_marca_1,
							'extra_clave_2' => $producto->extra_clave_2,
							'extra_marca_2' => $producto->extra_marca_2,
							'extra_clave_3' => $producto->codigo_nikko,
							'extra_marca_3' => $producto->marca_comercial,
						],
					];
					array_push($productos_extras, $aux);
				}

				if(count($data_productos) == 100){
					ProductoBusquedaDos::insert($data_productos);
					AutocompletarDos::insert($data_autocompletar);
					$data_productos = [];
					$data_autocompletar = [];
				}


			}

			ProductoBusquedaDos::insert($data_productos);
			AutocompletarDos::insert($data_autocompletar);



			foreach ($productos_extras as $key => $producto) {
				$existe = ProductoBusquedaDos::where('codigo_nikko', $producto['codigo_destino'])->first();
				if ($existe) {
					$existe->fill($producto['codigos'])->save();
				}

			}

			// Paso 4: Restaurar el modo original
			\DB::statement("SET SESSION sql_mode = ?", [$sqlModeOriginal]);
			$mensaje = "La informacion fue migrada correctamente";
			return $mensaje;

		} else {
			return 'El archivo esta vacio, rellena con la informacion correcta.';
		}

	}

	public function editar($id) {
		//
		$seccion = "Productos";
		$breadcrumb = [
			['route' => 'productos.index', 'nombre' => 'Productos'],
			['route' => 'productos.create', 'nombre' => 'Editar'],
		];
		$estampa = date("YmdHis");
		$producto = ProductoBusqueda::find($id);
		return view('productos.editar', compact('seccion', 'breadcrumb', 'producto', 'estampa'));
	}

	public function borrar(Request $request, $id) {
		$producto = ProductoBusqueda::find($id);
		$productos = ProductoBusqueda::where('codigo_nikko',$producto->codigo_nikko)->get();
		foreach($productos as $dato){
			$dato->delete();
		}

		//movimiento del sistema
		(new SistemaController)->accion([\Auth::user()->id, 'producto', $producto->id, 'eliminar', 'El usuario ' . \Auth::user()->name . ' elimino el producto ' . $producto->codigo_nikko]);


		return redirect()->route('productos.index');
		
	}

	public function somaProductos(){
		$productos = ProductoBusqueda::selectRaw('
		    codigo_nikko  as clave, 
		    MIN(descripcion_1)  as descripcion, 
		    MIN(descripcion_1)  as descripcion_larga,
		    MIN(marca_comercial)  as id_marca, 
		    MIN(REPLACE(linea,"-","")) as id_linea, 
		    MIN(multiplo_compra)  as multiplo_venta, 
		    ""  as dias_devolucion, 
		    ""  as dias_garantia, 
		    MIN(proveedor)  as proveedor,
			MIN(precio_normal) as precio_base
		')
		->groupBy('codigo_nikko')
		->get();


		return response()->json($productos->toArray());
	}

	public function somaMarcas(){
		$productos = ProductoBusqueda::selectRaw('marca_comercial')->where('marca_comercial','!=',null)->distinct('marca_comercial')->orderBy('marca_comercial','asc')->get();
		return response()->json($productos->toArray());
	}

	public function somaLineas(){
		$productos = ProductoBusqueda::selectRaw('REPLACE(linea,"-","") as linea')->where('linea','!=',null)->distinct('linea')->orderBy('linea','asc')->get();
		return response()->json($productos->toArray());
	}

	public function somaProductosAplicaciones(){
		$productos = ProductoBusqueda::selectRaw('
		    codigo_nikko  as clave, 
		   	armadora as armadora,
			modelo as modelo,
			generacion_mexico as generacion_mexico,
			version as version,
			ano_inicial as ano_inicio,
			ano_final as ano_fin,
			litros as litros,
			unidad_litros as unidad_litros,
			cilindros as cilindros,
			unidad_cilindros as unidad_cilindros,
			bloqueo_motor as bloqueo_motor,
			motor as motor,
			aspiracion as aspiracion,
			arbol_levas as arbol_levas,
			valvulas as valvulas,
			eje_transmision as eje_transmision,
			traccion_operacion as traccion_operacion,
			especificacion as especificacion
		')
		->get();


		return response()->json($productos->toArray());
	}


	public function somaProductosEquivalencias(){
		$productos = ProductoBusqueda::selectRaw('
		    codigo_nikko  as clave, 
		    extra_clave_1,
		    extra_marca_1,
		    extra_clave_2,
		    extra_marca_2,
		    extra_clave_3,
		    extra_marca_3
		')
		->whereRaw('extra_clave_1 is not null or extra_clave_2 is not null or extra_clave_3 is not null')
		->groupBy('codigo_nikko','extra_clave_1','extra_marca_1',
		    'extra_clave_2',
		    'extra_marca_2',
		    'extra_clave_3',
		    'extra_marca_3')
		->get();
		return response()->json($productos->toArray());
	}

	public function somaProductosWeb(){
		$productos = ProductoBusqueda::selectRaw('
		    codigo_nikko  as clave, 
		    MIN(codigosinguiones) as clave_simple,
		    MIN(grupo) as grupo,
		    MIN(subgrupo) as subgrupo,
		    MIN(descripcion_1) as descripcion_1,
		    MIN(descripcion_2) as descripcion_2,	
		    MIN(descripcion_3) as descripcion_3,
		    MIN(caracteristicas_1) as caracteristicas_1,
		    MIN(caracteristicas_2) as caracteristicas_2,	
		    MIN(caracteristicas_3) as caracteristicas_3,
		    MIN(caracteristicas_4) as caracteristicas_4,
		    MIN(oem) as oem,
		    MIN(nuevo) as nuevo,
		    MIN(vendido) as mas_vendido,
		    MIN(pagina_principal) as mostrar_pagina_principal
		')
		->groupBy('codigo_nikko')
		->get();
		return response()->json($productos->toArray());
	}

}
