<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalogos;

use Gate;
use DataTables;

class CatalogosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Gate::denies('permiso', 'ver_catalogos'))
            abort(404);
        $seccion = "Catalogos";
        $breadcrumb = [
            ['route' => 'catalogos.index', 'nombre' => 'Catalogos']
        ]; 
        return view('catalogos.index',compact('seccion','breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Gate::denies('permiso', 'agregar_catalogos'))
            abort(403);
        $seccion = "Catalogos";
        $breadcrumb = [
            ['route' => 'catalogos.index', 'nombre' => 'Catalogos'],
            ['route' => 'catalogos.create', 'nombre' => 'Agregar']
        ]; 
        return view('catalogos.agregar',compact('seccion','breadcrumb'));
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
        if (Gate::denies('permiso', 'agregar_catalogos'))
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
            'portada' => $nombre_portada,
            'tags' => $tags
        ];

        if(isset($archivo)){
            $nombre_archivo = $archivo->getClientOriginalName();
            $archivo_real = date('ymdHis').'-'.preg_replace('#[ -]+#', '-', $archivo->getClientOriginalName());
            $archivo->move(public_path().'/upload/catalogos/',$archivo_real);
            $url = asset("upload/catalogos/".$archivo_real);
            $data['url'] = $url;
            $data['archivo'] = $nombre_archivo;
            $data['archivo_real'] = $archivo_real;
        }
        if(isset($portada)){
            $nombre_archivo = date('ymdHis').'-'.$portada->getClientOriginalName();
            $portada->move(public_path().'/upload/catalogos/portadas/',$nombre_archivo);
            $data['portada'] = $nombre_archivo;
        }

        if($data['archivo'] != ''){
            $catalogo = Catalogos::create($data);
            (new SistemaController)->accion([\Auth::user()->id,'catalogo',$catalogo->id,'agregar','El usuario '.\Auth::user()->name.' agrego el catalogo '.$nombre]);
        }

        return redirect()->route('catalogos.index');
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
        if (Gate::denies('permiso', 'editar_catalogos'))
            abort(403);
        $seccion = "Catalogos";
        $breadcrumb = [
            ['route' => 'catalogos.index', 'nombre' => 'Catalogos'],
            ['route' => 'catalogos.index', 'nombre' => 'Editar']
        ]; 
        $catalogo = Catalogos::find($id);
        return view('catalogos.editar',compact('seccion','breadcrumb','catalogo'));
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
        if (Gate::denies('permiso', 'editar_catalogos'))
            abort(403);
        
        $catalogo = Catalogos::find($id);
        extract($request->all());
        $nombre_archivo = $catalogo->archivo;
        $archivo_real =$catalogo->archivo_real;
        $url = $catalogo->url;
        $nombre_portada = $catalogo->portada;


        $data = [
            'nombre'       => $nombre,
            'archivo'      => $nombre_archivo,
            'archivo_real' => $archivo_real,
            'url'          => $url,
            'portada'      => $nombre_portada,
            'tags'         => $tags
        ];

        if(isset($archivo)){
            $nombre_archivo = $archivo->getClientOriginalName();
            $archivo_real = date('ymdHis').'-'.preg_replace('#[ -]+#', '-', $archivo->getClientOriginalName());
            $archivo->move(public_path().'/upload/catalogos/',$archivo_real);
            $url = asset("upload/catalogos/".$archivo_real);
            $data['url'] = $url;
            $data['archivo'] = $nombre_archivo;
            $data['archivo_real'] = $archivo_real;
        }

        if(isset($portada)){
            $nombre_archivo = date('ymdHis').'-'.$portada->getClientOriginalName();
            $portada->move(public_path().'/upload/catalogos/portadas/',$nombre_archivo);
            $data['portada'] = $nombre_archivo;
        }

        $catalogo->fill($data)->save();
        (new SistemaController)->accion([\Auth::user()->id,'catalogo',$catalogo->id,'editar','El usuario '.\Auth::user()->name.' edito el catalogo '.$nombre]);
        return redirect()->route('catalogos.index');
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
         if (Gate::denies('permiso', 'eliminar_catalogos'))
           return response()->json([
                    'code' => 0,
                    'message' => 'No tienes autorización para realizar esta accion.'
                ]);


        if($request->ajax()){
            $catalogo = Catalogos::findOrFail($id);
            //movimiento del sistema
            (new SistemaController)->accion([\Auth::user()->id,'catalogo',$catalogo->id,'eliminar','El usuario '.\Auth::user()->name.' elimino el catalogo '.$catalogo->nombre]);
            if($catalogo->delete())
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
        return DataTables::of(Catalogos::query())
        ->editColumn('portada',function($catalogo){
            return '<img src="'.asset('upload/catalogos/portadas/'.$catalogo->portada).'" style="height:50px;">';
        })
        ->editColumn('url',function($catalogo){
            return "<a target='_blank' href='".$catalogo->url."'>".$catalogo->url."</a>";
        })
        ->addColumn('acciones',function($catalogo){
            return '<a href="'.route('catalogos.edit',$catalogo->id).'" class="btn mr-1 mb-1 btn-outline-success btn-sm btn-block"><i class="fa fa-edit"></i> Editar</a>
            <button type="button" class="btn mr-1 mb-1 btn-outline-danger btn-sm btn-block" data-toggle="modal" data-target="#danger" data-id="'.$catalogo->id.'" data-funcion="eliminar"><i class="fa fa-close"></i> Eliminar</button>';
        })->rawColumns(['acciones','url','portada'])->make(true);
    }

    public function ordenamiento(Request $request){
        //var_dump($request->all());
        foreach($request->input('rows', []) as $row)
        {
            Catalogos::find($row['id'])->update([
                'ordenamiento' => $row['position']
            ]);
        }

        return "";
    }
}
