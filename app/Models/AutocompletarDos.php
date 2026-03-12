<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AutocompletarDos extends Model
{
    //

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'autocompletar_dos';

   	/**
   	 * Fields that can be mass assigned.
   	 *
   	 * @var array
   	 */
   	protected $fillable = [
      'texto'
   	];
}
