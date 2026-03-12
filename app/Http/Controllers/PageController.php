<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\ProductoBusqueda;
use App\Models\Marca;
use App\Models\DatosGenerales;
use App\Models\Boletines;
use App\Models\Catalogos;
use App\Models\Publicaciones;
use App\Models\Informate;
use App\Models\SocioComercial;
use App\Models\BannerPrincipal;






class PageController extends Controller
{
    //
    public function index(){

    	//$marcas = scandir(public_path()."/upload/marcas");
        $banner_principal = BannerPrincipal::orderBy('ordenamiento','asc')->get();
        $marcas = Marca::orderBy('ordenamiento','asc')->get();
        $empresa = DatosGenerales::find(1);
        $nuevos = ProductoBusqueda::where('nuevo',TRUE)->get();
        $boletines = Boletines::orderBy('created_at','desxc')->limit(15)->get();
        $catalogos = Catalogos::limit(15)->get();
        return view('pagina.index',compact('marcas','banner_principal','empresa','nuevos','boletines','catalogos'));
    }

    public function catalogos(){
        $empresa = DatosGenerales::find(1);
        $catalogos = Catalogos::get();
       $promociones = ProductoBusqueda::where('promocion',TRUE)->get();
        return view('pagina.catalogos',compact('empresa','catalogos','promociones'));  
    }

    public function boletines(){
        $boletines = Boletines::orderBy('id','desc')->get();
        $anos = Boletines::select('ano')->where('ano','!=',"")->whereNotNull('ano')->distinct()->get();
        $marcas = Boletines::select('marca')->where('marca','!=',"")->whereNotNull('marca')->distinct()->get();
        $empresa = DatosGenerales::find(1);
        return view('pagina.boletines',compact('boletines','empresa','anos','marcas'));
    }

    public function empresa(){
        $empresa = DatosGenerales::find(1);
         $marcas = Marca::orderBy('ordenamiento','asc')->get();
    	return view('pagina.empresa',compact('empresa','marcas'));	
    }

    public function marcas(){
        $marcas = Marca::orderBy('ordenamiento','asc')->get();
        $empresa = DatosGenerales::find(1);
    	return view('pagina.marcas',compact('marcas','empresa'));
    }

    public function verMarca($id){
        $marca = Marca::find($id);
        $marcas = Marca::where('id','!=',$id)->orderBy('ordenamiento','asc')->get();
        $empresa = DatosGenerales::find(1);
        $catalogos = Catalogos::where('tags','LIKE','%'.$marca->nombre.'%')->limit(10)->get();
        $boletines = Boletines::where('tags','LIKE','%'.$marca->nombre.'%')->limit(10)->get();
        $productos = ProductoBusqueda::where('marca_comercial',$marca->nombre)->limit(30)->get();
        $informate = Informate::where('tags','LiKE','%'.$marca->nombre.'%')->where('evento','0')->limit(3)->get();
        return view('pagina.ver_marca',compact('marca','empresa','marcas','catalogos','boletines','productos','informate'));
    }

    public function productos(){
    	$empresa = DatosGenerales::find(1);
        return view('pagina.index',compact('empresa'));
    }

    public function promociones(){
        $empresa = DatosGenerales::find(1);
    	return view('pagina.promociones',compact('empresa'));
    }

    public function notinikko(){
        $empresa = DatosGenerales::find(1);
        return view('pagina.notinikko',compact('empresa'));
    }

    public function soporte(){
        $empresa = DatosGenerales::find(1);
        return view('pagina.soporte',compact('empresa'));
    }

    public function oportunidades(){
        $empresa = DatosGenerales::find(1);
        $entrada_principal = Informate::where('evento',0)->orderBy('id','desc')->first();
        $entradas = Informate::where('id','!=',$entrada_principal->id)->where('evento',0)->orderBy('id','desc')->limit(5)->get();
        $eventos = Informate::where('evento',1)->where('evento_fecha','>',date('Y-m-d'))->orderBy('id','asc')->get();

    	return view('pagina.oportunidades',compact('empresa','entrada_principal','entradas','eventos'));
    }

    public function contacto(){
        $empresa = DatosGenerales::find(1);
    	return view('pagina.contacto',compact('empresa'));
    }

    public function aviso(){
        $empresa = DatosGenerales::find(1);
        return view('pagina.aviso',compact('empresa'));
    }

    public function terminos(){
        $empresa = DatosGenerales::find(1);
        return view('pagina.terminos',compact('empresa'));
    }

    public function boletinTecnico(){
        $empresa = DatosGenerales::find(1);
        return view('pagina.boletin_tecnico',compact('empresa'));
    }

    public function videos(){
        $empresa = DatosGenerales::find(1);
        return view('pagina.videos',compact('empresa'));
    }

    public function buzon(){
        $empresa = DatosGenerales::find(1);
        return view('pagina.buzon',compact('empresa'));
    }

    public function documentos(){
        $empresa = DatosGenerales::find(1);
        $boletines = Boletines::get();
        $catalogos = Catalogos::get();
        $publicaciones = Publicaciones::get();
        return view('pagina.documentos',compact('empresa','boletines','publicaciones','catalogos'));
    }

    public function resultados(Request $request){
        
        $grupos = ProductoBusqueda::select('grupo')->distinct()->get();
        $slider= [];

        foreach($grupos as $grupo){
            $slider[$grupo->grupo] = [];

            $subgrupos = ProductoBusqueda::select('subgrupo')->where('grupo',$grupo->grupo)->distinct()->get();
            foreach($subgrupos as $subgrupo){
                $slider[$grupo->grupo][] = $subgrupo->subgrupo;
            }
        }


        $empresa = DatosGenerales::find(1);

        
        $_GET['query'] = trim($_GET['query']);

        extract($request->all());

        if(isset($_GET['ver_grupo'])){
            $query = "SELECT 
                            marca_comercial,
                            codigo_nikko,
                            grupo,
                            subgrupo,
                            descripcion_1,
                            descripcion_2,
                            descripcion_3,
                            buscador
                        FROM
                            productos_busqueda 
                        WHERE
                             subgrupo = '".str_replace("_"," ",$_GET['ver_grupo'])."'
                            LIMIT 0,1000000000";

        }
        else if(!isset($_GET['con_filtro']) && $_GET['query'] != ""){
            $extra = "";
            if(strpos($_GET['query'], ' ') > 0){
                if(isset($_GET['invocacion'])){
                        if($_GET['invocacion'] == 1)
                            $query = "SELECT 
                                    marca_comercial,
                                    codigo_nikko,
                                    grupo,
                                    subgrupo,
                                    descripcion_1,
                                    descripcion_2,
                                    descripcion_3,
                                    buscador
                                FROM
                                    productos_busqueda 
                                WHERE
                                    invocacion LIKE '%".$_GET['query']."%'
                                    LIMIT 0,1000000000";
                        else
                             $query = "SELECT 
                                marca_comercial,
                                codigo_nikko,
                                grupo,
                                subgrupo,
                                descripcion_1,
                                descripcion_2,
                                descripcion_3,
                                buscador,
                                MATCH ( buscador ) AGAINST ('+".str_replace(" ", "+",$_GET['query'])."' IN BOOLEAN MODE) as score
                            FROM
                                productos_busqueda 
                            WHERE
                                MATCH ( buscador ) AGAINST ( '+".str_replace(" ", "+",$_GET['query'])."' IN BOOLEAN MODE )
                                ORDER BY score DESC LIMIT 0,1000000000";
                }
                else
                    $query = "SELECT 
                            marca_comercial,
                            codigo_nikko,
                            grupo,
                            subgrupo,
                            descripcion_1,
                            descripcion_2,
                            descripcion_3,
                            buscador,
                            MATCH ( buscador ) AGAINST ('+".str_replace(" ", "+",$_GET['query'])."' IN BOOLEAN MODE) as score
                        FROM
                            productos_busqueda 
                        WHERE
                            MATCH ( buscador ) AGAINST ( '+".str_replace(" ", "+",$_GET['query'])."' IN BOOLEAN MODE )
                            ORDER BY score DESC LIMIT 0,1000000000";
            }
            else{
                $query = "SELECT 
                            marca_comercial,
                            codigo_nikko,
                            grupo,
                            subgrupo,
                            descripcion_1,
                            descripcion_2,
                            descripcion_3,
                            buscador
                        FROM
                            productos_busqueda 
                        WHERE
                            buscador LIKE '%".$_GET['query']."%'";
              

             }
        }
        else{

            $extra = "";
            if($request->input('ano') != "0" && $request->input('ano') != "todos")
                $extra.=" AND anos LIKE '%".$request->input('ano')."%' ";
            if($request->input('marca') != "0" && $request->input('marca') != "todos")
                $extra.=" AND armadora = '".$request->input('marca')."' ";
            if($request->input('modelo') != "0" && $request->input('modelo') != "todos")
                $extra.=" AND modelo = '".$request->input('modelo')."' ";
            if($request->input('motor') != "0" && $request->input('motor') != "todos")
                $extra.=" AND motor = '".$request->input('motor')."' ";
            if($request->input('grupo') != "0" && $request->input('grupo') != "todos")
                $extra.=" AND grupo = '".$request->input('grupo')."' ";
            if($request->input('familia') != "0" && $request->input('familia') != "todos")
                $extra.=" AND subgrupo = '".$request->input('familia')."' ";


            $query = "SELECT
                        DISTINCT (codigo_nikko),
                        marca_comercial,
                        grupo,
                        subgrupo,
                        descripcion_1,
                        descripcion_2,
                        descripcion_3,
                        pagina_principal 
                    FROM
                        productos_busqueda 
                    ".($extra != "" ? "WHERE" : "ORDER BY pagina_principal DESC, descripcion_1 ASC")." ".trim($extra," AND");
        }

       
        


        $resultados = \DB::select($query);
        $resultados = array_intersect_key($resultados, array_unique(array_column($resultados, 'codigo_nikko')));
        $total_resultados = count($resultados);
        $offset = ($_GET['pagina']-1)*51;
        $resultados = array_slice($resultados, $offset,51);


        $botones = [];
        if($total_resultados/51 > 10)
            if($_GET['pagina'] >= 1 && $_GET['pagina'] <= 7)
                $botones = ["1","2","3","4","5","6","7",'...',ceil($total_resultados/51)-2,ceil($total_resultados/51)-1,ceil($total_resultados/51)];
            else if(ceil($total_resultados/51)-2 <= $_GET['pagina'])
                $botones = ["1","2","3",'...',ceil($total_resultados/51)-6,ceil($total_resultados/51)-5,ceil($total_resultados/51)-4,ceil($total_resultados/51)-3,ceil($total_resultados/51)-2,ceil($total_resultados/51)-1,ceil($total_resultados/51)];
            else
                $botones = ["1","2","3",'...',$_GET['pagina']-1,$_GET['pagina'],$_GET['pagina']+1,'...',ceil($total_resultados/51)-2,ceil($total_resultados/51)-1,ceil($total_resultados/51)];

        else
            for ($i=1; $i <= ceil($total_resultados/51) ; $i++) { 
                $botones[] = $i;
            }


         //echo $query;
        return view('pagina.resultados',compact('empresa','resultados','total_resultados','botones','slider'));
    }


    public function buscador(Request $request){
        
        extract($request->all());
        $empresa = DatosGenerales::find(1);
        $la_armadora ="";
        $la_modelo ="";
        $la_grupo ="";
        $la_marca ="";
        if(isset($armadora))
           $la_armadora =$armadora;
        if(isset($modelo))
            $la_modelo =$modelo;
        if(isset($grupo))
            $la_grupo =$grupo;
        if(isset($marca))
            $la_marca =$marca;

       return view('pagina.buscador',compact('empresa','palabras','la_armadora','la_modelo','la_grupo','la_marca'));
	}
    
	public function DetallesProducto(Request $request){
        extract($request->all());
        $empresa = DatosGenerales::find(1);
        $producto = ProductoBusqueda::where('codigo_nikko',$clave)->first();
        $tabla = ProductoBusqueda::where('codigo_nikko',$clave)->get();
        $query = "SELECT
                        *,
                        MATCH ( buscador ) AGAINST ('+".str_replace(" ", "+",$producto->armadora." ".$producto->modelo)."' IN BOOLEAN MODE) as score
                    FROM
                        productos_busqueda 
                    WHERE
                        MATCH ( buscador ) AGAINST ( '+".str_replace(" ", "+",$producto->armadora." ".$producto->modelo)."' IN BOOLEAN MODE )
                        ORDER BY score DESC LIMIT 30";
        $resultados = \DB::select($query);
        return view('pagina.detalles_producto',compact('producto','empresa','producto','tabla','resultados'));
    }


    public function verEntrada($id){
        $empresa = DatosGenerales::find(1);
        $entrada = Informate::find($id);
        return view('pagina.entrada',compact('empresa','entrada'));
    }

    public function sociosComerciales(){
        $empresa = DatosGenerales::find(1);
        $tags_socios = SocioComercial::where('tags','like','%filtro:%')->get();
        $tags = [];
        foreach($tags_socios as $socio){
            $arreglo_tags = explode(",", $socio->tags);
            foreach($arreglo_tags as $key => $value){
                if(str_contains($value,"filtro:")){
                    $explotado = explode(":",$value);
                    array_push($tags,str_replace(" ","_",trim($explotado[1])));
                }
            }
        }

        $filtros = array_unique($tags);
        sort($filtros);
        $socios = SocioComercial::get();
        return view('pagina.socios_comerciales',compact('empresa','socios','filtros'));
    }

    public function filtros(Request $request){
        extract($request->all());
        //\DB::connection()->enableQueryLog();
        $ano_min = ProductoBusqueda::whereRaw("ano_inicial REGEXP '^-?[0-9]+$'")->where('ano_inicial','>','0')->min('ano_inicial');
        $ano_max = ProductoBusqueda::whereRaw("ano_final REGEXP '^-?[0-9]+$'")->where('ano_final','>','0')->max('ano_final');
        $filtro = ProductoBusqueda::where('id','>','0');

        
        if($ano!= "0" && $ano!= "todos"){
            $filtro->where('anos','like','%'.$ano.'%');
        }
        if($marca!= "0" && $modelo!= "todos"){
            $filtro->where('armadora',$marca);
        }
        if($modelo!= "0" && $modelo!= "todos"){
            $filtro->where('modelo',$modelo);
        }
        if($motor!= "0" && $motor != "todos"){
            $filtro->where('motor',$motor);
        }
        if($grupo!= "0" && $grupo!= "todos"){
            $filtro->where('grupo',$grupo);
        }
        if($familia!= "0" && $familia!= "todos"){
            $filtro->where('subgrupo',$familia);
        }

        $filtro = $filtro->get();
        //$queries = \DB::getQueryLog();
        //dd($queries);
        
        $anos = array_reverse(range($ano_min,$ano_max));
        $marcas = $filtro->unique('armadora')->pluck('armadora');
        $modelos = $filtro->unique('modelo')->pluck('modelo');
        $motores = $filtro->unique('motor')->pluck('motor');
        $grupos = $filtro->unique('grupo')->pluck('grupo');
        $familias = $filtro->unique('subgrupo')->pluck('subgrupo');


        $data = [
            'anos' => $anos,
            'marcas' => $marcas->sort()->values(),
            'modelos' => $modelos->sort()->values(),
            'motores' => $motores->sort()->values(),
            'grupos' => $grupos->sort()->values(),
            'familias' => $familias->sort()->values()
        ];

     

        $data['inicio']['ano'] = $ano;
        $data['inicio']['marca'] = $marca;
        $data['inicio']['modelo'] = $modelo;
        $data['inicio']['motor'] = $motor;
        $data['inicio']['grupo'] = $grupo;
        $data['inicio']['familia'] = $familia;

        return json_encode($data);


    }

    public function autocompletar(Request $request){
        extract($request->all());
        $consulta = "SELECT texto as value, texto as data FROM autocompletar WHERE MATCH ( texto ) AGAINST ( '".$query."') LIMIT 15";
        $resultados = \DB::select($consulta);
        /*$suggestions = [];
        foreach($resultados as $resultado)
            array_push($suggestions,$resultado->texto)*/;

        return json_encode(["query" => $query, "suggestions" => $resultados]);
    }

    public function pagina360($codigo){
        $producto = ProductoBusqueda::where('codigo_nikko',$codigo)->first();
        return view('pagina.vista360', compact('producto'));

    }

    public function enviarEmail(Request $request){
         
        extract($request->all());
        if($humano == "es_humano"){
              $empresa = DatosGenerales::find(1);

              $data = [
                    'name' => $name,
                    'lastName' => $lastName,
                    'number' => $number,
                    'subject' => $subject,
                    'message' => $message
              ];
       
              \Mail::send('emails.contacto', ['data'=> $data], function($message) use ($data,$empresa) {
                $correos = explode(';',$empresa->contacto_email_envio);
                foreach($correos as $key => $value)
                    $message->to(trim($value));
                $message->subject($data['subject']);
                $message->from('paginaweb@nikkoauto.com.mx','Contacto pagina web');
              });

              return "Gracias por ponerte en contacto con nosotros.";
        }
        
    }

}
