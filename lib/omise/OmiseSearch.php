<?php

require_once dirname(__FILE__).'/res/OmiseApiResource.php';

/**
 * This class is not intended to be used directly from client code.
 *
 * Use Omise resource classes to begin searching:
 *
 *     $search = OmiseCharge::search('query');
 *
 *     foreach ($search['data'] as $result) {
 *         echo $result['object'];
 *     }
 *
 * @see OmiseCharge::search()
 * @see OmiseCustomer::search()
 * @see OmiseDispute::search()
 * @see OmiseLink::search()
 * @see OmiseRecipient::search()
 * @see OmiseRefund::search()
 * @see OmiseTransfer::search()
 */
class OmiseSearch extends OmiseApiResource
{
    const ENDPOINT = 'search';

    private $dirty = true;
    private $attributes = array();

    /**
     * Create an instance of `OmiseSearch` with the given scope.
     *
     * @param  string $scope  See supported scope at [Search API](https://www.omise.co/search-api) page.
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return  OmiseSearch  The created instance.
     */
    public static function scope($scope, $publickey = null, $secretkey = null)
    {
        return new OmiseSearch($scope, $publickey, $secretkey);
    }

    /**
     * Create an instance of `OmiseSearch` with the given scope.
     *
     * This constructor is `protected` thus not intended to be used directly.
     *
     * @param  string $scope  See supported scope at [Search API](https://www.omise.co/search-api) page.
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return  OmiseSearch  The created instance.
     */
    protected function __construct($scope, $publickey, $secretkey)
    {
        parent::__construct($publickey, $secretkey);
        $this->mergeAttributes('scope', $scope);
    }

    /**
     * Update `query` parameter.
     *
     * @param  string $query  Searching text within the scope.
     *
     * @return  OmiseSearch  This instance.
     */
    public function query($query)
    {
        return $this->mergeAttributes('query', $query);
    }

    /**
     * Update `filters` parameter.
     *
     * @param  string $filters  Searching text with specific key within the scope.
     *
     * @return  OmiseSearch  This instance.
     */
    public function filter(array $filters = array())
    {
        foreach ($filters as $k => $v) {
            if (is_bool($v)) {
                $filters[$k] = $v ? 'true' : 'false';
            }
        }
        return $this->mergeAttributes('filters', $filters);
    }

    /**
     * Update `page` parameter.
     *
     * @param  string $page  Specific number of searching page.
     *
     * @return  OmiseSearch  This instance.
     */
    public function page($page)
    {
        return $this->mergeAttributes('page', $page);
    }

    /**
     * Update `order` parameter.
     *
     * @param  string $order  The order of the list returned.
     *
     * @see https://www.omise.co/search-api
     *
     * @return  OmiseSearch  This instance.
     */
    public function order($order)
    {
        return $this->mergeAttributes('order', $order);
    }

    /**
     * Check whether this search instance is dirty or not.
     *
     * Dirty search instance needs to be retrieved before further usage. The
     * dirty search instance automatically retrieves its data when client code
     * tries to access its array element.
     *
     *     $search = OmiseCharge::query('demo'); // the instance is dirty
     *     echo $search['object'];               // this will automatically retrive remote value
     *
     * @return  bool  true if the instance is dirty and needs to be retrieved
     */
    public function isDirty() {
        return $this->dirty;
    }

    /**
     * Retrieve search data from Omise server.
     *
     * This method does nothing if the current instance is not dirty.
     *
     * @return  OmiseSearch  This instance.
     */
    public function retrieve()
    {
        if (!$this->dirty) {
            return;
        }

        $this->g_reload($this->getUrl());
        $this->dirty = false;
        return $this;
    }

    /**
     * Merge the given key and value to search attributes, and set instance state
     * as dirty.
     *
     * @param  string  $key  Search attribute key.
     * @param  mixed  $value  Search attribute value.
     */
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

    /*
     * (non-PHPdoc)
     *
     * @see  OmiseObject::offsetSet()
     */
    public function offsetSet($key, $value)
    {
        $this->retrieve();
        return parent::offsetSet($key, $value);
    }

    /*
     * (non-PHPdoc)
     *
     * @see  OmiseObject::offsetExists()
     */
    public function offsetExists($key)
    {
        $this->retrieve();
        return parent::offsetExists($key);
    }

    /*
     * (non-PHPdoc)
     *
     * @see  OmiseObject::offsetUnset()
     */
    public function offsetUnset($key)
    {
        $this->retrieve();
        return parent::offsetUnset($key);
    }

    /*
     * (non-PHPdoc)
     *
     * @see  OmiseObject::offsetGet()
     */
    public function offsetGet($key)
    {
        $this->retrieve();
        return parent::offsetGet($key);
    }
}
