<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Informate extends Model
{
    //
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'informate';

   	/**
   	 * Fields that can be mass assigned.
   	 *
   	 * @var array
   	 */
   	protected $fillable = [
   	  'titulo',
      'subtitulo',
      'contenido',
      'banner',
      'evento',
      'evento_nombre',
      'evento_fecha',
      'tags'
   	];
}
