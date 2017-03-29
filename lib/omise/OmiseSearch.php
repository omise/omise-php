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

    private $_dirty = true;
    private $_scope = null;
    private $_query = '';
    private $_conditions = array();
    private $_page = 1;
    private $_order = 'chronological';

    public static function scope($scope)
    {
        return new OmiseSearch($scope);
    }

    protected function __construct($scope, $publickey = null, $secretkey = null)
    {
        parent::__construct($publickey, $secretkey);
        $this->_dirty = true;
        $this->_scope = $scope;
    }

    public function query($query)
    {
        $this->_dirty = true;
        $this->_query = $query;
        return $this;
    }

    public function where(array $conditions = array())
    {
        $this->_dirty = true;
        $this->_conditions = $conditions;
        return $this;
    }

    public function page($page)
    {
        $this->_dirty = true;
        $this->_page = $page;
        return $this;
    }

    public function order($order)
    {
        if (!in_array($order, array('chronological', 'reverse_chronological'))) {
            throw new InvalidArgumentException();
        }
        $this->_dirty = true;
        $this->_order = $order;
        return $this;
    }

    public function retrieve()
    {
        if (!$this->_dirty) {
            return;
        }

        $this->g_reload($this->getUrl());
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
        $querybuild = array('scope' => $this->_scope);

        if (strlen($this->_query) > 0) {
            $querybuild['query'] = $this->_query;
        }

        foreach ($this->_conditions as $key => $value) {
            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }
            $querybuild['filters['.$key.']'] = $value;
        }

        if ($this->_page != 1) {
            $querybuild['page'] = $this->_page;
        }

        if ($this->_order != 'chronological') {
            $querybuild['chronological'] = $this->_order;
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
