<?php
namespace Omise\Res\Obj;

class OmiseObject implements \ArrayAccess, \Iterator, \Countable
{
    // Store the attributes of the object.
    protected $_values = array();

    // Omise secret key.
    protected $_secretkey;

    // Omise public key.
    protected $_publickey;

    /**
     * Setup the Omise object. If no secret and public are passed the one defined
     * in config.php will be used.
     */
    protected function __construct()
    {
        $this->_values    = array();
        $this->_publickey = \Omise\Omise::publicKey();
        $this->_secretkey = \Omise\Omise::secretKey();
    }

    /**
     * Reload the object.
     *
     * @param array   $values
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
