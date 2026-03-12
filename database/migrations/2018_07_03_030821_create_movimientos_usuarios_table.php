<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientosUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos_usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario')->unsigned()->nullable();
            $table->string('objeto', 250)->nullable();
            $table->integer('id_objeto')->unsigned()->nullable();
            $table->string('accion', 200)->nullable();
            $table->string('movimiento', 500)->nullable();
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
        Schema::dropIfExists('movimientos_usuarios');
    }
}
