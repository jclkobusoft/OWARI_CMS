<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Permisos;

use DataTables;
use Gate;


class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Gate::denies('permiso', 'ver_usuarios'))
            abort(404);
        $seccion = "Usuarios";
        $breadcrumb = [
            ['route' => 'usuarios.index', 'nombre' => 'Usuarios']
        ]; 
        return view('usuarios.index',compact('seccion','breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Gate::denies('permiso', 'agregar_usuarios'))
            abort(403);
        $seccion = "Usuarios";
        $breadcrumb = [
            ['route' => 'usuarios.index', 'nombre' => 'Usuarios'],
            ['route' => 'usuarios.create', 'nombre' => 'Agregar']
        ]; 
        return view('usuarios.agregar',compact('seccion','breadcrumb'));
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
        if (Gate::denies('permiso', 'agregar_usuarios'))
            abort(404);
        extract($request->all());

        $data = [
            "name" => $name,
            "email" => $email,
            "password" => \Hash::make($password)
        ];

        $usuario = User::create($data);

        $data = ['id_usuario' => $usuario->id];
        if(isset($permisos))
            foreach ($permisos as $key => $value)
                   $data[$value] = true;

        Permisos::create($data);

        //movimiento del sistema
        (new SistemaController)->accion([\Auth::user()->id,'usuario',$usuario->id,'agregar','El usuario '.\Auth::user()->name.' agrego al usuario '.$name]);

        return redirect()->route('usuarios.index');
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
        if (Gate::denies('permiso', 'editar_usuarios'))
            abort(404);
        $seccion = "Usuarios";
        $breadcrumb = [
            ['route' => 'usuarios.index', 'nombre' => 'Usuarios'],
            ['route' => 'usuarios.index', 'nombre' => 'Editar']
        ];
        $usuario = User::find($id);
        return view('usuarios.editar',compact('seccion','breadcrumb','usuario'));
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
        if (Gate::denies('permiso', 'editar_usuarios'))
            abort(404);
        extract($request->all());

        $data = [
            "name" => $name,
            "email" => $email,
        ];

        if($password !="")
            $data['password'] = \Hash::make($password);

        $usuario = User::find($id);
        $usuario->fill($data)->save();

        Permisos::where('id_usuario',$id)->delete();

        $data = ['id_usuario' => $usuario->id];
        if(isset($permisos))
            foreach ($permisos as $key => $value)
                   $data[$value] = true;

        Permisos::create($data);

        //movimiento del sistema
        (new SistemaController)->accion([\Auth::user()->id,'usuario',$usuario->id,'editar','El usuario '.\Auth::user()->name.' edito al usuario '.$name]);

        return redirect()->route('usuarios.index');
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
         if (Gate::denies('permiso', 'eliminar_usuarios'))
           return response()->json([
                    'code' => 0,
                    'message' => 'No tienes autorización para realizar esta accion.'
                ]);


        if($request->ajax()){
            $usuario = User::findOrFail($id);
            Permisos::where('id_usuario',$id)->delete();
            //movimiento del sistema
            (new SistemaController)->accion([\Auth::user()->id,'usuario',$usuario->id,'eliminar','El usuario '.\Auth::user()->name.' elimino al usuario '.$usuario->name]);
            if($usuario->delete())
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
        return DataTables::of(User::query())->addColumn('acciones',function($usuario){
            return '<a href="'.route('usuarios.edit',$usuario->id).'" class="btn mr-1 mb-1 btn-outline-success btn-sm btn-block"><i class="fa fa-edit"></i> Editar</a>
            <button type="button" class="btn mr-1 mb-1 btn-outline-danger btn-sm btn-block" data-toggle="modal" data-target="#danger" data-id="'.$usuario->id.'" data-funcion="eliminar"><i class="fa fa-close"></i> Eliminar</button>';
        })->rawColumns(['acciones'])->make(true);
    }

}
