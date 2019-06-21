<?php
namespace Omise;

use Omise\Resource;

class Collection implements \Countable
{
    /**
     * @var string  Of a collection name.
     */
    protected $collection;

    /**
     * @var array
     */
    protected $attributes = array();

    /**
     * @var array
     */
    protected $items = array();

    public function __construct($items)
    {
        $this->mapAttribute($items);

        foreach ($items['data'] as $key => $value) {
            $this->items[$key] = Resource::newObject($value['object'], $value);
        }

        $this->collection = $this->first()['object'];
    }

    /**
     * @return Omise\Object  In a first position of an array ($items).
     */
    public function first()
    {
        return $this->items[0];
    }

    /**
     * @implements \Countable
     *
     * @return     int
     */
    public function count()
    {
        return $this->attributes['total'];
    }

    protected function mapAttribute($items)
    {
        $this->attributes = array(
            'from'     => $items['from'],
            'to'       => $items['to'],
            'offset'   => $items['offset'],
            'limit'    => $items['limit'],
            'total'    => $items['total'],
            'order'    => $items['order'],
            'location' => $items['location'],
        );
    }
}
