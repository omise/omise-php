<?php

class OmiseCapabilities extends OmiseApiResource
{
    const ENDPOINT = 'capability';

    const FILTERS = [
        'backend' => [ 'currency', 'type', 'chargeAmount' ]
    ];

    protected function __construct($publickey = null, $secretkey = null)
    {
        parent::__construct($publickey, $secretkey);
        $this->_setupFilterShortcuts();
    }

    /**
     * Sets up 'shortcuts' to filters so they may be used thus:
     *    $capabilities->backendFilter['currency']('THB')
     * As well as the original:
     *    $capabilities->makeBackendFilterCurrency('THB')
     */
    protected function _setupFilterShortcuts()
    {
        foreach (self::FILTERS as $filterSubject=>$availableFilters) {
            $filterArrayName = $filterSubject.'Filter';
            $this->$filterArrayName = [];
            $tempArr = &$this->$filterArrayName;
            foreach ($availableFilters as $type) {
                $funcName = "make".ucfirst($filterSubject).'Filter'.$type;
                $tempArr[$type] = function() use ($funcName) { return call_user_func_array([$this, $funcName], func_get_args()); };
            }
        }
    }

    /**
     * Retrieves capabilities.
     *
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseCapabilities
     */
    public static function retrieve($publickey = null, $secretkey = null)
    {
        return parent::g_retrieve(get_class(), self::getUrl(), $publickey, $secretkey);
    }

    /**
     * Retrieves array of payment backends. Optionally pass in as many filter functions as you want
     *
     * @param [function,...]
     *    
     * @return array
     */
    public function getBackends() {
        // check for filters
        if ($filters = func_get_args()) $filter = self::combineFilters($filters);
        $res = $this['payment_backends'];
        array_walk(
            $res,
            function($v, $k) use (&$res) {
                $id = array_keys($v)[0];
                $res[$k][$id]['_id'] = $id;
            }
        );
        $res = array_map(function($a) { return (object)reset($a);}, $res);
        return !empty($filter) ? array_filter($res, $filter) : $res;
    }

    /**
     * Makes a filter function to check supported currency for backend.
     *
     * @param  string $currency
     *
     * @return function
     */
    public function makeBackendFilterCurrency($currency) {
        return function($backend) use ($currency) { return in_array(strtoupper($currency), $backend->currencies); };
    }

    /**
     * Makes a filter function to check type of backend.
     *
     * @param  string $type
     *
     * @return function
     */
    public function makeBackendFilterType($type) {
        return function($backend) use ($type) { return $backend->type==$type; };
    }

    /**
     * Makes a filter function to check if backends can handle given amount.
     *
     * @param  int $amount
     *
     * @return function
     */
    public function makeBackendFilterChargeAmount($amount) {
        $defMin = $this['limits']['charge_amount']['min'];
        $defMax = $this['limits']['charge_amount']['max'];
        return function($backend) use ($amount, $defMin, $defMax) {
            // temporary hack for now to correct min value for instalments to 500000
            if ($backend->type == 'installment') {
                $min = 500000;
            } else {
                $min = empty($backend->amount['min']) ? $defMin : $backend->amount['min'];
            }
            $max = empty($backend->amount['max']) ? $defMax : $backend->amount['max'];
            return $amount >= $min && $amount <= $max;
        };
    }

    /**
     * Combines boolean filters.
     *
     * @param  [functions] $filters
     *
     * @return function
     */
    public static function combineFilters($filters) {
        return function($a) use ($filters) {
            foreach ($filters as $filter) if (!$filter($a)) return false;
            return true;
        };
    }

    /**
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::g_reload()
     */
    public function reload()
    {
        parent::g_reload(self::getUrl());
    }

    /**
     * @return string
     */
    private static function getUrl()
    {
        return OMISE_API_URL.self::ENDPOINT;
    }

    /**
     * Checks if response from API was valid.
     *
     * @param  array  $array  - decoded JSON response
     * 
     * @return boolean
     */
    protected function isValidAPIResponse($array)
    {
        return count($array);
    }

    /**
     * Returns the public key.
     *
     * @return string
     */
    protected function getResourceKey()
    {
        return $this->_publickey;
    }
}
