<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;

use Gate;
use DataTables;

class MarcasController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Gate::denies('permiso', 'ver_marcas'))
            abort(404);
        $seccion = "Marcas";
        $breadcrumb = [
            ['route' => 'marcas.index', 'nombre' => 'Marcas']
        ]; 
        return view('marcas.index',compact('seccion','breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Gate::denies('permiso', 'agregar_marcas'))
            abort(403);
        $seccion = "Marcas";
        $breadcrumb = [
            ['route' => 'marcas.index', 'nombre' => 'Marcas'],
            ['route' => 'marcas.create', 'nombre' => 'Agregar']
        ]; 
        return view('marcas.agregar',compact('seccion','breadcrumb'));
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
        $nombre_imagen = "";
        $nombre_catalogo = "";
        if(isset($archivo)){
            $nombre_imagen = preg_replace('#[ -]+#', '-', $archivo->getClientOriginalName());
            $archivo->move(public_path().'/upload/marcas/',$nombre_imagen);
        }
        $maximo = Marca::max('ordenamiento');

        $data = [
            'nombre' => $nombre,
            'imagen' => $nombre_imagen,
            'tipo' => $tipo,
            'redireccion' => $redireccion,
            'url' => $url,
            'contenido' => $contenido,
            'descripcion_breve' => $descripcion_breve,
            'titulo_principal' => $titulo_principal,
            'ordenamiento' => $maximo + 1
        ];

        $marca = Marca::create($data);


        if(isset($banner)){
            $nombre_imagen = "banner_marca_".$marca->id.".".$banner->getClientOriginalExtension();
            $banner->move(public_path().'/upload/marcas/',$nombre_imagen);
            $marca->fill(['banner' => $nombre_imagen])->save();
        }

        

        (new SistemaController)->accion([\Auth::user()->id,'marca',$marca->id,'agregar','El usuario '.\Auth::user()->name.' agrego la marca '.$nombre]);
        return redirect()->route('marcas.index');
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
        if (Gate::denies('permiso', 'editar_marcas'))
            abort(403);
        $seccion = "Marcas";
        $breadcrumb = [
            ['route' => 'marcas.index', 'nombre' => 'Marcas'],
            ['route' => 'marcas.index', 'nombre' => 'Editar']
        ]; 
        $marca = Marca::find($id);
        return view('marcas.editar',compact('seccion','breadcrumb','marca'));
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
            'nombre' => $nombre,
            'tipo' => $tipo,
            'redireccion' => $redireccion,
            'url' => $url,
            'contenido' => $contenido,
            'descripcion_breve' => $descripcion_breve,
            'titulo_principal' => $titulo_principal
        ];

        $nombre_imagen = "";
        $nombre_catalogo = "";
        if(isset($archivo)){
            $nombre_imagen = preg_replace('#[ -]+#', '-', $archivo->getClientOriginalName());
            $archivo->move(public_path().'/upload/marcas/',$nombre_imagen);
            $data['imagen'] = $nombre_imagen;
        }

        $marca = Marca::find($id);

        if(isset($banner)){
            $nombre_imagen = "banner_marca_".$marca->id.".".$banner->getClientOriginalExtension();
            $banner->move(public_path().'/upload/marcas/',$nombre_imagen);
            $data['banner'] = $nombre_imagen;
        }

      

        
        $marca->fill($data)->save();
        (new SistemaController)->accion([\Auth::user()->id,'marca',$marca->id,'editar','El usuario '.\Auth::user()->name.' edito la marca '.$nombre]);
        return redirect()->route('marcas.index');
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
        if (Gate::denies('permiso', 'eliminar_marcas'))
           return response()->json([
                    'code' => 0,
                    'message' => 'No tienes autorización para realizar esta accion.'
                ]);


        if($request->ajax()){
            $marca = Marca::findOrFail($id);
            //movimiento del sistema
            (new SistemaController)->accion([\Auth::user()->id,'marca',$marca->id,'eliminar','El usuario '.\Auth::user()->name.' elimino la marca '.$marca->nombre]);
            if($marca->delete())
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
        return DataTables::of(Marca::query()->orderBy('ordenamiento','asc'))
        ->editColumn('imagen',function($marca){
            return '<img src="'.asset('upload/marcas/'.$marca->imagen).'" style="height:20px;">';
        })
        ->addColumn('acciones',function($marca){
            return '<a href="'.route('marcas.edit',$marca->id).'" class="btn mr-1 mb-1 btn-outline-success btn-sm btn-block"><i class="fa fa-edit"></i> Editar</a>
            <button type="button" class="btn mr-1 mb-1 btn-outline-danger btn-sm btn-block" data-toggle="modal" data-target="#danger" data-id="'.$marca->id.'" data-funcion="eliminar"><i class="fa fa-close"></i> Eliminar</button>';
        })->rawColumns(['acciones','imagen'])->make(true);
    }

    public function ordenamiento(Request $request){
        //var_dump($request->all());
        foreach($request->input('rows', []) as $row)
        {
            Marca::find($row['id'])->update([
                'ordenamiento' => $row['position']
            ]);
        }

        return "";
    }
}
