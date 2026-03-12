<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boletines;

use Gate;
use DataTables;
class BoletinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Gate::denies('permiso', 'ver_boletines'))
            abort(404);
        $seccion = "Boletines";
        $breadcrumb = [
            ['route' => 'boletines.index', 'nombre' => 'Boletines']
        ]; 
        return view('boletines.index',compact('seccion','breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Gate::denies('permiso', 'agregar_boletines'))
            abort(403);
        $seccion = "Boletines";
        $breadcrumb = [
            ['route' => 'boletines.index', 'nombre' => 'Boletines'],
            ['route' => 'boletines.create', 'nombre' => 'Agregar']
        ]; 
        return view('boletines.agregar',compact('seccion','breadcrumb'));
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
        //
        if (Gate::denies('permiso', 'agregar_boletines'))
            abort(403);
        extract($request->all());
        $nombre_archivo = "";
        $archivo_real = "";
        $nombre_portada = "";
        $url = '';

        $data = [
            'nombre' => $nombre,
            'archivo' => $nombre_archivo,
            'archivo_real' => $archivo_real,
            'url'      => $url,
            'portada' => $nombre_portada,
            'fecha_publicacion' => $fecha_publicacion,
            'tags' => $tags,
            'descripcion' => $descripcion,
            'ano' => $ano,
            'marca' => $marca
        ];

        if(isset($archivo)){
            $nombre_archivo = $archivo->getClientOriginalName();
            $archivo_real = date('ymdHis').'-'.preg_replace('#[ -]+#', '-', $archivo->getClientOriginalName());
            $archivo->move(public_path().'/upload/boletines/',$archivo_real);
            $url = asset("upload/boletines/".$archivo_real);
            $data['url'] = $url;
            $data['archivo'] = $nombre_archivo;
            $data['archivo_real'] = $archivo_real;
        }

        if(isset($portada)){
            $nombre_archivo = date('ymdHis').'-'.$portada->getClientOriginalName();
            $portada->move(public_path().'/upload/boletines/portadas/',$nombre_archivo);
            $data['portada'] = $nombre_archivo;
        }

        if($data['archivo'] != ''){
            $boletin = Boletines::create($data);
            (new SistemaController)->accion([\Auth::user()->id,'boletin',$boletin->id,'agregar','El usuario '.\Auth::user()->name.' agrego el boletin '.$nombre]);
        }

        return redirect()->route('boletines.index');
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
        if (Gate::denies('permiso', 'editar_boletines'))
            abort(403);
        $seccion = "Boletines";
        $breadcrumb = [
            ['route' => 'boletines.index', 'nombre' => 'Boletines'],
            ['route' => 'boletines.index', 'nombre' => 'Editar']
        ]; 
        $boletin = Boletines::find($id);
        return view('boletines.editar',compact('seccion','breadcrumb','boletin'));
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
        if (Gate::denies('permiso', 'editar_boletines'))
            abort(403);
        
        $boletin = Boletines::find($id);
        extract($request->all());
        $nombre_archivo = $boletin->archivo;
        $archivo_real =$boletin->archivo_real;
        $url = $boletin->url;
        $nombre_portada = $boletin->portada;

        $data = [
            'nombre'       => $nombre,
            'archivo'      => $nombre_archivo,
            'archivo_real' => $archivo_real,
            'url'          => $url,
            'portada'      => $nombre_portada,
            'fecha_publicacion' => $fecha_publicacion,
            'tags' => $tags,
            'descripcion' => $descripcion,
            'ano' => $ano,
            'marca' => $marca
        ];

        if(isset($archivo)){
            $nombre_archivo = $archivo->getClientOriginalName();
            $archivo_real = date('ymdHis').'-'.preg_replace('#[ -]+#', '-', $archivo->getClientOriginalName());
            $archivo->move(public_path().'/upload/boletines/',$archivo_real);
            $url = asset("upload/boletines/".$archivo_real);
            $data['url'] = $url;
            $data['archivo'] = $nombre_archivo;
            $data['archivo_real'] = $archivo_real;
        }

        if(isset($portada)){
            $nombre_archivo = date('ymdHis').'-'.$portada->getClientOriginalName();
            $portada->move(public_path().'/upload/boletines/portadas/',$nombre_archivo);
            $data['portada'] = $nombre_archivo;
        }

        $boletin->fill($data)->save();
        (new SistemaController)->accion([\Auth::user()->id,'boletin',$boletin->id,'editar','El usuario '.\Auth::user()->name.' edito el boletin '.$nombre]);
        return redirect()->route('boletines.index');
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
         if (Gate::denies('permiso', 'eliminar_boletines'))
           return response()->json([
                    'code' => 0,
                    'message' => 'No tienes autorización para realizar esta accion.'
                ]);


        if($request->ajax()){
            $boletin = Boletines::findOrFail($id);
            //movimiento del sistema
            (new SistemaController)->accion([\Auth::user()->id,'boletin',$boletin->id,'eliminar','El usuario '.\Auth::user()->name.' elimino el boletin '.$boletin->nombre]);
            if($boletin->delete())
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
        return DataTables::of(Boletines::orderBy('id','desc')->get())
        ->editColumn('portada',function($boletin){
            return '<img src="'.asset('upload/boletines/portadas/'.$boletin->portada).'" style="height:50px;">';
        })
        ->editColumn('url',function($boletin){
            return "<a target='_blank' href='".$boletin->url."'>".$boletin->url."</a>";
        })
        ->addColumn('acciones',function($boletin){
            return '<a href="'.route('boletines.edit',$boletin->id).'" class="btn mr-1 mb-1 btn-outline-success btn-sm btn-block"><i class="fa fa-edit"></i> Editar</a>
            <button type="button" class="btn mr-1 mb-1 btn-outline-danger btn-sm btn-block" data-toggle="modal" data-target="#danger" data-id="'.$boletin->id.'" data-funcion="eliminar"><i class="fa fa-close"></i> Eliminar</button>';
        })->rawColumns(['acciones','url','portada'])->make(true);
    }
}
