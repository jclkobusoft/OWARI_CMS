<?php

namespace App\Http\Controllers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use App\Models\Informate;


use DataTables;

class InformateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $seccion = "Informate";
        $breadcrumb = [
            ['route' => 'informate.index', 'nombre' => 'Informate']
        ]; 
        return view('informate.index',compact('seccion','breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$seccion = "Productos";
        $seccion = "Informate";
        $breadcrumb = [
            ['route' => 'informate.index', 'nombre' => 'Informate'],
            ['route' => 'informate.create', 'nombre' => 'Agregar entrada']
        ];

        $estampa = date("YmdHis"); 
        return view('informate.agregar',compact('seccion','breadcrumb','estampa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        extract($request->all());
        
        $data = [
              'titulo' => $titulo,
              'subtitulo' => $subtitulo,
              'contenido' => $contenido,
              'evento' => $evento,
              'evento_nombre' => $evento_nombre,
              'evento_fecha' => $evento_fecha,
              'tags' => $tags
        ];

        $informate = Informate::create($data);

        if($request->banner){
            $extension = $request->banner->getClientOriginalExtension();
            $name = 'banner-'.$informate->id;
            $request->banner->move(public_path()."/informate/",$name.".".$extension);
            $informate->fill(['banner' => $name.".".$extension])->save();
        }

       $ruta = storage_path('app/imagenes/'.$estampa);
       
       if (file_exists($ruta)) {
    		   $ruta_nueva = storage_path('app/public/informate/'.$informate->id);
    		   $file = new Filesystem();
    		   $file->moveDirectory($ruta, $ruta_nueva);
    		}

    	
        (new SistemaController)->accion([\Auth::user()->id,'informate',$informate->id,'agregar','El usuario '.\Auth::user()->name.' agrego informate '.$informate->titulo]);

        return redirect()->route('informate.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $seccion = "Informate";
        $breadcrumb = [
            ['route' => 'informate.index', 'nombre' => 'Informate'],
            ['route' => 'informate.create', 'nombre' => 'Editar entrada']
        ];
        $estampa = date("YmdHis"); 
       	$informate = Informate::find($id);
        return view('informate.editar',compact('seccion','breadcrumb','informate','estampa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
        extract($request->all());
        
        $data = [
              'titulo' => $titulo,
              'subtitulo' => $subtitulo,
              'contenido' => $contenido,
              'evento' => $evento,
              'evento_nombre' => $evento_nombre,
              'evento_fecha' => $evento_fecha,
              'tags' => $tags
        ];

        $informate = Informate::find($id);
        

        if($request->banner){
            $extension = $request->banner->getClientOriginalExtension();
            $name = 'banner-'.$informate->id;
            $request->banner->move(public_path()."/informate/",$name.".".$extension);
            $data['banner'] = $name.".".$extension;
        }

        $informate->fill($data)->save();

        (new SistemaController)->accion([\Auth::user()->id,'informate',$informate->id,'editar','El usuario '.\Auth::user()->name.' edito la entrada '.$informate->titulo]);
        return redirect()->route('informate.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        /*if (Gate::denies('permiso', 'eliminar_publicaciones'))
           return response()->json([
                    'code' => 0,
                    'message' => 'No tienes autorización para realizar esta accion.'
                ]);
    */
        if($request->ajax()){
            $entrada = Informate::findOrFail($id);

            //movimiento del sistema
            (new SistemaController)->accion([\Auth::user()->id,'entrada',$entrada->id,'eliminar','El usuario '.\Auth::user()->name.' elimino la entrada '.$entrada->titulo]);
            if($entrada->delete())
                return response()->json([
                    'code' => 1,
                    'message' => 'El registro fue eliminado correctamente.'
                ]);
            else
                return response()->json([
                    'code' => 0,
                    'message' => 'Ocurrio un error, intentalo nuevamente.'
                ]);
        
        }
        else
            abort(403);
    }


    public function data(){
        return DataTables::of(Informate::query())->addColumn('acciones',function($entrada){
            return '<a href="'.route('informate.edit',$entrada->id).'" class="btn mr-1 mb-1 btn-outline-success btn-sm btn-block"><i class="fa fa-edit"></i> Editar</a>
            <button type="button" class="btn mr-1 mb-1 btn-outline-danger btn-sm btn-block" data-toggle="modal" data-target="#danger" data-id="'.$entrada->id.'" data-funcion="eliminar"><i class="fa fa-close"></i> Eliminar</button>';
        })->editColumn('evento',function($entrada){ return $entrada->evento ? "Si" : "No"; })->rawColumns(['acciones'])->make(true);
    }


    public function agregarImagenes(Request $request){

    	extract($request->all());

    	if(isset($carpeta))
    		$ruta = storage_path('app/public/informate/'.$carpeta);
    	else
    		$ruta = storage_path('app/imagenes/'.$estampa);

    	if (!file_exists($ruta)) {
		    mkdir($ruta, 0777, true);
		}

    	$extension = $request->file->getClientOriginalExtension();
        $name = $request->file->getFilename();
        $request->file->move($ruta,$request->file->getClientOriginalName());

    }

   

    public function eliminarImagenes(Request $request){
    	extract($request->all());
    	if(isset($estampa))
    		$ruta = storage_path('app/imagenes/'.$estampa."/");
    	else
    		$ruta = storage_path('app/public/informate/'.$id_informate."/");
        unlink($ruta.$name);

    }


    public function subidas(Request $request){
        
    	extract($request->all());
        $carpeta = 'informate/'.$id;
		$ruta = storage_path('app/public/'.$carpeta);
		$archivos =  scandir($ruta);

	    $json = array();
        foreach ($archivos as $key => $value) {
            # code...
            if($value == "." || $value == "..")
                continue;

            $data = array();
            $archivo = $ruta."/".$value;
            $data['name'] = $value;
            $data['size'] = filesize($archivo);
            $data['url'] = asset("storage/".$carpeta."/".$value);
            array_push($json, $data);

        }

        return response()->json($json);
    }


    
    
}
