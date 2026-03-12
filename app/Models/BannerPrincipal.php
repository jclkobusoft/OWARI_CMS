<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannerPrincipal extends Model
{
    //

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'banner_principal';

   	/**
   	 * Fields that can be mass assigned.
   	 *
   	 * @var array
   	 */
   	protected $fillable = [
      'imagen',
      'url',
      'ordenamiento',
      'fecha_inicio',
      'fecha_fin'
   	];
}
