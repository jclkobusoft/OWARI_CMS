<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Boletines extends Model
{
    //
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'boletines';


    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
            'nombre',
            'archivo',
            'archivo_real',
            'url',
            'portada',
            'tags',
            'fecha_publicacion',
            'descripcion',
            'ano',
            'marca'
    ];
}
