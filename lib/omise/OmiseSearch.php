<?php

require_once dirname(__FILE__).'/res/OmiseApiResource.php';

/**
 * This class is not intended to be used directly from client code.
 *
 * @see OmiseCharge::search()
 */
class OmiseSearch extends OmiseApiResource
{
    const ENDPOINT = 'search';

    private $dirty = true;
    private $attributes = array();

    public static function scope($scope, $publickey = null, $secretkey = null)
    {
        return new OmiseSearch($scope, $publickey, $secretkey);
    }

    protected function __construct($scope, $publickey, $secretkey)
    {
        parent::__construct($publickey, $secretkey);
        $this->mergeAttributes('scope', $scope);
    }

    public function query($query)
    {
        return $this->mergeAttributes('query', $query);
    }

    public function filter(array $filters = array())
    {
        foreach ($filters as $k => $v) {
            if (is_bool($v)) {
                $filters[$k] = $v ? 'true' : 'false';
            }
        }
        return $this->mergeAttributes('filters', $filters);
    }

    public function page($page)
    {
        return $this->mergeAttributes('page', $page);
    }

    public function order($order)
    {
        return $this->mergeAttributes('order', $order);
    }

    public function isDirty() {
        return $this->dirty;
    }

    public function retrieve()
    {
        if (!$this->dirty) {
            return;
        }

        $this->g_reload($this->getUrl());
        $this->dirty = false;
        return $this;
    }

    private function mergeAttributes($key, $value)
    {
        $this->dirty = true;
        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * Generate request url.
     *
     * @param  string $querystring
     *
     * @return string
     */
    private function getUrl()
    {
        $querystring = http_build_query($this->attributes);
        return OMISE_API_URL.self::ENDPOINT.'/?'.$querystring;
    }

    // Override methods of ArrayAccess
    public function offsetSet($key, $value)
    {
        $this->retrieve();
        return parent::offsetSet($key, $value);
    }

    public function offsetExists($key)
    {
        $this->retrieve();
        return parent::offsetExists($key);
    }

    public function offsetUnset($key)
    {
        $this->retrieve();
        return parent::offsetUnset($key);
    }

    public function offsetGet($key)
    {
        $this->retrieve();
        return parent::offsetGet($key);
    }
}
