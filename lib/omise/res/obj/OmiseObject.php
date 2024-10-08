<?php

/** @phpstan-consistent-constructor */
class OmiseObject implements ArrayAccess, Iterator, Countable
{
    // Store the attributes of the object.
    protected $_values = [];

    // Omise secret key.
    protected $_secretkey;

    // Omise public key.
    protected $_publickey;

    /**
     * Setup the Omise object. If no secret and public are passed the one defined
     * in config.php will be used.
     *
     * @param string $publickey
     * @param string $secretkey
     */
    protected function __construct($publickey = null, $secretkey = null)
    {
        $this->setPublicKey($publickey);
        $this->setSecretKey($secretkey);
        $this->_values = [];
    }

    protected function setPublicKey($publickey)
    {
        if ($publickey !== null) {
            $this->_publickey = $publickey;
        } else {
            if (!defined('OMISE_PUBLIC_KEY')) {
                throw new Exception('OMISE_PUBLIC_KEY value is undefined. This is required for authentication');
            }
            $this->_publickey = OMISE_PUBLIC_KEY;
        }
    }

    protected function setSecretKey($secretkey)
    {
        if ($secretkey !== null) {
            $this->_secretkey = $secretkey;
        } else {
            if (!defined('OMISE_SECRET_KEY')) {
                throw new Exception('OMISE_SECRET_KEY value is undefined. This is required for authentication');
            }
            $this->_secretkey = OMISE_SECRET_KEY;
        }
    }

    /**
     * Reload the object.
     *
     * @param array   $values
     * @param boolean $clear
     */
    #[\ReturnTypeWillChange]
    public function refresh($values, $clear = false)
    {
        if ($clear) {
            $this->_values = [];
        }

        $this->_values = $this->_values ?: [];
        $values = $values ?: [];

        $this->_values = array_merge($this->_values, $values);
    }

    // Override methods of ArrayAccess
    #[\ReturnTypeWillChange]
    public function offsetSet($key, $value)
    {
        $this->_values[$key] = $value;
    }

    #[\ReturnTypeWillChange]
    public function offsetExists($key)
    {
        return isset($this->_values[$key]);
    }

    #[\ReturnTypeWillChange]
    public function offsetUnset($key)
    {
        unset($this->_values[$key]);
    }

    #[\ReturnTypeWillChange]
    public function offsetGet($key)
    {
        return isset($this->_values[$key]) ? $this->_values[$key] : null;
    }

    // Override methods of Iterator
    #[\ReturnTypeWillChange]
    public function rewind()
    {
        reset($this->_values);
    }

    #[\ReturnTypeWillChange]
    public function current()
    {
        return current($this->_values);
    }

    #[\ReturnTypeWillChange]
    public function key()
    {
        return key($this->_values);
    }

    #[\ReturnTypeWillChange]
    public function next()
    {
        return next($this->_values);
    }

    #[\ReturnTypeWillChange]
    public function valid()
    {
        return ($this->current() !== false);
    }

    // Override methods of Countable
    #[\ReturnTypeWillChange]
    public function count()
    {
        return count($this->_values);
    }

    #[\ReturnTypeWillChange]
    public function toArray()
    {
        return $this->_values;
    }
}
