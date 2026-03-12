<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario')->unsigned()->nullable();
            $table->boolean('ver_usuarios')->nullable()->default(false);
            $table->boolean('agregar_usuarios')->nullable()->default(false);
            $table->boolean('editar_usuarios')->nullable()->default(false);
            $table->boolean('eliminar_usuarios')->nullable()->default(false);
            $table->boolean('ver_log')->nullable()->default(false);
            $table->boolean('editar_banner_principal')->nullable()->default(false);
            $table->boolean('ver_marcas')->nullable()->default(false);
            $table->boolean('agregar_marcas')->nullable()->default(false);
            $table->boolean('editar_marcas')->nullable()->default(false);
            $table->boolean('eliminar_marcas')->nullable()->default(false);
            $table->boolean('editar_empresa')->nullable()->default(false);
            $table->boolean('ver_productos')->nullable()->default(false);
            $table->boolean('agregar_productos')->nullable()->default(false);
            $table->boolean('editar_productos')->nullable()->default(false);
            $table->boolean('eliminar_productos')->nullable()->default(false);

            $table->boolean('ver_informacion_general')->nullable()->default(false);
            $table->boolean('editar_logotipos')->nullable()->default(false);
            $table->boolean('editar_redes_sociales')->nullable()->default(false);
            $table->boolean('editar_emails')->nullable()->default(false);
            $table->boolean('editar_telefonos')->nullable()->default(false);
            $table->boolean('editar_direccion')->nullable()->default(false);

            $table->boolean('editar_aviso_privacidad')->nullable()->default(false);
            $table->boolean('editar_terminos_uso')->nullable()->default(false);
            $table->boolean('editar_pop_up')->nullable()->default(false);

            $table->boolean('editar_pagina_inicio')->nullable()->default(false);
            $table->boolean('editar_soporte_tecnico')->nullable()->default(false);
            $table->boolean('editar_bolsa_trabajo')->nullable()->default(false);
            $table->boolean('editar_contacto')->nullable()->default(false);

            $table->boolean('ver_boletines')->nullable()->default(false);
            $table->boolean('agregar_boletines')->nullable()->default(false);
            $table->boolean('editar_boletines')->nullable()->default(false);
            $table->boolean('eliminar_boletines')->nullable()->default(false);

            $table->boolean('ver_publicaciones')->nullable()->default(false);
            $table->boolean('agregar_publicaciones')->nullable()->default(false);
            $table->boolean('editar_publicaciones')->nullable()->default(false);
            $table->boolean('eliminar_publicaciones')->nullable()->default(false);

            $table->boolean('ver_catalogos')->nullable()->default(false);
            $table->boolean('agregar_catalogos')->nullable()->default(false);
            $table->boolean('editar_catalogos')->nullable()->default(false);
            $table->boolean('eliminar_catalogos')->nullable()->default(false);

            $table->boolean('ver_usuarios_registrados_nuevos')->nullable()->default(false);
            $table->boolean('aceptar_usuarios_registrados_nuevos')->nullable()->default(false);
            $table->boolean('ver_usuarios_registrados_aceptados')->nullable()->default(false);
            $table->boolean('ver_usuarios_registrados_rechazados')->nullable()->default(false);

            $table->boolean('ver_promociones')->nullable()->default(false);
            $table->boolean('ver_notinikko')->nullable()->default(false);



            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permisos');
    }
}
