<?php

namespace Omise\Res\Obj;

use ArrayAccess;
use Countable;
use Iterator;

class OmiseObject implements ArrayAccess, Iterator, Countable
{
    // Store the attributes of the object.
    protected $_values = array();

    // Omise secret key.
    protected $_secretKey;

    // Omise public key.
    protected $_publicKey;

    /**
     * Setup the Omise object. If no secret and public are passed the one defined
     * in config.php will be used.
     *
     * @param string $publicKey
     * @param string $secretKey
     */
    protected function __construct($publicKey = null, $secretKey = null)
    {
        if ($publicKey !== null) {
            $this->_publicKey = $publicKey;
        } else {
            $this->_publicKey = OMISE_PUBLIC_KEY;
        }

        if ($secretKey !== null) {
            $this->_secretKey = $secretKey;
        } else {
            $this->_secretKey = OMISE_SECRET_KEY;
        }

        $this->_values = array();
    }

    /**
     * Reload the object.
     *
     * @param array $values
     * @param boolean $clear
     */
    public function refresh($values, $clear = false)
    {
        if ($clear) {
            $this->_values = array();
        }

        $this->_values = array_merge($this->_values, $values);
    }

    // Override methods of ArrayAccess
    public function offsetSet($key, $value)
    {
        $this->_values[$key] = $value;
    }

    public function offsetExists($key)
    {
        return isset($this->_values[$key]);
    }

    public function offsetUnset($key)
    {
        unset($this->_values[$key]);
    }

    public function offsetGet($key)
    {
        return isset($this->_values[$key]) ? $this->_values[$key] : null;
    }

    // Override methods of Iterator
    public function rewind()
    {
        reset($this->_values);
    }

    public function current()
    {
        return current($this->_values);
    }

    public function key()
    {
        return key($this->_values);
    }

    public function next()
    {
        return next($this->_values);
    }

    public function valid()
    {
        return ($this->current() !== false);
    }

    // Override methods of Countable
    public function count()
    {
        return count($this->_values);
    }
}
