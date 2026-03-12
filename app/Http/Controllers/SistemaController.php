<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovimientosUsuarios;
use App\Models\DatosGenerales;
use App\Models\ProductoBusqueda;
use App\Models\Autocompletar;
use Illuminate\Filesystem\Filesystem;

use Gate;
use DataTables;
class SistemaController extends Controller
{
    //
    public function eliminarImagenEnCarpetas($directorio, $nombreImagen) {
        // Verificar si el directorio existe
        if (!is_dir($directorio)) {
            return "El directorio no existe.";
        }
        
        // Crear un iterador recursivo para recorrer todas las subcarpetas
        $archivos = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directorio, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );
        
        $imagenEliminada = false;
        
        foreach ($archivos as $archivo) {
            // Verificar si es un archivo y coincide con el nombre de la imagen
            if ($archivo->isFile() && $archivo->getFilename() === $nombreImagen) {
                // Intentar eliminar la imagen
                if (unlink($archivo->getPathname())) {
                    $imagenEliminada = true;
                    echo "Imagen eliminada: " . $archivo->getPathname() . "<br>";
                } else {
                    echo "Error al eliminar: " . $archivo->getPathname() . "<br>";
                }
            }
        }
        
        return $imagenEliminada ? "Imagen eliminada con éxito." : "No se encontró la imagen especificada.";
    }


    public function test(){
        
        $carpetaRaiz = storage_path('app/public/productos'); // Reemplaza con la ruta real
        $nombreArchivoImagen = 'PHOTO-2022-11-03-13-21-09_4-removebg-preview.webp'; // Reemplaza con el nombre real

        $resultado = $this->eliminarImagenEnCarpetas($carpetaRaiz, $nombreArchivoImagen);
        echo $resultado;
    }


    public function index(){
    		$seccion = "Bienvenido";
            $breadcrumb = [
                ['route' => 'inicio', 'nombre' => 'Inicio']
            ]; 
            return view('inicio',compact('seccion','breadcrumb'));
    }

    public function accion($accion){
        //
        MovimientosUsuarios::create([
            'id_usuario' => $accion[0],
            'objeto' => $accion[1],
            'id_objeto' => $accion[2],
            'accion' => $accion[3],
            'movimiento' => $accion[4]
        ]);
        return true;
        
    }

    public function verEmpresa(){
        $seccion = "Empresa";
        $breadcrumb = [
            ['route' => 'empresa.ver', 'nombre' => 'Empresa']
        ]; 
        $empresa = DatosGenerales::find(1);
        return view('empresa.empresa',compact('seccion','breadcrumb','empresa'));
    }

    public function empresaGuardar(Request $request, $id){
        extract($request->all());
        $data = [
            'nosotros_historia_titulo'=> $nosotros_historia_titulo,
            'nosotros_historia_texto'=> $nosotros_historia_texto,
            'nosotros_url_video_historia'=> $nosotros_url_video_historia,
            'nosotros_titulo_video_historia'=> $nosotros_titulo_video_historia,
            'nosotros_lema'=> $nosotros_lema,
            'mision'=> $mision,
            'vision'=> $vision,
            'valores'=> $valores,
            /*'nosotros_numeros_experiencia'=> $nosotros_numeros_experiencia,
            'nosotros_numeros_productos'=> $nosotros_numeros_productos,
            'nosotros_numeros_socios'=> $nosotros_numeros_socios,
            'nosotros_numeros_marcas'=> $nosotros_numeros_marcas,
            'nosotros_numeros_empleados'=> $nosotros_numeros_empleados,
            'nosotros_numeros_almacenes'=> $nosotros_numeros_almacenes,*/
        ];

        if(isset($nosotros_banner)){
                $nombre_imagen = 'nosotros-banner.'.$nosotros_banner->getClientOriginalExtension();
                $nosotros_banner->move(public_path().'/upload/gral/',$nombre_imagen);
                $data['nosotros_banner'] = $nombre_imagen;    
        }

        if(isset($nosotros_imagen_video_historia)){
                $nombre_imagen = 'nosotros-imagen-video-historia.'.$nosotros_imagen_video_historia->getClientOriginalExtension();
                $nosotros_imagen_video_historia->move(public_path().'/upload/gral/',$nombre_imagen);
                $data['nosotros_imagen_video_historia'] = $nombre_imagen;    
        }
        if(isset($nosotros_imagen_lema)){
                $nombre_imagen = 'nosotros-imagen-lema.'.$nosotros_imagen_lema->getClientOriginalExtension();
                $nosotros_imagen_lema->move(public_path().'/upload/gral/',$nombre_imagen);
                $data['nosotros_imagen_lema'] = $nombre_imagen;    
        }


        $empresa = DatosGenerales::find(1);
        $empresa->fill($data)->save();
        $this->accion([\Auth::user()->id,'pagina_empresa',1,'editar','El usuario '.\Auth::user()->name.' edito la pagina de empresa']);
        return redirect()->route('inicio');
    }

    public function verInformacionGeneral(){
        $seccion = "Información general";
        $breadcrumb = [
            ['route' => 'empresa.informacion_general', 'nombre' => 'Información general']
        ]; 
        $empresa = DatosGenerales::find(1);
        return view('empresa.informacion_general',compact('seccion','breadcrumb','empresa'));
    }

    public function guardadInformacionGeneral(Request $request, $id){
        extract($request->all());
        $data = array();


        if (Gate::allows('permiso', 'editar_logotipos')) {
            if(isset($logotipo_general)){
                $nombre_imagen = 'general-'.preg_replace('#[ -]+#', '-', $logotipo_general->getClientOriginalName());
                $logotipo_general->move(public_path().'/upload/gral/',$nombre_imagen);
                $data['logotipo_general'] = $nombre_imagen;    
            }

            if(isset($imagen_footer)){
                $nombre_imagen = 'footer-'.preg_replace('#[ -]+#', '-', $imagen_footer->getClientOriginalName());
                $imagen_footer->move(public_path().'/upload/gral/',$nombre_imagen);
                $data['imagen_footer'] = $nombre_imagen;  
            }
            
        }

        if (Gate::allows('permiso', 'editar_redes_sociales')) {
            
            $data['url_facebook'] = $url_facebook;
            $data['url_instagram'] = $url_instagram;
            $data['url_twitter'] = $url_twitter;
            $data['url_youtube'] = $url_youtube;
            $data['url_pinterest'] = $url_pinterest;



            if(isset($icono_facebook)){
                $nombre_imagen = 'facebook-'.preg_replace('#[ -]+#', '-', $icono_facebook->getClientOriginalName());
                $icono_facebook->move(public_path().'/upload/gral/',$nombre_imagen);
                $data['icono_facebook'] = $nombre_imagen;    
            }
            if(isset($icono_instagram)){
                $nombre_imagen = 'instagram-'.preg_replace('#[ -]+#', '-', $icono_instagram->getClientOriginalName());
                $icono_instagram->move(public_path().'/upload/gral/',$nombre_imagen);
                $data['icono_instagram'] = $nombre_imagen;    
            }
            if(isset($icono_twitter)){
                $nombre_imagen = 'twitter-'.preg_replace('#[ -]+#', '-', $icono_twitter->getClientOriginalName());
                $icono_twitter->move(public_path().'/upload/gral/',$nombre_imagen);
                $data['icono_twitter'] = $nombre_imagen;    
            }
            if(isset($icono_youtube)){
                $nombre_imagen = 'youtube-'.preg_replace('#[ -]+#', '-', $icono_youtube->getClientOriginalName());
                $icono_youtube->move(public_path().'/upload/gral/',$nombre_imagen);
                $data['icono_youtube'] = $nombre_imagen;    
            }
            if(isset($icono_pinterest)){
                $nombre_imagen = 'pinterest-'.preg_replace('#[ -]+#', '-', $icono_pinterest->getClientOriginalName());
                $icono_pinterest->move(public_path().'/upload/gral/',$nombre_imagen);
                $data['icono_pinterest'] = $nombre_imagen;    
            }


            
        }

        if (Gate::allows('permiso', 'editar_emails'))
            $data['email_contacto'] = $email_contacto;        

        if (Gate::allows('permiso', 'editar_telefonos')) {
            $data['telefono_1'] =$telefono_1;  
            $data['marcar_1'] =$marcar_1;          
            $data['telefono_2'] =$telefono_2;
            $data['marcar_2'] =$marcar_2;  
            $data['telefono_1'] =$telefono_1;  
            $data['marcar_3'] =$marcar_3;
        }

        if (Gate::allows('permiso', 'editar_direccion')) {
            $data['direccion_1'] =$direccion_1;          
            $data['direccion_2'] =$direccion_2;
            $data['direccion_3'] =$direccion_3;
        }

     
            $data['horarios'] =$horarios;          
        

       

        $data['descripcion_footer'] = $descripcion_footer;

        
        $datos =  DatosGenerales::find(1);
        $datos->fill($data)->save();

        $this->accion([\Auth::user()->id,'informacion_general',1,'editar','El usuario '.\Auth::user()->name.' edito la informacion general de la empresa']);

        return redirect()->route('inicio');
    }

    public function verAvisoPrivacidad(){
        $seccion = "Aviso de privacidad";
        $breadcrumb = [
            ['route' => 'empresa.aviso_privacidad', 'nombre' => 'Aviso de privacidad']
        ]; 
        $empresa = DatosGenerales::find(1);
        return view('empresa.aviso_privacidad',compact('seccion','breadcrumb','empresa'));
    }

    public function guardadAvisoPrivacidad(Request $request, $id){
        extract($request->all());
        $data = ['aviso_privacidad' => $aviso_privacidad];
        $empresa = DatosGenerales::find(1);
        $empresa->fill($data)->save();
        $this->accion([\Auth::user()->id,'aviso_privacidad',1,'editar','El usuario '.\Auth::user()->name.' edito el aviso de privacidad']);
        return redirect()->route('inicio');
    }


    public function verTerminosUso(){
        $seccion = "Empresa";
        $breadcrumb = [
            ['route' => 'empresa.terminos_uso', 'nombre' => 'Terminos de uso']
        ]; 
        $empresa = DatosGenerales::find(1);
        return view('empresa.terminos_uso',compact('seccion','breadcrumb','empresa'));
    }

    public function guardadTerminosUso(Request $request, $id){
        extract($request->all());
        $data = ['terminos_uso' => $terminos_uso];
        $empresa = DatosGenerales::find(1);
        $empresa->fill($data)->save();
        $this->accion([\Auth::user()->id,'terminos_uso',1,'editar','El usuario '.\Auth::user()->name.' edito los terminos de uso']);
        return redirect()->route('inicio');
    }

    public function verPopUp(){
        $seccion = "Ventana emergente";
        $breadcrumb = [
            ['route' => 'empresa.pop_up', 'nombre' => 'Ventana emergente']
        ]; 
        $empresa = DatosGenerales::find(1);
        return view('empresa.pop_up',compact('seccion','breadcrumb','empresa'));
    }

    public function guardadPopUp(Request $request, $id){
        extract($request->all());

        $data = ['pop_up' => $pop_up,'habilitar_pop_up' => false];
        if(isset($habilitar_pop_up))
            $data['habilitar_pop_up'] = true;
        $empresa = DatosGenerales::find(1);
        $empresa->fill($data)->save();
        $this->accion([\Auth::user()->id,'pop_up',1,'editar','El usuario '.\Auth::user()->name.' edito la ventana emergente']);
        return redirect()->route('inicio');
    }


    public function verLog()
    {
        //
        if (Gate::denies('permiso', 'ver_log'))
            abort(404);
        $seccion = "Movimientos del sistema";
        $breadcrumb = [
            ['route' => 'movimientos_sistema.ver_log', 'nombre' => 'Ver log']
        ]; 
        return view('empresa.ver_log',compact('seccion','breadcrumb'));
    }

    public function dataAcciones(){
        return DataTables::of(MovimientosUsuarios::query()->orderBy('id','desc'))->make(true);
    }

     public function promociones(){
        $seccion = "Promociones";
        $breadcrumb = [
            ['route' => 'empresa.promociones', 'nombre' => 'Promociones']
        ]; 
        $empresa = DatosGenerales::find(1);
        return view('empresa.promociones',compact('seccion','breadcrumb','empresa'));
    }

    public function guardadPromociones(Request $request, $id){
        extract($request->all());

        $data = ['promociones' => $promociones];
       
        $empresa = DatosGenerales::find(1);
        $empresa->fill($data)->save();
        $this->accion([\Auth::user()->id,'promociones',1,'editar','El usuario '.\Auth::user()->name.' edito la seccion de promociones']);
        return redirect()->route('inicio');
    }



     public function notinikko(){
        $seccion = "Notinikko";
        $breadcrumb = [
            ['route' => 'empresa.notinikko', 'nombre' => 'Notinikko']
        ]; 
        $empresa = DatosGenerales::find(1);
        return view('empresa.notinikko',compact('seccion','breadcrumb','empresa'));
    }

    public function guardadNotinikko(Request $request, $id){
        extract($request->all());

        $data = ['notinikko' => $notinikko];
       
        $empresa = DatosGenerales::find(1);
        $empresa->fill($data)->save();
        $this->accion([\Auth::user()->id,'notinikko',1,'editar','El usuario '.\Auth::user()->name.' edito la seccion de notinikko']);
        return redirect()->route('inicio');
    }


   
}
