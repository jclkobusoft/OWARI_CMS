<?php

namespace App\Models;

/**
 * Wrapper para resultados de DB::select() que soporta acceso como objeto ($r->campo)
 * y como array ($r['campo']), igual que los modelos Eloquent.
 * Necesario porque las vistas Blade mezclan ambos estilos de acceso.
 */
class SomaResult implements \ArrayAccess, \JsonSerializable
{
    protected $attributes = [];

    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function __get($key)
    {
        return $this->attributes[$key] ?? null;
    }

    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function __isset($key)
    {
        return isset($this->attributes[$key]);
    }

    #[\ReturnTypeWillChange]
    public function offsetExists($offset)
    {
        return isset($this->attributes[$offset]);
    }

    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->attributes[$offset] ?? null;
    }

    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
        $this->attributes[$offset] = $value;
    }

    #[\ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
        unset($this->attributes[$offset]);
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this->attributes;
    }

    public function toArray()
    {
        return $this->attributes;
    }
}
