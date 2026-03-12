<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name'       => 'admin',
            'email'      => 'hola@kobusoft.com',
            'password'   => \Hash::make('12345'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('permisos')->insert([
        'id_usuario'                          => 1,
        'ver_usuarios'                        => 1,
        'agregar_usuarios'                    => 1,
        'editar_usuarios'                     => 1,
        'eliminar_usuarios'                   => 1,
        'ver_log'                             => 1,
        'editar_banner_principal'             => 1,
        'ver_marcas'                          => 1,
        'agregar_marcas'                      => 1,
        'editar_marcas'                       => 1,
        'eliminar_marcas'                     => 1,
        'ver_productos'                       => 1,
        'agregar_productos'                   => 1,
        'editar_productos'                    => 1,
        'eliminar_productos'                  => 1,
        'editar_empresa'                      => 1,
        'ver_informacion_general'             => 1,
        'editar_logotipos'                    => 1,
        'editar_redes_sociales'               => 1,
        'editar_emails'                       => 1,
        'editar_telefonos'                    => 1,
        'editar_direccion'                    => 1,
        'editar_aviso_privacidad'             => 1,
        'editar_terminos_uso'                 => 1,
        'editar_pop_up'                       => 1,
        'editar_pagina_inicio'                => 1,
        'editar_soporte_tecnico'              => 1,
        'editar_bolsa_trabajo'                => 1,
        'editar_contacto'                     => 1,
        'ver_boletines'                       => 1,
        'agregar_boletines'                   => 1,
        'editar_boletines'                    => 1,
        'eliminar_boletines'                  => 1,
        'ver_publicaciones'                   => 1,
        'agregar_publicaciones'               => 1,
        'editar_publicaciones'                => 1,
        'eliminar_publicaciones'              => 1,
        'ver_catalogos'                       => 1,
        'agregar_catalogos'                   => 1,
        'editar_catalogos'                    => 1,
        'eliminar_catalogos'                  => 1,
        'ver_usuarios_registrados_nuevos'     => 1,
        'aceptar_usuarios_registrados_nuevos' => 1,
        'ver_usuarios_registrados_aceptados'  => 1,
        'ver_usuarios_registrados_rechazados' => 1,
        'ver_promociones'                     => 1,
        'ver_notinikko'                       => 1
        ]);

    
    }
}
