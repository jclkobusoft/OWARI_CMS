<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    //

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'marcas';

   	/**
   	 * Fields that can be mass assigned.
   	 *
   	 * @var array
   	 */
   	protected $fillable = [
   	  'nombre',
      'imagen',
      'tipo',
      'redireccion',
      'url',
      'catalogo',
      'contenido',
      'descripcion_breve',
      'banner',
      'titulo_principal',
      'ordenamiento'
   	];
}
