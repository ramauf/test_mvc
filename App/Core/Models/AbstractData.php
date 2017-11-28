<?php
namespace App\Core\Models;

use App\Core\DB;

abstract class AbstractData implements \ArrayAccess
{
    protected $fields = [];
    protected $data = [];
    protected $table = '';

    public function __construct()
    {
        $this->init();
    }

    final public function __get($key)
    {
        if ($this->offsetExists($key)) {
            return $this->offsetGet($key);
        }
    }

    final public function __set($key, $value)
    {
        if ($this->offsetExists($key)) {
            $this->offsetSet( $key, $value );
        }
    }

    final public function offsetExists($key)
    {
        return array_key_exists($key, $this->data);
    }

    final public function offsetGet($key)
    {
        if (array_key_exists($key, $this->data))
            return $this->data[$key]['value'];
        return null;
    }

    final public function offsetSet($key, $value)
    {
        if (array_key_exists($key, $this->data))
            $this->data[$key]['value'] = $value;
    }

    final public function offsetUnset($key)
    {
        if (array_key_exists($key, $this->data))
            $this->data[$key]['value'] = null;
    }

    final public function begin()
    {
        DB::begin();
    }

    final public function commit()
    {
        DB::commit();
    }

    final public function rollback()
    {
        DB::rollback();
    }

    public function init(){}
}
