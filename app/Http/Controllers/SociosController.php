<?php

namespace App\Http\Controllers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use App\Models\SocioComercial;


use DataTables;

class SociosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $seccion = "Socios comerciales";
        $breadcrumb = [
            ['route' => 'socios.index', 'nombre' => 'Socios comerciales']
        ]; 
        return view('socios.index',compact('seccion','breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$seccion = "Productos";
        $seccion = "Socios comerciales";
        $breadcrumb = [
            ['route' => 'socios.index', 'nombre' => 'Socios comerciales'],
            ['route' => 'socios.create', 'nombre' => 'Agregar socio']
        ];

        return view('socios.agregar',compact('seccion','breadcrumb'));
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
              'nombre'      => $nombre,
              'descripcion' => $descripcion,
              'telefono_1'  => $telefono_1,
              'telefono_2'  => $telefono_2,
              'direccion_1' => $direccion_1,
              'direccion_2' => $direccion_2,
              'direccion_3' => $direccion_3,
              'pagina_web'  => $pagina_web,
              'tags'        => $tags
        ];

        $socio = SocioComercial::create($data);

        if($request->logotipo){
            $extension = $request->logotipo->getClientOriginalExtension();
            $name = 'logotipo-'.$socio->id;
            $request->logotipo->move(public_path()."/socios/",$name.".".$extension);
            $socio->fill(['logo' => $name.".".$extension])->save();
        }

    	
        (new SistemaController)->accion([\Auth::user()->id,'socio',$socio->id,'agregar','El usuario '.\Auth::user()->name.' agrego al socio comercial '.$socio->nombre]);

        return redirect()->route('socios.index');

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
        $seccion = "Socios Comerciales";
        $breadcrumb = [
            ['route' => 'socios.index', 'nombre' => 'Socios comerciales'],
            ['route' => 'socios.create', 'nombre' => 'Editar socio']
        ];
       	$socio = SocioComercial::find($id);
        return view('socios.editar',compact('seccion','breadcrumb','socio'));
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
              'nombre'      => $nombre,
              'descripcion' => $descripcion,
              'telefono_1'  => $telefono_1,
              'telefono_2'  => $telefono_2,
              'direccion_1' => $direccion_1,
              'direccion_2' => $direccion_2,
              'direccion_3' => $direccion_3,
              'pagina_web'  => $pagina_web,
              'tags'        => $tags
        ];

        $socio = SocioComercial::find($id);

        if($request->logotipo){
            $extension = $request->logotipo->getClientOriginalExtension();
            $name = 'logotipo-'.$socio->id;
            $request->logotipo->move(public_path()."/socios/",$name.".".$extension);
            $data['logo'] = $name.".".$extension;
        }

        $socio->fill($data)->save();

        (new SistemaController)->accion([\Auth::user()->id,'socio',$socio->id,'editar','El usuario '.\Auth::user()->name.' edito al socio comercial '.$socio->nombre]);
        return redirect()->route('socios.index');

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
            $producto = ProductoBusqueda::findOrFail($id);
            //movimiento del sistema
            (new SistemaController)->accion([\Auth::user()->id,'producto',$producto->id,'eliminar','El usuario '.\Auth::user()->name.' elimino el producto '.$producto->codigo_nikko]);
            $producto->removeFromIndex();
            if($producto->delete())
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
        return DataTables::of(SocioComercial::query())->addColumn('acciones',function($socio){
            return '<a href="'.route('socios.edit',$socio->id).'" class="btn mr-1 mb-1 btn-outline-success btn-sm btn-block"><i class="fa fa-edit"></i> Editar</a>
            <button type="button" class="btn mr-1 mb-1 btn-outline-danger btn-sm btn-block" data-toggle="modal" data-target="#danger" data-id="'.$socio->id.'" data-funcion="eliminar"><i class="fa fa-close"></i> Eliminar</button>';
        })->editColumn('logo',function($socio){ return '<img src="'.asset('/socios/'.$socio->logo).'" style="height:40px;">'; })->rawColumns(['acciones','logo'])->make(true);
    }

    
}
