<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentInterface;
use Elasticquent\ElasticquentTrait;

use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    //
	 use SoftDeletes;
   use ElasticquentTrait;
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
    	'sistema',
      'grupo',
      'subgrupo',
      'codigo',
      'codigo_alias',
      'descripcion',
      'primera_posicion',
      'segunda_posicion',
      'tercera_posicion',
      'caracteristicas',
      'referencia',
      'marca',
      'modelo',
      'version',
      'ano_inicio',
      'ano_final',
      'anos',
      'motor',
      'cilindros',
      'disposicion_cilindros',
      'distribucion',
      'valvulas',
      'observaciones_motor',
      'combustible',
      'sistema_inyeccion',
      'traccion',
      'caracteristicas_vehiculo',
      'observaciones',
      'nuevo',
      'vendido',
      'promocion',
      'precio_normal',
      'precio_final',
      'aplicaciones'
    ];
    

    protected $mappingProperties = array(
      'sistema' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'grupo' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'subgrupo' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'codigo' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'codigo_alias' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'descripcion' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'primera_posicion' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'segunda_posicion' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'tercera_posicion' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'caracteristicas' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'referencia' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'marca' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'modelo' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'version' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'ano_inicio' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'ano_final' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'anos' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'motor' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'cilindros' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'disposicion_cilindros' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'distribucion' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'valvulas' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'observaciones_motor' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'combustible' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'sistema_inyeccion' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'traccion' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'caracteristicas_vehiculo' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'observaciones' => [
        'type' => 'text',
        "analyzer" => "standard",
      ],
      'aplicaciones' => [
        'type' => 'text',
        "analyzer" => "standard",
      ]
  );

}
