<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosGeneralesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_generales', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('contenido_empresa')->nullable();
            $table->string('logotipo_general', 500)->nullable();
            $table->string('logotipo_email', 500)->nullable();
            $table->string('icono_facebook', 500)->nullable();
            $table->mediumText('url_facebook')->nullable();
            $table->string('icono_instagram', 500)->nullable();
            $table->mediumText('url_instagram')->nullable();
            $table->string('icono_twitter', 500)->nullable();
            $table->mediumText('url_twitter')->nullable();
            $table->string('icono_youtube', 500)->nullable();
            $table->mediumText('url_youtube')->nullable();
            $table->string('icono_pinterest', 500)->nullable();
            $table->mediumText('url_pinterest')->nullable();
            $table->string('email_contacto', 500)->nullable();
            $table->string('telefono_1', 500)->nullable();
            $table->string('telefono_2', 500)->nullable();
            $table->string('telefono_3', 500)->nullable();
            $table->string('direccion_1', 500)->nullable();
            $table->string('direccion_2', 500)->nullable();
            $table->string('direccion_3', 500)->nullable();
            $table->longText('aviso_privacidad')->nullable();
            $table->longText('terminos_uso')->nullable();
            $table->boolean('habilitar_pop_up')->nullable()->default(false);
            $table->longText('pop_up')->nullable();
            $table->longText('inicio_adicional_arriba')->nullable();
            $table->boolean('habilitar_nuevos_lanzamientos')->nullable()->default(false);
            $table->boolean('habilitar_mas_vendido')->nullable()->default(false);
            $table->boolean('habilitar_promociones')->nullable()->default(false);
            $table->boolean('habilitar_notinikko')->nullable()->default(false);
            $table->boolean('habilitar_boletines')->nullable()->default(false);
            $table->longText('inicio_adicional_abajo')->nullable();
            $table->longText('soporte_boletines')->nullable();
            $table->longText('soporte_videos')->nullable();
            $table->longText('soporte_buzon')->nullable();
            $table->string('soporte_buzon_email', 500)->nullable();
            $table->boolean('soporte_habilitar_chat')->nullable()->default(false);
            $table->longText('bolsa_trabajo')->nullable();
            $table->string('bolsa_trabajo_email', 500)->nullable();

            $table->string('contacto_telefono_1', 100)->nullable();
            $table->string('contacto_telefono_2', 100)->nullable();
            $table->string('contacto_telefono_3', 100)->nullable();
            $table->string('contacto_direccion_1', 100)->nullable();
            $table->string('contacto_direccion_2', 100)->nullable();
            $table->string('contacto_direccion_3', 100)->nullable();
            $table->string('contacto_email_1', 100)->nullable();
            $table->string('contacto_email_2', 100)->nullable();
            $table->string('contacto_email_3', 100)->nullable();
            $table->string('contacto_horario_1', 100)->nullable();
            $table->string('contacto_horario_2', 100)->nullable();
            $table->string('contacto_horario_3', 100)->nullable();

            $table->string('contacto_latitud_marcador', 100)->nullable();
            $table->string('contacto_longitud_marcador', 100)->nullable();
            $table->string('contacto_latitud_centrado', 100)->nullable();
            $table->string('contacto_longitud_centrado', 100)->nullable();
            $table->string('contacto_zoom_centrado', 100)->nullable();
            
            $table->string('contacto_email_envio', 500)->nullable();


            $table->longText('promociones')->nullable();
            $table->longText('notinikko')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datos_generales');
    }
}
