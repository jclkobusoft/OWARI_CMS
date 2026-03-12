<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarcasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marcas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 200)->nullable();
            $table->string('imagen', 500)->nullable();
            $table->string('tipo', 200)->nullable();
            
            
            $table->enum('redireccion', ['propia', 'enlace'])->nullable();
    
            $table->string('url', 1000)->nullable();
            $table->string('catalogo', 500)->nullable();
            
            
            $table->longText('contenido')->nullable();
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
        Schema::dropIfExists('marcas');
    }
}
