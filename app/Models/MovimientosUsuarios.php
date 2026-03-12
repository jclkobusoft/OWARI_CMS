<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MovimientosUsuarios extends Model
{
    //
    use SoftDeletes;

	/**
	     * The database table used by the model.
	     *
	     * @var string
	     */
	    protected $table = 'movimientos_usuarios';    

	    /**
	     * Fields that can be mass assigned.
	     *
	     * @var array
	     */
	    protected $fillable = [
	    	'id_usuario',
			'objeto',
			'id_objeto',
			'accion',
			'movimiento'
	    ];	
}
