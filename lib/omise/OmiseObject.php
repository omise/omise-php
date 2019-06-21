<?php
namespace Omise;

class OmiseObject implements \ArrayAccess
{
    /**
     * @var string  Of a given resource.
     */
    protected $id;

    /**
     * @var array|null
     */
    protected $attributes = array();

    public function __construct($values = array())
    {
        $this->refresh($values);

        if ($values['id']) {
            $this->setId($values['id']);
        }

        return $this;
    }

    /**
     * @param string $id  Of a given resource.
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param array $values
     */
    public function refresh($values)
    {
        $this->attributes = array_merge($this->attributes, $values);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return (array) $this->attributes;
    }

    /**
     * @return array
     */
    public function toJson()
    {
        return (string) json_encode($this->attributes);
    }

    /**
     * Override methods of ArrayAccess
     */
    public function offsetSet($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    /**
     * Override methods of ArrayAccess
     */
    public function offsetExists($key)
    {
        return isset($this->attributes[$key]);
    }

    /**
     * Override methods of ArrayAccess
     */
    public function offsetUnset($key)
    {
        unset($this->attributes[$key]);
    }

    /**
     * Override methods of ArrayAccess
     */
    public function offsetGet($key)
    {
        return isset($this->attributes[$key]) ? $this->attributes[$key] : null;
    }
}
