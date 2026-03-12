<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UsuariosRegistrados;

use Gate;
use DataTables;

class UsuariosRegistradosController extends Controller
{
    //
    //
    public function nuevos(){
        if (Gate::denies('permiso', 'ver_usuarios_registrados_nuevos'))
            abort(404);
        $seccion = "Usuarios registrados nuevos";
        $breadcrumb = [
            ['route' => 'usuarios_registrados.nuevos', 'nombre' => 'Usuarios nuevos']
        ]; 
        return view('usuarios_registrados.index_nuevos',compact('seccion','breadcrumb'));
    }

    public function aceptados(){
        if (Gate::denies('permiso', 'ver_usuarios_registrados_aceptados'))
            abort(404);
        $seccion = "Usuarios registrados aprobados";
        $breadcrumb = [
            ['route' => 'usuarios_registrados.aceptados', 'nombre' => 'Usuarios aceptados']
        ]; 
        return view('usuarios_registrados.index_aceptados',compact('seccion','breadcrumb'));
    }

    public function rechazados(){
        if (Gate::denies('permiso', 'ver_usuarios_registrados_rechazados'))
            abort(404);
        $seccion = "Usuarios registrados rechazados";
        $breadcrumb = [
            ['route' => 'usuarios_registrados.rechazados', 'nombre' => 'Usuarios rechazados']
        ]; 
        return view('usuarios_registrados.index_rechazados',compact('seccion','breadcrumb'));
    }

    public function verDetalle($id){
        if (Gate::denies('permiso', 'aceptar_usuarios_registrados_nuevos'))
            abort(403);
        $seccion = "Usuarios registrados detalle";
        $breadcrumb = [
            ['route' => 'usuarios_registrados.nuevos', 'nombre' => 'Detalle de usuario registrado']
        ]; 
        $usuario_registrado = UsuariosRegistrados::find($id);
        return view('usuarios_registrados.ver_detalle',compact('seccion','breadcrumb','usuario_registrado'));
    }

    public function guardarCambio(Request $request,$id){
        extract($request->all());
        $data = [
            'estado' => $estado,
            'nota' => $nota,
            'email' => $email
        ];

        if($password != "")
            $data['password'] = $password;

        $usuario_registrado = UsuariosRegistrados::find($id);
        $usuario_registrado->fill($data)->save();
        (new SistemaController)->accion([\Auth::user()->id,'usuario_registrado',$usuario_registrado->id,'eliminar','El usuario '.\Auth::user()->name.' cambio informacion del usuario registrado de web '.$usuario_registrado->nombre]);
        return redirect()->route('inicio');

    }

    public function eliminar(Request $request,$id){
        if($request->ajax()){
            $usuario_registrado = UsuariosRegistrados::findOrFail($id);
            //movimiento del sistema
            (new SistemaController)->accion([\Auth::user()->id,'usuario_registrado',$usuario_registrado->id,'eliminar','El usuario '.\Auth::user()->name.' elimino el usuario registrado de web '.$usuario_registrado->nombre]);
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

    public function dataNuevos(){
        return DataTables::of(UsuariosRegistrados::query()->where('estado','nuevo'))
        ->addColumn('acciones',function($usuario){
            return '<a href="'.route('usuarios_registrados.ver_detalle',$usuario->id).'" class="btn mr-1 mb-1 btn-outline-success btn-sm btn-block"><i class="fa fa-edit"></i> Ver detalle</a>
            <button type="button" class="btn mr-1 mb-1 btn-outline-danger btn-sm btn-block" data-toggle="modal" data-target="#danger" data-id="'.$usuario->id.'" data-funcion="eliminar"><i class="fa fa-close"></i> Eliminar</button>';
        })->rawColumns(['acciones'])->make(true);
    }

    public function dataAceptados(){
        return DataTables::of(UsuariosRegistrados::query()->where('estado','aprobado'))
        ->addColumn('acciones',function($usuario){
            return '<a href="'.route('usuarios_registrados.ver_detalle',$usuario->id).'" class="btn mr-1 mb-1 btn-outline-success btn-sm btn-block"><i class="fa fa-edit"></i> Ver detalle</a>
            <button type="button" class="btn mr-1 mb-1 btn-outline-danger btn-sm btn-block" data-toggle="modal" data-target="#danger" data-id="'.$usuario->id.'" data-funcion="eliminar"><i class="fa fa-close"></i> Eliminar</button>';
        })->rawColumns(['acciones'])->make(true);
    }

    public function dataRechazados(){
        return DataTables::of(UsuariosRegistrados::query()->where('estado','rechazado'))
        ->addColumn('acciones',function($usuario){
            return '<a href="'.route('usuarios_registrados.ver_detalle',$usuario->id).'" class="btn mr-1 mb-1 btn-outline-success btn-sm btn-block"><i class="fa fa-edit"></i> Ver detalle</a>
            <button type="button" class="btn mr-1 mb-1 btn-outline-danger btn-sm btn-block" data-toggle="modal" data-target="#danger" data-id="'.$usuario->id.'" data-funcion="eliminar"><i class="fa fa-close"></i> Eliminar</button>';
        })->rawColumns(['acciones'])->make(true);
    }


     public function nuevoRegistro(Request $request){
            extract($request->all());
            $data=[
                'clave'=> $clave,
                'razon_social'=> $razon_social,
                'nombre'=> $nombre,
                'email'=> $email,
                'telefono'=> $telefono,
                'password'=> $password,
                'estado'=> 'nuevo',
                'nota'=> '',
            ];

            UsuariosRegistrados::create($data);

            return response()->json([
                'code' => 1,
                'message' => 'El registro fue agregado correctamente.'
            ]);
    }
}
