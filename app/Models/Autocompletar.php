<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Autocompletar extends Model
{
    //

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'autocompletar';

   	/**
   	 * Fields that can be mass assigned.
   	 *
   	 * @var array
   	 */
   	protected $fillable = [
      'texto'
   	];
}
