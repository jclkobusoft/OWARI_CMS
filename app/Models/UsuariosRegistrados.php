<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsuariosRegistrados extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'usuarios_registrados';

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'clave',
        'razon_social',
        'nombre',
        'email',
        'telefono',
        'password',
        'estado',
        'nota'
    ];  
}
