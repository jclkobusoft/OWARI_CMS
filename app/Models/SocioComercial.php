<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocioComercial extends Model
{
    //
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'socios_comerciales';

   	/**
   	 * Fields that can be mass assigned.
   	 *
   	 * @var array
   	 */
   	protected $fillable = [
   	  'nombre',
      'descripcion',
      'logo',
      'telefono_1',
      'telefono_2',
      'direccion_1',
      'direccion_2',
      'direccion_3',
      'pagina_web',
      'tags'
   	];
}
