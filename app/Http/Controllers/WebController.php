<?php

namespace App\Http\Controllers;

use App\Models\BannerPrincipal;
use App\Models\Boletines;
use App\Models\Catalogos;
use App\Models\DatosGenerales;
use App\Models\Marca;
use App\Models\ProductoBusqueda;
use Illuminate\Http\Request;

class WebController extends Controller {
	//

	public function __construct() {
		$general = DatosGenerales::find(1);
		$catalogos_recientes = Catalogos::orderBy('ordenamiento', 'asc')->limit(3)->get();
		$categorias = $this->categorias();
		\View::share('general', $general);
		\View::share('categorias', $categorias);
		\View::share('catalogos_recientes', $catalogos_recientes);
	}

	public function index() {

		//dd(request()->route()->getAction());
		$slider = BannerPrincipal::orderBy('ordenamiento', 'asc')->whereRaw("'" . date('Y-m-d H:i:s') . "' BETWEEN fecha_inicio AND fecha_fin")->get();
		$marcas = Marca::orderBy('ordenamiento', 'asc')->get();
		$catalogos = Catalogos::orderBy('ordenamiento', 'asc')->limit(4)->get();
		$boletines = Boletines::orderBy('id', 'desc')->limit(12)->get();
		$productos = ProductoBusqueda::select('codigo_nikko', 'descripcion_1')->where('pagina_principal', 1)->get();

		$titulo = "Home";

		return view('web.home', compact('slider', 'marcas', 'catalogos', 'boletines', 'productos', 'titulo'));
	}

	public function quienesSomos() {
		$titulo = "Quienes somos";
		return view('web.quienes_somos', compact('titulo'));
	}

	public function marcas() {
		$titulo = "Marcas";
		$marcas = Marca::orderBy('ordenamiento', 'asc')->get();
		return view('web.marcas', compact('marcas', 'titulo'));
	}

	public function verMarca($id) {
		$marca = Marca::find($id);
		$titulo = "Marca " . $marca->nombre;
		return view('web.ver_marca', compact('marca', 'titulo'));
	}

	public function catalogos() {
		$titulo = "Catalogos";
		$catalogos = Catalogos::orderBy('ordenamiento', 'asc')->get();
		return view('web.catalogos', compact('catalogos', 'titulo'));
	}

	public function boletines() {
		$titulo = "Boletines";
		$boletines = Boletines::orderBy('id', 'desc')->get();
		return view('web.boletines', compact('boletines', 'titulo'));
	}

	public function productos(Request $request) {

		/*
			        q = query
			        c = subgrupo de busqueda
			        p = pagina
			        a = autocompletar
			        f = filtro

		*/

		extract($request->all());

		$p = $p ?? 1;

		
		if(!isset($q)){
			$q="";
			$p=1;
		}

		$q = trim($q);
		if($q == "")
			$q="LO MAS NUEVO";

		/*tipos de busqueda*/
		$busqueda = "";
		if (isset($c)) {
			$query = $this->query('categoria', $q);
			$busqueda = "Resultados por CATEGORIA: " . $q;
			$peticion = "?q=" . $q . "&c=" . $c . "&p=";

		} else if (isset($a)) {
			$query = $this->query('autocompletar', $q);
			$busqueda = "Resultados para: " . $q;
			$peticion = "?q=" . $q . "&a=" . $a . "&p=";
		} else if (isset($f)) {
			$busqueda = "Resultados para busqueda por filtrado";
			$q = [
				"ano" => $ano,
				"marca" => $marca,
				"modelo" => $modelo,
				"motor" => $motor,
				"grupo" => $grupo,
				"familia" => $familia,
			];
			$query = $this->query('filtro', $q);
			$peticion = "?q=" . $q . "&c=" . $c . "&p=";
		} else if ($q == "") {
			$query = $this->query('todos', $q);
			$busqueda = "Todos los productos";
			$peticion = "?q=" . $q . "&p=";
		} else {
			if($q == "LO MAS NUEVO" || $q == "lo mas nuevo" || $q == "nuevo" || $q == "NUEVO"){
				$query = $this->query('nuevo', $q);
			}
			elseif (stripos($q, ' ') !== false) {
				$query = $this->query('palabras', $q);
			} else {
				// Normalizar: quitar guiones y caracteres especiales para buscar en buscador/codigosinguiones
				$q_normalizado = preg_replace('/[^A-Za-z0-9]/', '', $q);
				$query = $this->query('palabra', $q_normalizado);
			}

			$busqueda = "Resultados para: " . $q;
			$peticion = "?q=" . $q . "&p=";
		}
		$resultados = \DB::select($query);
		$resultados = array_intersect_key($resultados, array_unique(array_column($resultados, 'codigo_nikko')));
		$total_resultados = count($resultados);
		$offset = ($p - 1) * 50;
		$resultados = array_slice($resultados, $offset, 50);

		$productos = [];
		foreach ($resultados as $resultado) {
			array_push($productos, urlencode($resultado->codigo_nikko));
		}

		$url = 'https://sistemasowari.com:8443/catalowari/api/productos-existencias?' . http_build_query(["productos" => $productos]);
		//dd($url);
		/*$ch = curl_init();
			        curl_setopt($ch, CURLOPT_URL, $url);
			        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			        curl_setopt($ch, CURLOPT_HEADER, 0);
			        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			        $data = curl_exec($ch);
			        curl_close($ch);
			        $existencias = json_encode($data,true);
		*/
		$existencias = [];
		$botones = [];
		if ($total_resultados / 50 > 10) {
			if ($p >= 1 && $p <= 7) {
				$botones = ["1", "2", "3", "4", "5", "6", "7", '...', ceil($total_resultados / 50) - 2, ceil($total_resultados / 50) - 1, ceil($total_resultados / 50)];
			} else if (ceil($total_resultados / 50) - 2 <= $p) {
				$botones = ["1", "2", "3", '...', ceil($total_resultados / 50) - 6, ceil($total_resultados / 50) - 5, ceil($total_resultados / 50) - 4, ceil($total_resultados / 50) - 3, ceil($total_resultados / 50) - 2, ceil($total_resultados / 50) - 1, ceil($total_resultados / 50)];
			} else {
				$botones = ["1", "2", "3", '...', $p - 1, $p, $p + 1, '...', ceil($total_resultados / 50) - 2, ceil($total_resultados / 50) - 1, ceil($total_resultados / 50)];
			}
		} else {
			for ($i = 1; $i <= ceil($total_resultados / 50); $i++) {
				$botones[] = $i;
			}
		}

		$pagina = $p;
		$titulo = "Busqueda: " . ($q == "" ? "Todos" : $q) . " Pagina: " . $p;
		return view('web.productos', compact('resultados', 'total_resultados', 'botones', 'busqueda', 'pagina', 'peticion', 'titulo', 'existencias'));
	}

	public function detalleProducto($clave) {
		$clave = str_replace('_', '/', $clave);
		$clave = str_replace('+', '#', $clave);
		$titulo = "Producto: " . $clave;
		$producto = ProductoBusqueda::where('codigo_nikko', $clave)->first();
		if(!$producto){
			 return "El producto no existe";
		}
		$especificaciones = ProductoBusqueda::where('codigo_nikko', $clave)->orderBy('armadora','asc')->orderBy('modelo','ASC')->get();
		$relacionados = ProductoBusqueda::where('modelo', $producto->modelo)->get()->toArray();
		$relacionados = array_intersect_key($relacionados, array_unique(array_column($relacionados, 'codigo_nikko')));
		$relacionados = array_slice($relacionados, 0, 8);

		$especificaciones_extra = [];
		if ($producto->extra_clave_1 != "") {
			$aux = ProductoBusqueda::where('codigo_nikko', $producto->extra_clave_1)->get();
			$especificaciones_extra = $aux;
		}
		if ($producto->extra_clave_2 != "") {
			$aux = ProductoBusqueda::where('codigo_nikko', $producto->extra_clave_2)->get();
			if ($especificaciones_extra) {
				$especificaciones_extra = $aux->merge($especificaciones_extra);
			} else {
				$especificaciones_extra = $aux;
			}

		}
		if ($producto->extra_clave_3 != "") {
			$aux = ProductoBusqueda::where('codigo_nikko', $producto->extra_clave_3)->get();
			if ($especificaciones_extra) {
				$especificaciones_extra = $aux->merge($especificaciones_extra);
			} else {
				$especificaciones_extra = $aux;
			}

		}

		return view('web.ver_producto', compact('producto', 'especificaciones', 'relacionados', 'titulo', 'especificaciones_extra'));
	}

	public function contacto() {
		$titulo = "Contacto";
		return view('web.contacto', compact('titulo'));
	}

	private function categorias() {

		$grupos = ProductoBusqueda::select('grupo')->distinct()->orderBy('grupo', 'asc')->get();
		$slider = [];

		foreach ($grupos as $grupo) {
			$slider[$grupo->grupo] = [];

			$subgrupos = ProductoBusqueda::select('subgrupo')->where('grupo', $grupo->grupo)->distinct()->orderBy('subgrupo', 'asc')->get();
			foreach ($subgrupos as $subgrupo) {
				$slider[$grupo->grupo][] = $subgrupo->subgrupo;
			}
		}

		return $slider;

	}

	private function resultadosCategoria($query) {

		$grupos = ProductoBusqueda::select('grupo')->distinct()->get();
		$slider = [];

		foreach ($grupos as $grupo) {
			$slider[$grupo->grupo] = [];

			$subgrupos = ProductoBusqueda::select('subgrupo')->where('grupo', $grupo->grupo)->distinct()->get();
			foreach ($subgrupos as $subgrupo) {
				$slider[$grupo->grupo][] = $subgrupo->subgrupo;
			}
		}

		return $slider;

	}

	private function query($tipo_query, $string) {

		switch ($tipo_query) {
		case 'categoria':
			$query = "SELECT
                            marca_comercial,
                            codigo_nikko,
                            grupo,
                            subgrupo,
                            descripcion_1,
                            descripcion_2,
                            descripcion_3,
                            caracteristicas_1,
                            caracteristicas_2,
                            caracteristicas_3,
                            caracteristicas_4,
                            equivalencia_1,
                            equivalencia_2,
                            equivalencia_3,
                            equivalencia_4,
                            equivalencia_5,
                            buscador,
                            precio_normal,
                            precio_final,
                            existencias,
                            minimo_compra_oferta
                        FROM
                            productos_busqueda
                        WHERE
                            subgrupo = '" . str_replace("_", " ", $string) . "'
                            AND deleted_at is null
					   ORDER BY ventas desc
                            LIMIT 0,1000000000";
			break;

		case 'autocompletar':
			$query = "SELECT
                            marca_comercial,
                            codigo_nikko,
                            grupo,
                            subgrupo,
                            descripcion_1,
                            descripcion_2,
                            descripcion_3,
                            caracteristicas_1,
                            caracteristicas_2,
                            caracteristicas_3,
                            caracteristicas_4,
                            equivalencia_1,
                            equivalencia_2,
                            equivalencia_3,
                            equivalencia_4,
                            equivalencia_5,
                            buscador,
                            precio_normal,
                            precio_final,
                            existencias,
                            minimo_compra_oferta
                        FROM
                            productos_busqueda
                        WHERE
                            invocacion LIKE '%" . $string . "%'
                            AND deleted_at is null
					   ORDER BY ventas desc
                            LIMIT 0,1000000000";
			break;

		case 'filtro':
			$extra = "";
			if ($q['ano'] != "0" && $q['ano'] != "todos") {
				$extra .= " AND anos LIKE '%" . $q['ano'] . "%' ";
			}

			if ($q['marca'] != "0" && $q['marca'] != "todos") {
				$extra .= " AND armadora = '" . $q['marca'] . "' ";
			}

			if ($q['modelo'] != "0" && $q['modelo'] != "todos") {
				$extra .= " AND modelo = '" . $q['modelo'] . "' ";
			}

			if ($q['modelo'] != "0" && $q['motor'] != "todos") {
				$extra .= " AND motor = '" . $q['motor'] . "' ";
			}

			if ($q['grupo'] != "0" && $q['grupo'] != "todos") {
				$extra .= " AND grupo = '" . $q['grupo'] . "' ";
			}

			if ($q['familia'] != "0" && $q['familia'] != "todos") {
				$extra .= " AND subgrupo = '" . $q['familia'] . "' ";
			}

			$query = "SELECT
                        DISTINCT (codigo_nikko),
                        marca_comercial,
                        grupo,
                        subgrupo,
                        descripcion_1,
                        descripcion_2,
                        descripcion_3,
                        caracteristicas_1,
                        caracteristicas_2,
                        caracteristicas_3,
                        caracteristicas_4,
                        equivalencia_1,
                        equivalencia_2,
                        equivalencia_3,
                        equivalencia_4,
                        equivalencia_5,
                        pagina_principal,
                        precio_normal,
                        precio_final,
                        existencias,
                        minimo_compra_oferta
                    FROM
                        productos_busqueda
                    WHERE deleted_at is null
                    " . $extra . "
                    ORDER BY ventas DESC";

		case 'palabra':
			$query = "SELECT
                            marca_comercial,
                            codigo_nikko,
                            grupo,
                            subgrupo,
                            descripcion_1,
                            descripcion_2,
                            descripcion_3,
                            caracteristicas_1,
                            caracteristicas_2,
                            caracteristicas_3,
                            caracteristicas_4,
                            equivalencia_1,
                            equivalencia_2,
                            equivalencia_3,
                            equivalencia_4,
                            equivalencia_5,
                            buscador,
                            precio_normal,
                            precio_final,
                            existencias,
                            minimo_compra_oferta,
                            extra_clave_1,
                            extra_clave_2,
                            extra_clave_3,
					   especial,
					   disponibilidad
                        FROM
                            productos_busqueda
                        WHERE
                            buscador LIKE '%" . $string . "%' or codigo_nikko = '".$string."' or codigosinguiones = '".$string."'
                            AND deleted_at is null order by ventas desc";
			break;
		case 'nuevo':
			$query = "SELECT
			marca_comercial,
			codigo_nikko,
			grupo,
			subgrupo,
			descripcion_1,
			descripcion_2,
			descripcion_3,
			caracteristicas_1,
			caracteristicas_2,
			caracteristicas_3,
			caracteristicas_4,
			equivalencia_1,
			equivalencia_2,
			equivalencia_3,
			equivalencia_4,
			equivalencia_5,
			buscador,
			precio_normal,
			precio_final,
			existencias,
			minimo_compra_oferta,
			extra_clave_1,
			extra_clave_2,
			extra_clave_3,
			especial
			FROM
			productos_busqueda
			WHERE
			lo_mas_nuevo != ''
			AND deleted_at is null order by ventas desc";
			break;
		case 'todos':
			$query = "SELECT
                                marca_comercial,
                                codigo_nikko,
                                grupo,
                                subgrupo,
                                descripcion_1,
                                descripcion_2,
                                descripcion_3,
                                caracteristicas_1,
                                caracteristicas_2,
                                caracteristicas_3,
                                caracteristicas_4,
                                equivalencia_1,
                                equivalencia_2,
                                equivalencia_3,
                                equivalencia_4,
                                equivalencia_5,
                                buscador,
                                precio_normal,
                                precio_final,
                                existencias,
                                minimo_compra_oferta,
						  especial
                            FROM
                                productos_busqueda
                            WHERE deleted_at is null
                            ORDER BY ventas desc, descripcion_1 asc, especial asc";
			break;
		case 'palabras':

				$palabras = explode(" ", $string);
				$buscar = "";
				foreach ($palabras as $key => $value) {
					// code..
					$buscar.="+".$value."*";
				}

			$query = "SELECT
                    marca_comercial,
                    codigo_nikko,
                    grupo,
                    subgrupo,
                    descripcion_1,
                    descripcion_2,
                    descripcion_3,
                    caracteristicas_1,
                    caracteristicas_2,
                    caracteristicas_3,
                    caracteristicas_4,
                    equivalencia_1,
                    equivalencia_2,
                    equivalencia_3,
                    equivalencia_4,
                    equivalencia_5,
                    precio_normal,
                    precio_final,
                    existencias,
                    minimo_compra_oferta,
                    buscador,
                    extra_clave_1,
                    extra_clave_2,
                    extra_clave_3,
				especial,
                    MATCH (buscador) AGAINST ('".trim($buscar)."' IN BOOLEAN MODE) AS score
                FROM
                    productos_busqueda
                WHERE
                    MATCH (buscador) AGAINST ('".trim($buscar)."' IN BOOLEAN MODE) 
                    AND deleted_at is null
                ORDER BY score desc, ventas desc";
			break;
			case 'palabras_pedidos':
			$query = "SELECT
                    marca_comercial,
                    codigo_nikko,
                    grupo,
                    subgrupo,
                    descripcion_1,
                    descripcion_2,
                    descripcion_3,
                    caracteristicas_1,
                    caracteristicas_2,
                    caracteristicas_3,
                    caracteristicas_4,
                    equivalencia_1,
                    equivalencia_2,
                    equivalencia_3,
                    equivalencia_4,
                    equivalencia_5,
                    precio_normal,
                    precio_final,
                    existencias,
                    minimo_compra_oferta,
                    buscador,
                    extra_clave_1,
                    extra_clave_2,
                    extra_clave_3,
				especial,
				disponibilidad
                FROM
                    productos_busqueda
                WHERE
                    buscador like '%" . str_replace(" ", "%", trim($string)) . "%'
                    AND deleted_at is null order by ventas desc";
			break;
		}
		return $query;
	}

	public function autocompletar(Request $request) {
		extract($request->all());
		$consulta = "SELECT texto as value, texto as data FROM autocompletar WHERE MATCH ( texto ) AGAINST ( '" . $query . "') LIMIT 15";
		$resultados = \DB::select($consulta);
		return json_encode(["query" => $query, "suggestions" => $resultados]);
	}

	public function autenticarse() {
		return view('web.sign');
	}

	public function filtrosCatalogos() {
		$lineas_distintas = ProductoBusqueda::select('grupo as grupo')->distinct()->orderby('grupo', 'asc')->get();
		$lineas = [];
		foreach ($lineas_distintas as $linea) {
			if ($linea->grupo == "" || $linea->grupo == NULL || $linea->grupo == "NULL") {
				$lineas["NULL"] = "SIN GRUPO";
			} else {
				$lineas[$linea->grupo] = $linea->grupo;
			}

		}

		$subgrupos_distintas = ProductoBusqueda::select('subgrupo as subgrupo')->distinct()->orderby('subgrupo', 'asc')->get();
		$subgrupos = [];
		foreach ($subgrupos_distintas as $linea) {
			if ($linea->subgrupo == "" || $linea->subgrupo == NULL || $linea->subgrupo == "NULL") {
				$subgrupos["NULL"] = "SIN SUBGRUPO";
			} else {
				$subgrupos[$linea->subgrupo] = $linea->subgrupo;
			}

		}

		$marcas_distintas = ProductoBusqueda::select('marca_comercial')->distinct()->orderby('marca_comercial', 'asc')->get();
		$marcas = [];
		foreach ($marcas_distintas as $marca) {
			if ($marca->marca_comercial == "" || $marca->marca_comercial == NULL || $marca->marca_comercial == "NULL") {
				$marcas["NULL"] = "SIN MARCA";
			} else {
				$marcas[$marca->marca_comercial] = $marca->marca_comercial;
			}

		}

		$modelos_distintos = ProductoBusqueda::select('armadora')->distinct()->orderby('armadora', 'asc')->get();
		$modelos = [];
		foreach ($modelos_distintos as $modelo) {
			if ($modelo->armadora == "" || $modelo->armadora == NULL || $modelo->armadora == "NULL") {
				$modelos["NULL"] = "NO APLICA";
			} else {
				$modelos[$modelo->armadora] = $modelo->armadora;
			}

		}
		$titulo = "Generador de catalogos";

		return view('web.filtros_catalogos', compact('lineas', 'marcas', 'modelos', 'titulo', 'subgrupos'));
	}

	public function generaCatalogo(Request $request) {
		extract($request->all());
		//\DB::enableQueryLog();

		$productos = ProductoBusqueda::select('*');

		if ($request->has('precio')) {
			$porcentaje = 0;
			$productos = ProductoBusqueda::select(\DB::raw('*, (precio_normal * ' . number_format(1 + ($porcentaje / 100), 2, '.', '') . ') as precio'));
		}

		if (isset($marca)) {
			$productos->whereIn('marca_comercial', $marca);
		}

		if (isset($modelo)) {
			$productos->whereIn('armadora', $modelo);
		}

		if (isset($linea)) {
			$productos->whereIn('grupo', $linea);
		}

		if (isset($subgrupo)) {
			$productos->whereIn('subgrupo', $subgrupo);
		}

		if (!empty($descripcion)) {
			$productos->where('descripcion_1', 'like', '%' . $descripcion . '%');
		}

		$empezar_pagina = 1;

		$productos = $productos->orderBy($orden, 'asc')->distinct('codigo_nikko')->get();

		//print_r(\DB::getQueryLog());
		$opciones = [];

		$opciones['equivalencias'] = 1;
		$opciones['mostrar_pie'] = 1;

		//dd($productos[0]);
		return view('web.catalogo_html', compact('productos', 'empezar_pagina', 'opciones', 'numero_filas'));
	}

	public function generar() {
		$claves = [
			'1003002IT',
'1003003IT',
'1003008IT',
'1003012IT',
'1003015IT',
'1003016IT',
'1003018IT',
'1003020IT',
'1003022IT',
'1003025IT',
'1003026IT',
'1005003IT',
'1005004IT',
'1006004IT',
'1006006IT',
'1006013IT',
'1006019IT',
'1006022IT',
'1006026IT',
'1006030IT',
'1008001IT',
'1008002IT',
'1008003IT',
'1008008IT',
'1008018IT',
'1008022IT',
'1008023IT',
'1008024IT',
'1008025IT',
'1008026IT',
'1008027IT',
'1008031IT',
'1008032IT',
'1008033IT',
'1008034IT',
'1008035IT',
'1008038IT',
'1009001IT',
'1009004IT',
'1009005IT',
'1009006IT',
'1009007IT',
'1009009IT',
'1009013IT',
'1009018IT',
'1011857IT',
'1011858IT',
'1013001IT',
'1015001IT',
'1015002IT',
'1015005IT',
'1016003IT',
'1016007IT',
'1016008IT',
'1016009IT',
'1016010IT',
'1016011IT',
'1016014IT',
'1019003IT',
'1019005IT',
'1025001IT',
'1025002IT',
'1025003IT',
'1025005IT',
'1025006IT',
'1025007IT',
'1025010IT',
'1025011IT',
'1025012IT',
'1025013IT',
'1025014IT',
'1025015IT',
'1025016IT',
'1025021IT',
'1025022IT',
'1025023IT',
'1025024IT',
'1025025IT',
'1025026IT',
'1025029IT',
'1026003IT',
'1026004IT',
'1026008IT',
'1026009IT',
'1034417IT',
'104217IT',
'1044014IT',
'1103001IT',
'1103002IT',
'1103009IT',
'1103014IT',
'1103018IT',
'1103022IT',
'1103023IT',
'1103026IT',
'1103027IT',
'1103028IT',
'1103031IT',
'1103033IT',
'1103034IT',
'1103036IT',
'1103038IT',
'1103041IT',
'1103042IT',
'1103043IT',
'1105006IT',
'1105007IT',
'1106004IT',
'1106005IT',
'1106009IT',
'1106010IT',
'1106021IT',
'1106022IT',
'1106023IT',
'1106029IT',
'1106030IT',
'1106047IT',
'1108003IT',
'1108010IT',
'1108011IT',
'1108012IT',
'1108013IT',
'1108014IT',
'1108016IT',
'1108017IT',
'1108018IT',
'1108019IT',
'1108023IT',
'1108024IT',
'1108025IT',
'1108026IT',
'1108027IT',
'1108028IT',
'1108029IT',
'1108030IT',
'1108031IT',
'1108038IT',
'1108039IT',
'1108040IT',
'1109001IT',
'1109009IT',
'1109010IT',
'1109011IT',
'1109028IT',
'1109029IT',
'1109032IT',
'1109033IT',
'1109034IT',
'1109039IT',
'1109040IT',
'1109041IT',
'1109044IT',
'1113001IT',
'1113002IT',
'1113015IT',
'1113016IT',
'1115002IT',
'1115003IT',
'1116001IT',
'1116003IT',
'1116005IT',
'1116006IT',
'1116010IT',
'1116011IT',
'1116012IT',
'1116013IT',
'1116014IT',
'1116015IT',
'1116017IT',
'1116018IT',
'1116019IT',
'1116020IT',
'1116024IT',
'1116025IT',
'1116026IT',
'1116027IT',
'1116028IT',
'1116029IT',
'1116032IT',
'1116033IT',
'1119003IT',
'1119004IT',
'1125001IT',
'1125002IT',
'1125008IT',
'1125009IT',
'1125010IT',
'1125012IT',
'1125013IT',
'1125014IT',
'1125015IT',
'1125016IT',
'1125022IT',
'1125023IT',
'1125024IT',
'1125025IT',
'1125026IT',
'1125027IT',
'1125032IT',
'1125033IT',
'1125035IT',
'1125036IT',
'1125041IT',
'1126004IT',
'1126005IT',
'1126010IT',
'1126011IT',
'1126019IT',
'1126020IT',
'1202548IT',
'1202549IT',
'1216003IT',
'12475475-LIT',
'12475476-RIT',
'12475485IT',
'12543949-LIT',
'12543950-RIT',
'1303001IT',
'1303002IT',
'1303003IT',
'1303004IT',
'1303005IT',
'1303009IT',
'1303010IT',
'1303017IT',
'1303021IT',
'1303025IT',
'1303027IT',
'1303032IT',
'1303033IT',
'1303034IT',
'1303036IT',
'1303037IT',
'1303039IT',
'1303042IT',
'1303043IT',
'1303044IT',
'1305004IT',
'1306003IT',
'1306008IT',
'1306011IT',
'1306019IT',
'1306029IT',
'1306030IT',
'1307001IT',
'1308002IT',
'1308004IT',
'1308010IT',
'1308011IT',
'1308012IT',
'1308013IT',
'1308016IT',
'1308019IT',
'1308021IT',
'1308022IT',
'1308023IT',
'1308024IT',
'1308026IT',
'1309004IT',
'1309008IT',
'1309009IT',
'1309012IT',
'1309018IT',
'1309021IT',
'1309023IT',
'1309027IT',
'1309029IT',
'1309030IT',
'1309031IT',
'131-405-361-FIT',
'131-405-371-GIT',
'131-415-801-EIT',
'131-415-813-EIT',
'1313001IT',
'1313009IT',
'1315003IT',
'1315007IT',
'1315009IT',
'1316001IT',
'1316002IT',
'1316003IT',
'1316011IT',
'1316012IT',
'1316013IT',
'1316014IT',
'1316015IT',
'1316016IT',
'1316020IT',
'1316023IT',
'1316024IT',
'1316027IT',
'1316028IT',
'1319005IT',
'1325001IT',
'1325002IT',
'1325007IT',
'1325011IT',
'1325012IT',
'1325013IT',
'1325016IT',
'1325017IT',
'1325022IT',
'1325024IT',
'1325026IT',
'1326001IT',
'1326003IT',
'1326007IT',
'1326009IT',
'15018807-LIT',
'15018808-RIT',
'1503001IT',
'1503010IT',
'1503011IT',
'1503014IT',
'1503015IT',
'1503022IT',
'1503023IT',
'1503051IT',
'1503052IT',
'1503059IT',
'1503060IT',
'1503061IT',
'1503064IT',
'1503065IT',
'1503068IT',
'1503075IT',
'1503076IT',
'1503082IT',
'1503083IT',
'1503092IT',
'1503099IT',
'1503100IT',
'1503107IT',
'1503108IT',
'15047209-LIT',
'15047210-RIT',
'15049881-RLIT',
'1506006IT',
'1506007IT',
'1506024IT',
'1506025IT',
'1506031IT',
'1506046IT',
'1506047IT',
'1506055IT',
'1506056IT',
'1506070IT',
'1506071IT',
'1506072IT',
'1506079IT',
'1506080IT',
'1506105IT',
'1506106IT',
'1506112IT',
'1506113IT',
'1506120IT',
'1506124IT',
'1506135IT',
'1508003IT',
'1508004IT',
'1508005IT',
'1508006IT',
'1508007IT',
'1508008IT',
'1508011IT',
'1508012IT',
'1508028IT',
'1508029IT',
'1508032IT',
'1508033IT',
'1508044IT',
'1508045IT',
'1508046IT',
'1508047IT',
'1508061IT',
'1508077IT',
'1508078IT',
'1508106IT',
'1508107IT',
'1509003IT',
'1509004IT',
'1509008IT',
'1509009IT',
'1509012IT',
'1509013IT',
'1509015IT',
'1509016IT',
'1509017IT',
'1509018IT',
'1509025IT',
'1509026IT',
'1509044IT',
'1509045IT',
'1509066IT',
'1509069IT',
'1509070IT',
'1509076IT',
'1509077IT',
'1509078IT',
'1509081IT',
'1513026IT',
'1513027IT',
'1513030IT',
'1515005IT',
'1515006IT',
'1516009IT',
'1516010IT',
'1516015IT',
'1516016IT',
'1516019IT',
'1516020IT',
'1516021IT',
'1516022IT',
'1516023IT',
'1516024IT',
'1516025IT',
'1516026IT',
'1516027IT',
'1516028IT',
'1516029IT',
'1516030IT',
'1516037IT',
'1516041IT',
'1516047IT',
'1516048IT',
'1516049IT',
'1516050IT',
'1516054IT',
'1516055IT',
'1516056IT',
'1516057IT',
'1516060IT',
'1516061IT',
'1516070IT',
'1516071IT',
'1519009IT',
'1519010IT',
'1525005IT',
'1525006IT',
'1525007IT',
'1525020IT',
'1525021IT',
'1525024IT',
'1525025IT',
'1525026IT',
'1525027IT',
'1525028IT',
'1525029IT',
'1525038IT',
'1525039IT',
'1525040IT',
'1525041IT',
'1525042IT',
'1525043IT',
'1525044IT',
'1525045IT',
'1525046IT',
'1525047IT',
'1525056IT',
'1525057IT',
'1525058IT',
'1525059IT',
'1525064IT',
'1525067IT',
'1525068IT',
'1525075IT',
'1525076IT',
'1526001IT',
'1526002IT',
'1526003IT',
'1526030IT',
'1526031IT',
'1526033IT',
'1526034IT',
'1526037IT',
'1526038IT',
'1526039IT',
'1526049IT',
'1526050IT',
'1526060IT',
'1526061IT',
'15604017-LIT',
'15604018-RIT',
'1603002IT',
'1603004IT',
'1603005IT',
'1603008IT',
'1603009IT',
'1603010IT',
'1603011IT',
'1603213IT',
'1603214IT',
'1703002IT',
'1706002IT',
'1716001IT',
'188008IT',
'189008IT',
'191-407-153-AIT',
'191-407-153-CIT',
'191-419-811IT',
'191-419-812IT',
'1F2Z-3078-AAIT',
'1F2Z-3079-AAIT',
'1H0-407-151-CIT',
'1H0-407-151IT',
'1H0-407-365IT',
'1H0-411-315IT',
'1J0-407-151IT',
'1J0-407-365-CIT',
'1J0-407-366-CIT',
'1J0-411-315-CIT',
'1J0-422-811IT',
'1J0-422-812IT',
'1L2Z-3084-RIT',
'1L2Z-3085-LIT',
'2103001IT',
'2103002IT',
'2103005IT',
'2103019IT',
'2103020IT',
'2103023IT',
'2103027IT',
'2103032IT',
'2103033IT',
'2103038IT',
'2103040IT',
'2103044IT',
'2103046IT',
'2103059IT',
'2106001IT',
'2106002IT',
'2106006IT',
'2106007IT',
'2106009IT',
'2106010IT',
'2106011IT',
'2106015IT',
'2106016IT',
'2106021IT',
'2106022IT',
'2106023IT',
'2106025IT',
'2106029IT',
'2106032IT',
'2106033IT',
'2106046IT',
'2106047IT',
'2106048IT',
'2106057IT',
'2108001IT',
'2108002IT',
'2108004IT',
'2108015IT',
'2108018IT',
'2108019IT',
'2108025IT',
'2108026IT',
'2108027IT',
'2108028IT',
'2108029IT',
'2108033IT',
'2108045IT',
'2108051IT',
'2108055IT',
'2108056IT',
'2108057IT',
'2108058IT',
'2108059IT',
'2108060IT',
'2108061IT',
'2108062IT',
'2108063IT',
'2108066IT',
'2108068IT',
'2108079IT',
'2109001IT',
'2109006IT',
'2109007IT',
'2109010IT',
'2109011IT',
'2109021IT',
'2109022IT',
'2109023IT',
'2109024IT',
'2109025IT',
'2109028IT',
'2109029IT',
'2109033IT',
'2109037IT',
'2109040IT',
'2109041IT',
'2109054IT',
'2109055IT',
'2109056IT',
'2109057IT',
'211-405-371-AIT',
'2113001IT',
'2113002IT',
'2113016IT',
'2115003IT',
'2115004IT',
'2115013IT',
'2115018IT',
'2116001IT',
'2116003IT',
'2116009IT',
'2116010IT',
'2116011IT',
'2116014IT',
'2116015IT',
'2116016IT',
'2116017IT',
'2116018IT',
'2116019IT',
'2116020IT',
'2116027IT',
'2116029IT',
'2116033IT',
'2116034IT',
'2116035IT',
'2116036IT',
'2116037IT',
'2116038IT',
'2116039IT',
'2116040IT',
'2116041IT',
'2116042IT',
'2116043IT',
'2116044IT',
'2116045IT',
'2116046IT',
'2116047IT',
'2116048IT',
'2116053IT',
'2116054IT',
'2116055IT',
'2116056IT',
'2117001IT',
'2119003IT',
'2125002IT',
'2125003IT',
'2125004IT',
'2125005IT',
'2125008IT',
'2125009IT',
'2125014IT',
'2125017IT',
'2125020IT',
'2125021IT',
'2125022IT',
'2125027IT',
'2125029IT',
'2125030IT',
'2125031IT',
'2126001IT',
'2126002IT',
'2126004IT',
'2126005IT',
'2126010IT',
'2126011IT',
'22602164-RIT',
'22602165-LIT',
'2510001IT',
'2510002IT',
'2510003IT',
'2510004IT',
'26027087IT',
'26027095IT',
'2608002IT',
'2612475IT',
'2612754IT',
'2612755IT',
'2612756IT',
'2615047IT',
'2615936IT',
'305-407-155IT',
'311-415-811-CIT',
'311-415-812-CIT',
'322158IT',
'324026IT',
'3492214IT',
'352041IT',
'352042IT',
'3520G8-LIT',
'352181-CIT',
'352181-S/RIT',
'352182-CIT',
'352182-S/RIT',
'3521G8-RIT',
'352800IT',
'352803IT',
'357-407-365-AIT',
'377-407-365-BIT',
'377-407-365-CIT',
'377-407-366-BIT',
'377-419-801-LIT',
'377-419-802-HIT',
'377-419-802-RIT',
'377-419-811IT',
'377-422-801IT',
'377-422-802IT',
'377-422-811IT',
'381741IT',
'381742IT',
'3L8Z-3078-RIT',
'3L8Z-3079-LIT',
'40110-B9500IT',
'40160-01A25IT',
'40160-50A00IT',
'40160-B9500IT',
'40160-F4200IT',
'40161-B9500IT',
'40371150IT',
'4342539IT',
'4616922-RIT',
'4616923-LIT',
'4695626IT',
'48502-01G25IT',
'48502-01G26IT',
'48502-F4000IT',
'48510-4B000IT',
'48520-01G25IT',
'48520-01W00IT',
'48520-A03G0IT',
'48520-D0125IT',
'48521-01G25IT',
'48521-01W00IT',
'48521-09E00IT',
'48521-4B000IT',
'48521-70A00IT',
'48521-A05G0IT',
'48521-Y02G0IT',
'48530-01G25IT',
'48530-3S125IT',
'48560-01G25IT',
'48560-03W00IT',
'48560-3S125IT',
'48560-3S525IT',
'48560-F4000IT',
'48605-35120IT',
'48606-35120IT',
'4D0-422-821IT',
'4J0-422-803-BIT',
'4J0-422-804-BIT',
'4J0-422-811IT',
'4J0-422-812IT',
'4J0-422-821IT',
'5015114IT',
'5015115IT',
'51350-S5A-030-RIT',
'51360-S5A-030-LIT',
'51370-S04-G00-LIT',
'51380-S04-G00-RIT',
'51450-S04-023-RIT',
'51460-S04-023-LIT',
'52030638IT',
'52035775IT',
'52037201-LIT',
'52037500IT',
'52037501IT',
'52037530IT',
'52037570-RIT',
'52037571-LIT',
'52037626IT',
'52037628IT',
'52037630IT',
'52037670IT',
'52037675IT',
'52037679IT',
'52037712IT',
'52037915IT',
'52038200-RIT',
'52038461IT',
'52038463IT',
'52038472IT',
'52038587IT',
'52038714-RLIT',
'52038860IT',
'52088632-RLIT',
'52106463IT',
'52106975IT',
'5272076-RIT',
'5272077-LIT',
'5272236ACIT',
'5272237ACIT',
'5352011-S/RIT',
'5352012-S/RIT',
'5352016-LIT',
'5352017-RIT',
'54216-52G00IT',
'54500-52Y10IT',
'54500-5M000IT',
'54500-7Y000IT',
'54500-8H310IT',
'54500-F4300IT',
'54500-VW000IT',
'54501-01G90IT',
'54501-52Y10IT',
'54501-5M000IT',
'54501-7Y000IT',
'54501-8H310IT',
'54501-F4300IT',
'54501-VW000IT',
'54502-01G90IT',
'54524-8B550IT',
'54524-VW100IT',
'54525-8B550IT',
'54525-VW100IT',
'54526-92G00IT',
'54527-92G00IT',
'54618-0Z800IT',
'54618-58Y10IT',
'55120-50C00IT',
'6K0-422-821-EIT',
'6K0-422-821IT',
'6Q0-407-365-AIT',
'6Q0-407-366-AIT',
'6Q0-422-803-BIT',
'6Q0-422-804-BIT',
'6Q0-422-811IT',
'6Q0-422-812IT',
'6Q0-422-821IT',
'6Q0-423-810-CIT',
'758-4016001G50IT',
'758-4016050Y00IT',
'758-40160VW000IT',
'758-4852050A00IT',
'758-D1116002IT',
'758-KCHVIT',
'7700-425-227IT',
'7700-425-228IT',
'7701-047-415IT',
'7701-047-416IT',
'7701-468-411IT',
'7701-472-113IT',
'7701-472-734IT',
'811-419-812-AIT',
'93BB-3B-438CAIT',
'94FB-3395-BAIT',
'98FB-3042-BGIT',
'98FB-3042-CDIT',
'98FB-3051-BGIT',
'98FB-3051-CDIT',
'99FB-3042IT',
'99FB-3051IT',
'DS-1059IT',
'DS-1060IT',
'DS-1159IT',
'DS-1161IT',
'DS-1177IT',
'DS-1239-SIT',
'DS-1425IT',
'DS-1434IT',
'DS-1451IT',
'DS-796IT',
'DS-927IT',
'DS-928IT',
'E7TZ-5K-483-C-RIT',
'E7TZ-5K-483-D-LIT',
'ES-2012-SIT',
'ES-2033-RLIT',
'ES-2034-RLIT',
'ES-2054-RLIT',
'ES-2077-RIT',
'ES-2078-LIT',
'ES-2079-SIT',
'ES-2080-SIT',
'ES-2144-RIT',
'ES-2194-RIT',
'ES-2197-RIT',
'ES-2199-RIT',
'ES-2347-RLIT',
'ES-2369-SIT',
'ES-2374IT',
'ES-2376IT',
'ES-2382IT',
'ES-2396-RIT',
'ES-2836-RLIT',
'ES-2837-RLIT',
'ES-2838-RLIT',
'ES-2900-SIT',
'ES-2953IT',
'ES-2954IT',
'ES-3002-RIT',
'ES-3003-RLIT',
'ES-3051-LIT',
'ES-3090-SIT',
'ES-3094-LIT',
'ES-3095-RIT',
'ES-3096-LIT',
'ES-3122-RIT',
'ES-3123-LIT',
'ES-3156-RLIT',
'ES-3173IT',
'ES-3181-RIT',
'ES-3192IT',
'ES-3302-RLIT',
'ES-3306IT',
'ES-3331-RIT',
'ES-3332-RIT',
'ES-3349-RLIT',
'ES-3358-RIT',
'ES-3359-RIT',
'ES-3364-RIT',
'ES-3365-LIT',
'ES-3366-LIT',
'ES-3367-RIT',
'ES-3368-SIT',
'ES-3369IT',
'ES-3370IT',
'ES-3375IT',
'ES-3376IT',
'ES-3379IT',
'ES-3380-LIT',
'ES-3386-RLIT',
'ES-3387-RLIT',
'ES-3401-RLIT',
'ES-3417-RIT',
'ES-3418-LIT',
'ES-3420-SIT',
'ES-3422-SIT',
'ES-3423IT',
'ES-3426-SIT',
'ES-3427IT',
'ES-3440IT',
'ES-3455-RLIT',
'ES-3461IT',
'ES-3470IT',
'ES-3471IT',
'ES-3489IT',
'ES-3492IT',
'ES-3493IT',
'ES-3529-RLIT',
'ES-3531-RLIT',
'ES-3546IT',
'ES-3547IT',
'ES-3548IT',
'ES-409-LIT',
'ES-409-RIT',
'ES-413-RIT',
'EV-126IT',
'EV-128IT',
'EV-181IT',
'EV-201IT',
'EV-217IT',
'EV-299IT',
'EV-301IT',
'EV-302IT',
'EV-303IT',
'EV-315IT',
'EV-317IT',
'EV-319IT',
'EV-323IT',
'EV-348IT',
'EV-350IT',
'EV-362IT',
'EV-367IT',
'EV-370IT',
'EV-409IT',
'EV-433IT',
'EV-442IT',
'EV-CHVIT',
'F5TZ-3082-RIT',
'F75A-3590-ABIT',
'F85A-3A034-AAIT',
'F87Z-3084-RIT',
'F87Z-3085-LIT',
'K-3134IT',
'K-3137IT',
'K-5208IT',
'K-5289IT',
'K-5290IT',
'K-5331IT',
'K-6117IT',
'K-6129IT',
'K-6145IT',
'K-6292IT',
'K-6293IT',
'K-6335IT',
'K-6344IT',
'K-6528IT',
'K-6536IT',
'K-7053IT',
'K-7125IT',
'K-7185IT',
'K-7211IT',
'K-7213IT',
'K-7218IT',
'K-7242/AIT',
'K-7258IT',
'K-7275IT',
'K-80012IT',
'K-80014IT',
'K-8195IT',
'K-8388IT',
'K-8412IT',
'K-8413IT',
'K-8414IT',
'K-8431IT',
'K-8432IT',
'K-8433IT',
'K-8546IT',
'K-8607IT',
'K-8639IT',
'K-8663IT',
'K-8673IT',
'K-8679IT',
'K-8681IT',
'K-8695IT',
'K-8702IT',
'K-8708IT',
'K-8710IT',
'K-8722IT',
'K-8724IT',
'K-8726IT',
'K-8728IT',
'K-8738IT',
'K-8740IT',
'K-8747IT',
'K-8755IT',
'K-8772IT',
'K-8773IT',
'K-9009IT',
'K-9024IT',
'K-9042IT',
'K-9047IT',
'K-9102IT',
'K-9130IT',
'K-9296IT',
'K-9344IT',
'K-9347IT',
'K-9378IT',
'K-9422IT',
'K-9463IT',
'K-9465IT',
'K-9470IT',
'K-9482IT',
'K-9499IT',
'K-9507IT',
'K-9513IT',
'K-9519IT',
'K-9523IT',
'K-9525IT',
'K-9587IT',
'K-9643IT',
'K-9645IT',
'K-9647IT',
'K-9742IT',
'K-9754IT',
'K-9755IT',
'K-9802IT',
'YS4Z-3078-BAIT',
'YS4Z-3079-BAIT',
'YS4Z-3A-129-BAIT',
'YS4Z-3A-130-BAIT',
'YS4Z-EVIT',
'YS4Z-KIT'
		];

		foreach ($claves as $key => $value) {
			# code...
			if (substr($value, -2) !== 'IT') {
				echo "La cadena no termina en 'IT'\n";
				continue;
			}

			// Nombre sin 'IT'
			$nombreSinIT = substr($value, 0, -2);

			// Define rutas absolutas o relativas
			$origen = "/var/www/vhosts/owari.com.mx/laravel/cms/storage/app/public/productos/".$nombreSinIT;
			$destino =  "/var/www/vhosts/owari.com.mx/laravel/cms/storage/app/public/productos/".$value;

			if (!is_dir($origen)) {
				echo "No existe la carpeta de origen: $origen\n";
				continue;
			}

			if (!is_dir($destino)) {
				mkdir($destino, 0777, true); // Crea la carpeta destino
			}

			// Copia recursiva
			$iterator = new \RecursiveIteratorIterator(
				new \RecursiveDirectoryIterator($origen, \RecursiveDirectoryIterator::SKIP_DOTS),
				\RecursiveIteratorIterator::SELF_FIRST
			);

			foreach ($iterator as $item) {
				$destPath = $destino . DIRECTORY_SEPARATOR . $iterator->getSubPathName();

				if ($item->isDir()) {
					//mkdir($destPath, 0777, true);
				} else {
					copy($item, $destPath);
				}
			}

			echo "Contenido copiado de '$origen' a '$destino'\n";
		}



	}

	public function apiBusqueda(Request $request) {

		extract($request->all());
		if (stripos($q, ' ') !== false) {
			$query = $this->query('palabras_pedidos', $q);
		} else {
			$query = $this->query('palabra', $q);
		}

		$resultados = \DB::select($query);
		$resultados = array_intersect_key($resultados, array_unique(array_column($resultados, 'codigo_nikko')));
		$total_resultados = count($resultados);
		$p = 1;
		$offset = ($p - 1) * 250;
		$resultados = array_slice($resultados, $offset, 250);

		return json_encode($resultados);
	}

	public function apiSubgrupos(Request $request) {
		extract($request->all());
		$subgrupos = [];

		if (!isset($grupos)) {
			$subgrupos += ProductoBusqueda::select('subgrupo')->distinct()->orderBy('subgrupo', 'asc')->get()->toArray();
		} else {
			foreach ($grupos as $key => $value) {
				// code...
				$subgrupos += ProductoBusqueda::select('subgrupo')->where('grupo', $value)->groupBy('subgrupo')->orderBy('subgrupo', 'asc')->get()->toArray();
			}
		}

		return json_encode($subgrupos);

	}

	public function apiImagenes(Request $request) {
		extract($request->all());
		if (str_contains($codigo, '/')) {
			$codigo = str_replace("/", "_", $codigo);
		}

		$directory = storage_path() . '/app/public/productos/' . $codigo;
		if (file_exists($directory)) {
			$files = \Storage::allFiles('public/productos/' . $codigo . "/");
		} else {
			$files = [];
		}

		arsort($files);

		$imagenes = array();
		if (count($files) > 0) {
			foreach ($files as $key => $value) {
				array_push($imagenes, asset("storage/productos/" . $codigo . "/" . basename($files[$key], PHP_EOL)));
			}
		} else {
			array_push($imagenes, asset('img/sin-foto.jpg'));
		}

		return json_encode($imagenes);

	}
}
