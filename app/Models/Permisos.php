<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permisos extends Model
{
    //
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permisos';

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
    	'id_usuario',
		'ver_usuarios',
		'agregar_usuarios',
		'editar_usuarios',
		'eliminar_usuarios',
        'ver_log',
        'editar_banner_principal',
		'ver_marcas',
		'agregar_marcas',
		'editar_marcas',
		'eliminar_marcas',
		'ver_productos',
		'agregar_productos',
		'editar_productos',
		'eliminar_productos',
        'editar_empresa',
        'ver_informacion_general',
        'editar_logotipos',
        'editar_redes_sociales',
        'editar_emails',
        'editar_telefonos',
        'editar_direccion',
        'editar_aviso_privacidad',
        'editar_terminos_uso',
        'editar_aviso_privacidad',
        'editar_terminos_uso',
        'editar_pop_up',
        'editar_pagina_inicio',
        'editar_soporte_tecnico',
        'editar_bolsa_trabajo',
        'editar_contacto',
        'ver_boletines',
        'agregar_boletines',
        'editar_boletines',
        'eliminar_boletines',
        'ver_publicaciones',
        'agregar_publicaciones',
        'editar_publicaciones',
        'eliminar_publicaciones',
        'ver_catalogos',
        'agregar_catalogos',
        'editar_catalogos',
        'eliminar_catalogos',
        'ver_usuarios_registrados_nuevos',
        'aceptar_usuarios_registrados_nuevos',
        'ver_usuarios_registrados_aceptados',
        'ver_usuarios_registrados_rechazados',
        'ver_promociones',
        'ver_notinikko',
        'editar_color_general'
    ];
}
