<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DatosGenerales;

class PaginasController extends Controller
{
    //
    //
    //
    public function inicio(){
        $seccion = "Página inicio";
        $breadcrumb = [
            ['route' => 'paginas.inicio', 'nombre' => 'Página inicio']
        ]; 
        $pagina = DatosGenerales::find(1);
        return view('paginas.inicio',compact('seccion','breadcrumb','pagina'));
    }

    public function guardarPaginaInicio(Request $request,$id){
            
        extract($request->all());

        $data = [
        
            //'inicio_adicional_arriba'       => $inicio_adicional_arriba,
            'habilitar_nuevos_lanzamientos' => 0,
            'habilitar_mas_vendido'         => 0,
            'habilitar_promociones'         => 0,
            'habilitar_notinikko'           => 0,
            'habilitar_boletines'           => 0,
            //'inicio_adicional_abajo'        => $inicio_adicional_abajo,
            'titulo_bienvenida'             => $titulo_bienvenida,
            'subtitulo_bienvenida'          => $subtitulo_bienvenida,
            'texto_bienvenida'              => $texto_bienvenida,
            
            'titulo_marcas'                 => $titulo_marcas,
            'texto_marcas'                  => $texto_marcas,
            'titulo_boletines'              => $titulo_boletines,
            'texto_boletines'               => $texto_boletines,
            'titulo_catalogos'              => $titulo_catalogos,
            'texto_catalogos'               => $texto_catalogos,
            'titulo_productos'              => $titulo_productos,
            'texto_productos'               => $texto_productos

        ];

        if(isset($habilitar_nuevos_lanzamientos))
            $data['habilitar_nuevos_lanzamientos'] = $habilitar_nuevos_lanzamientos;
        if(isset($habilitar_mas_vendido))
            $data['habilitar_mas_vendido'] = $habilitar_mas_vendido;
        if(isset($habilitar_promociones))
            $data['habilitar_promociones'] = $habilitar_promociones;
        if(isset($habilitar_notinikko))
            $data['habilitar_notinikko'] = $habilitar_notinikko;
        if(isset($habilitar_boletines))
            $data['habilitar_boletines'] = $habilitar_boletines;

        if(isset($imagen_bienvenida)){
            $nombre_imagen = 'imagen-bienvenida.'.$imagen_bienvenida->getClientOriginalExtension();
            $imagen_bienvenida->move(public_path().'/upload/gral/',$nombre_imagen);
            $data['imagen_bienvenida'] = $nombre_imagen;    
        }

        /*if(isset($imagen_conviertete_distribuidor)){
            $nombre_imagen = 'imagen-conviertete-distribuidor.'.$imagen_conviertete_distribuidor->getClientOriginalExtension();
            $imagen_conviertete_distribuidor->move(public_path().'/upload/gral/',$nombre_imagen);
            $data['imagen_conviertete_distribuidor'] = $nombre_imagen;    
        }*/


        $pagina = DatosGenerales::find(1);
        $pagina->fill($data)->save();


         (new SistemaController)->accion([\Auth::user()->id,'pagina_inicio',1,'editar','El usuario '.\Auth::user()->name.' edito la pagina de inicio']);

         return redirect()->route('inicio');

    }


    public function soporteTecnico(){
        $seccion = "Página soporte tecnico";
        $breadcrumb = [
            ['route' => 'paginas.soporte_tecnico', 'nombre' => 'Página soporte tecnico']
        ]; 
        $pagina = DatosGenerales::find(1);
        return view('paginas.soporte_tecnico',compact('seccion','breadcrumb','pagina'));
    }

    public function guardarSoporteTecnico(Request $request,$id){
            
        extract($request->all());

        $data = [
            'soporte_boletines' => $soporte_boletines,
            'soporte_videos'    => $soporte_videos,
            'soporte_buzon'  => $soporte_buzon,
            'soporte_buzon_email'  => $soporte_buzon_email,
            'soporte_habilitar_chat'  => false
        ];

        if(isset($soporte_habilitar_chat))
            $data['soporte_habilitar_chat'] = true;

        $pagina = DatosGenerales::find(1);
        $pagina->fill($data)->save();


         (new SistemaController)->accion([\Auth::user()->id,'pagina_soporte',1,'editar','El usuario '.\Auth::user()->name.' edito las paginas de soporte tecnico']);

         return redirect()->route('inicio');

    }


    public function bolsaTrabajo(){
        $seccion = "Página bolsa de trabajo";
        $breadcrumb = [
            ['route' => 'paginas.bolsa_trabajo', 'nombre' => 'Página bolsa de trabajo']
        ]; 
        $pagina = DatosGenerales::find(1);
        return view('paginas.bolsa_trabajo',compact('seccion','breadcrumb','pagina'));
    }

    public function guardarBolsaTrabajo(Request $request,$id){
            
        extract($request->all());

        $data = [
            'bolsa_trabajo' => $bolsa_trabajo,
            'bolsa_trabajo_email'    => $bolsa_trabajo_email
        ];

        $pagina = DatosGenerales::find(1);
        $pagina->fill($data)->save();


         (new SistemaController)->accion([\Auth::user()->id,'pagina_bolsa_trabajo',1,'editar','El usuario '.\Auth::user()->name.' edito la pagina de bolsa de trabajo']);

         return redirect()->route('inicio');

    }

    public function contacto(){
        $seccion = "Página de contacto";
        $breadcrumb = [
            ['route' => 'paginas.contacto', 'nombre' => 'Página de contacto']
        ]; 
        $pagina = DatosGenerales::find(1);
        return view('paginas.contacto',compact('seccion','breadcrumb','pagina'));
    }

    public function guardarContacto(Request $request,$id){
            
        extract($request->all());

        $data = [
            'contacto_telefono_1'        => $contacto_telefono_1,
            'contacto_telefono_2'        => $contacto_telefono_2,
            'contacto_telefono_3'        => $contacto_telefono_3,
            'contacto_direccion_1'       => $contacto_direccion_1,
            'contacto_direccion_2'       => $contacto_direccion_2,
            'contacto_direccion_3'       => $contacto_direccion_3,
            'contacto_email_1'           => $contacto_email_1,
            'contacto_email_2'           => $contacto_email_2,
            'contacto_email_3'           => $contacto_email_3,
            'contacto_horario_1'         => $contacto_horario_1,
            'contacto_horario_2'         => $contacto_horario_2,
            'contacto_horario_3'         => $contacto_horario_3,
            'contacto_latitud_marcador'  => $contacto_latitud_marcador,
            'contacto_longitud_marcador' => $contacto_longitud_marcador,
            'contacto_latitud_centrado'  => $contacto_latitud_centrado,
            'contacto_longitud_centrado' => $contacto_longitud_centrado,
            'contacto_zoom_centrado' => $contacto_zoom_centrado,
            'contacto_email_envio'       => $contacto_email_envio,
        ];

        $pagina = DatosGenerales::find(1);
        $pagina->fill($data)->save();

         (new SistemaController)->accion([\Auth::user()->id,'pagina_contacto',1,'editar','El usuario '.\Auth::user()->name.' edito la pagina de contacto']);
         return redirect()->route('inicio');

    }

    


}
