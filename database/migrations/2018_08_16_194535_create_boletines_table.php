<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoletinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boletines', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('nombre', 200)->nullable();
            $table->string('portada', 200)->nullable();
            $table->string('archivo', 200)->nullable();
            $table->string('archivo_real', 200)->nullable();
            $table->string('url', 500)->nullable();

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
        Schema::dropIfExists('boletines');
    }
}
