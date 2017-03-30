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
    private $scope = null;
    private $query = '';
    private $filters = array();
    private $page = null;
    private $order = null;

    public static function scope($scope)
    {
        return new OmiseSearch($scope);
    }

    protected function __construct($scope, $publickey = null, $secretkey = null)
    {
        parent::__construct($publickey, $secretkey);
        $this->dirty = true;
        $this->scope = $scope;
    }

    public function query($query)
    {
        $this->dirty = true;
        $this->query = $query;
        return $this;
    }

    public function filter(array $filters = array())
    {
        $this->dirty = true;
        $this->filters = $filters;
        return $this;
    }

    public function page($page)
    {
        $this->dirty = true;
        $this->page = $page;
        return $this;
    }

    public function order($order)
    {
        $this->dirty = true;
        $this->order = $order;
        return $this;
    }

    public function retrieve()
    {
        if (!$this->dirty) {
            return;
        }

        $this->g_reload($this->getUrl());
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
        $querybuild = array('scope' => $this->scope);

        if (strlen($this->query) > 0) {
            $querybuild['query'] = $this->query;
        }

        foreach ($this->filters as $key => $value) {
            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }
            $querybuild['filters['.$key.']'] = $value;
        }

        if ($this->page != null) {
            $querybuild['page'] = $this->page;
        }

        if ($this->order != null) {
            $querybuild['chronological'] = $this->order;
        }

        $querystring = http_build_query($querybuild);

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
