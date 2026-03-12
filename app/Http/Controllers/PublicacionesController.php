<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicaciones;

use Gate;
use DataTables;

class PublicacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Gate::denies('permiso', 'ver_publicaciones'))
            abort(404);
        $seccion = "Publicaciones";
        $breadcrumb = [
            ['route' => 'publicaciones.index', 'nombre' => 'Publicaciones']
        ]; 
        return view('publicaciones.index',compact('seccion','breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Gate::denies('permiso', 'agregar_publicaciones'))
            abort(403);
        $seccion = "Publicaciones";
        $breadcrumb = [
            ['route' => 'publicaciones.index', 'nombre' => 'Publicaciones'],
            ['route' => 'publicaciones.create', 'nombre' => 'Agregar']
        ]; 
        return view('publicaciones.agregar',compact('seccion','breadcrumb'));
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
        if (Gate::denies('permiso', 'agregar_publicaciones'))
            abort(403);
        extract($request->all());
        $nombre_archivo = "";
        $archivo_real = "";
        $url = '';
        $nombre_portada = "";


        $data = [
            'nombre' => $nombre,
            'archivo' => $nombre_archivo,
            'archivo_real' => $archivo_real,
            'url'      => $url,
            'portada' => $nombre_portada

        ];

        if(isset($archivo)){
            $nombre_archivo = $archivo->getClientOriginalName();
            $archivo_real = date('ymdHis').'-'.preg_replace('#[ -]+#', '-', $archivo->getClientOriginalName());
            $archivo->move(public_path().'/upload/publicaciones/',$archivo_real);
            $url = asset("upload/publicaciones/".$archivo_real);
            $data['url'] = $url;
            $data['archivo'] = $nombre_archivo;
            $data['archivo_real'] = $archivo_real;
        }

        if(isset($portada)){
            $nombre_archivo = date('ymdHis').'-'.$portada->getClientOriginalName();
            $portada->move(public_path().'/upload/publicaciones/portadas/',$nombre_archivo);
            $data['portada'] = $nombre_archivo;
        }

        if($data['archivo'] != ''){
            $publicacion = Publicaciones::create($data);
            (new SistemaController)->accion([\Auth::user()->id,'publicacion',$publicacion->id,'agregar','El usuario '.\Auth::user()->name.' agrego la publicacion '.$nombre]);
        }

        return redirect()->route('publicaciones.index');
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
        if (Gate::denies('permiso', 'editar_publicaciones'))
            abort(403);
        $seccion = "Publicaciones";
        $breadcrumb = [
            ['route' => 'publicaciones.index', 'nombre' => 'Publicaciones'],
            ['route' => 'publicaciones.index', 'nombre' => 'Editar']
        ]; 
        $publicacion = Publicaciones::find($id);
        return view('publicaciones.editar',compact('seccion','breadcrumb','publicacion'));
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
        //
        if (Gate::denies('permiso', 'editar_publicaciones'))
            abort(403);
        
        $publicacion = Publicaciones::find($id);
        extract($request->all());
        $nombre_archivo = $publicacion->archivo;
        $archivo_real =$publicacion->archivo_real;
        $url = $publicacion->url;
        $nombre_portada = $publicacion->portada;

        $data = [
            'nombre'       => $nombre,
            'archivo'      => $nombre_archivo,
            'archivo_real' => $archivo_real,
            'url'          => $url,
            'portada'      => $nombre_portada,
        ];

        if(isset($archivo)){
            $nombre_archivo = $archivo->getClientOriginalName();
            $archivo_real = date('ymdHis').'-'.preg_replace('#[ -]+#', '-', $archivo->getClientOriginalName());
            $archivo->move(public_path().'/upload/publicaciones/',$archivo_real);
            $url = asset("upload/publicaciones/".$archivo_real);
            $data['url'] = $url;
            $data['archivo'] = $nombre_archivo;
            $data['archivo_real'] = $archivo_real;
        }

        if(isset($portada)){
            $nombre_archivo = date('ymdHis').'-'.$portada->getClientOriginalName();
            $portada->move(public_path().'/upload/publicaciones/portadas/',$nombre_archivo);
            $data['portada'] = $nombre_archivo;
        }

        $publicacion->fill($data)->save();
        (new SistemaController)->accion([\Auth::user()->id,'publicacion',$publicacion->id,'editar','El usuario '.\Auth::user()->name.' edito la publicacion '.$nombre]);
        return redirect()->route('publicaciones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
         if (Gate::denies('permiso', 'eliminar_publicaciones'))
           return response()->json([
                    'code' => 0,
                    'message' => 'No tienes autorización para realizar esta accion.'
                ]);


        if($request->ajax()){
            $publicacion = Publicaciones::findOrFail($id);
            //movimiento del sistema
            (new SistemaController)->accion([\Auth::user()->id,'publicacion',$publicacion->id,'eliminar','El usuario '.\Auth::user()->name.' elimino la publicacion '.$publicacion->nombre]);
            if($publicacion->delete())
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
        return DataTables::of(Publicaciones::query())
        ->editColumn('portada',function($publicacion){
            return '<img src="'.asset('upload/publicaciones/portadas/'.$publicacion->portada).'" style="height:50px;">';
        })
        ->editColumn('url',function($publicacion){
            return "<a target='_blank' href='".$publicacion->url."'>".$publicacion->url."</a>";
        })
        ->addColumn('acciones',function($publicacion){
            return '<a href="'.route('publicaciones.edit',$publicacion->id).'" class="btn mr-1 mb-1 btn-outline-success btn-sm btn-block"><i class="fa fa-edit"></i> Editar</a>
            <button type="button" class="btn mr-1 mb-1 btn-outline-danger btn-sm btn-block" data-toggle="modal" data-target="#danger" data-id="'.$publicacion->id.'" data-funcion="eliminar"><i class="fa fa-close"></i> Eliminar</button>';
        })->rawColumns(['acciones','url','portada'])->make(true);
    }
}
