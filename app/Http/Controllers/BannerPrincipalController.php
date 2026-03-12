<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;
use App\Models\BannerPrincipal;

class BannerPrincipalController extends Controller
{
    public function index()
    {
        
        $seccion = "Banner principal";
        $breadcrumb = [
            ['route' => 'banner_principal.index', 'nombre' => 'Banner principal']
        ]; 
        return view('banner_principal.index',compact('seccion','breadcrumb'));
    }

     public function create()
    {
        //
        $seccion = "Banner principal";
        $breadcrumb = [
            ['route' => 'banner_principal.index', 'nombre' => 'Banner principal'],
            ['route' => 'banner_principal.create', 'nombre' => 'Agregar']
        ]; 
        return view('banner_principal.agregar',compact('seccion','breadcrumb'));
    }
    

    public function store(Request $request)
    {
        //
        
        
        extract($request->all());
        $nombre_imagen = "";
        $nombre_catalogo = "";
        if(isset($archivo)){
            $nombre_imagen = $archivo->hashName();
            $archivo->move(public_path().'/upload/banner_principal/',$nombre_imagen);
        }
        if(isset($archivo_movil)){
            $nombre_imagen_movil = "movil_".$nombre_imagen;
            $archivo_movil->move(public_path().'/upload/banner_principal/',$nombre_imagen_movil);
        }
        $maximo = BannerPrincipal::max('ordenamiento');
        $data = [
            'url' => $url,
            'imagen' => $nombre_imagen,
            'ordenamiento' => $maximo + 1,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin
        ];

        $banner_principal = BannerPrincipal::create($data);

        

        (new SistemaController)->accion([\Auth::user()->id,'banner_principal',$banner_principal->id,'agregar','El usuario '.\Auth::user()->name.' agrego el banner '.$nombre_imagen]);
        return redirect()->route('banner_principal.index');
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        //

        $seccion = "Banner principal";
        $breadcrumb = [
            ['route' => 'banner_principal.index', 'nombre' => 'Marcas'],
            ['route' => 'banner_principal.index', 'nombre' => 'Editar']
        ]; 
        $banner_principal = BannerPrincipal::find($id);
        return view('banner_principal.editar',compact('seccion','breadcrumb','banner_principal'));
    }

    public function update(Request $request, $id)
    {
        //
        extract($request->all());
        $nombre_imagen = "";
        $nombre_catalogo = "";
        $banner_principal = BannerPrincipal::find($id);
        
        if(isset($archivo)){
            $nombre_imagen = $archivo->hashName();
            $archivo->move(public_path().'/upload/banner_principal/',$nombre_imagen);
        }
     

        if(isset($archivo_movil)){
            if($nombre_imagen == "")
                $nombre_imagen_movil = "movil_".$banner_principal->imagen;
            else
                $nombre_imagen_movil = "movil_".$nombre_imagen;
            
            $archivo_movil->move(public_path().'/upload/banner_principal/',$nombre_imagen_movil);
        }
  
        $data = [
            'url' => $url,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin
        ];

        if(isset($archivo))
            $data['imagen'] = $nombre_imagen;

      
        
        $banner_principal->fill($data)->save();
        (new SistemaController)->accion([\Auth::user()->id,'banner_principal',$banner_principal->id,'editar','El usuario '.\Auth::user()->name.' edito el banner '.$nombre_imagen]);
        return redirect()->route('banner_principal.index');
    }
    
    public function destroy(Request $request,$id)
    {
        //
        
        if($request->ajax()){
            $banner_principal = BannerPrincipal::findOrFail($id);
            //movimiento del sistema
            (new SistemaController)->accion([\Auth::user()->id,'banner_principal',$banner_principal->id,'eliminar','El usuario '.\Auth::user()->name.' elimino el banner']);
            if($banner_principal->delete())
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


    //
    public function bannerPrincipal()
    {
        //
        if (Gate::denies('permiso', 'editar_banner_principal'))
            abort(404);
        $seccion = "Banner principal";
        $breadcrumb = [
            ['route' => 'banner_principal.index', 'nombre' => 'Banner Principal']
        ]; 
        return view('banner_principal.banner',compact('seccion','breadcrumb'));
    }

    public function agregar(Request $request){
        //dd($request->all());
        $extension = $request->file->getClientOriginalExtension();
        $name = $request->file->getFilename();
        $request->file->move(public_path()."/upload/banner_principal/",$request->file->getClientOriginalName());
        (new SistemaController)->accion([\Auth::user()->id,'banner_principal',1,'agregar',\Auth::user()->name.' agrego la imagen '.$request->file->getClientOriginalName().' al banner principal']);

    }

    public function eliminar(Request $request){
        extract($request->all());
        unlink(public_path()."/upload/banner_principal/".$name);
        (new SistemaController)->accion([\Auth::user()->id,'banner_principal',1,'eliminar',\Auth::user()->name.'  elimino la imagen '.$name.' del banner principal']);
    }

    public function subidas(Request $request){
        $archivos = scandir(public_path()."/upload/banner_principal");
        $json = array();
        foreach ($archivos as $key => $value) {
            # code...
            if($value == "." || $value == "..")
                continue;

            $data = array();
            $archivo = public_path()."/upload/banner_principal/".$value;
            $data['name'] = $value;
            $data['size'] = filesize($archivo);
            $data['url'] = asset("/upload/banner_principal/".$value);
            array_push($json, $data);

        }

        return response()->json($json);
    }

    public function data(){
        return \DataTables::of(BannerPrincipal::query()->orderBy('ordenamiento','asc'))
        ->editColumn('imagen',function($banner){
            return '<img src="'.asset('upload/banner_principal/'.$banner->imagen).'" style="height:20px;">';
        })
        ->addColumn('acciones',function($banner){
            return '<a href="'.route('banner_principal.edit',$banner->id).'" class="btn mr-1 mb-1 btn-outline-success btn-sm btn-block"><i class="fa fa-edit"></i> Editar</a>
            <button type="button" class="btn mr-1 mb-1 btn-outline-danger btn-sm btn-block" data-toggle="modal" data-target="#danger" data-id="'.$banner->id.'" data-funcion="eliminar"><i class="fa fa-close"></i> Eliminar</button>';
        })->rawColumns(['acciones','imagen'])->make(true);
    }

    public function ordenamiento(Request $request){
        //var_dump($request->all());
        foreach($request->input('rows', []) as $row)
        {
            BannerPrincipal::find($row['id'])->update([
                'ordenamiento' => $row['position']
            ]);
        }

        return "";
    }



}
