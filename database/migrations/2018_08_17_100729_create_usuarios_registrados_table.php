<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosRegistradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_registrados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clave', 100)->nullable();
            $table->string('razon_social', 100)->nullable();
            $table->string('nombre', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('telefono', 100)->nullable();
            $table->string('password', 100)->nullable();
            $table->enum('estado', ['nuevo', 'aprobado', 'rechazado'])->nullable()->default('nuevo');
            $table->string('nota', 300)->nullable();

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
        Schema::dropIfExists('usuarios_registrados');
    }
}
