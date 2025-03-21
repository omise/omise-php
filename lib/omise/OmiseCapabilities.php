<?php

class OmiseCapabilities extends OmiseApiResource
{
    const ENDPOINT = 'capability';

    /**
     * @var array  of the filterable keys.
     */
    public static $filters = [
        'backend' => ['currency', 'exactName', 'name', 'chargeAmount']
    ];

    public function __construct($publickey = null, $secretkey = null)
    {
        parent::__construct($publickey, $secretkey);
        $this->setupFilterShortcuts();
    }

    /**
     * Sets up 'shortcuts' to filters so they may be used thus:
     *    $capabilities->backendFilter['currency']('THB')
     * As well as the original:
     *    $capabilities->makeBackendFilterCurrency('THB')
     */
    protected function setupFilterShortcuts()
    {
        foreach (self::$filters as $filterSubject => $availableFilters) {
            $filterArrayName = $filterSubject . 'Filter';
            $this->$filterArrayName = [];
            $tempArr = &$this->$filterArrayName;
            foreach ($availableFilters as $type) {
                $funcName = 'make' . ucfirst($filterSubject) . 'Filter' . $type;
                $tempArr[$type] = function () use ($funcName) {
                    return call_user_func_array([$this, $funcName], func_get_args());
                };
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
        return parent::g_retrieve(self::getUrl(), $publickey, $secretkey);
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
     * Retrieves array of payment backends. Optionally pass in as many filter functions as you want
     * (muliple arguments, or a single array)
     *
     * @param [func1,fun2,...] OR func1, func2,...
     *
     * @return array
     */
    public function getBackends()
    {
        $backends = array_map(function ($backend) {
            return (object) $backend;
        }, $this['payment_methods']);

        return ($filters = func_get_args()) ? array_filter($backends, self::combineFilters(self::argsToVariadic($filters))) : $backends;
    }

    /**
     * Makes a filter function to check supported currency for backend.
     *
     * @param  string $currency
     *
     * @return function
     */
    public function makeBackendFilterCurrency($currency)
    {
        return function ($backend) use ($currency) {
            return in_array(strtolower($currency), array_map('strtolower', $backend->currencies));
        };
    }

    /**
     * Makes a filter function to check exact name of backend.
     *
     * @param  string $type
     *
     * @return function
     */
    public function makeBackendFilterExactName($name)
    {
        return function ($backend) use ($name) {
            return $backend->name === $name;
        };
    }

    /**
     * Makes a filter function to check name of backend.
     *
     * @param  string $type
     *
     * @return function
     */
    public function makeBackendFilterName($name)
    {
        return function ($backend) use ($name) {
            return strpos($backend->name, $name) !== false;
        };
    }

    /**
     * Makes a filter function to check if backends can handle given amount.
     *
     * @param  int $amount
     *
     * @return function
     */
    public function makeBackendFilterChargeAmount($amount)
    {
        $chargeLimit = $this['limits']['charge_amount'];
        $installmentMin = $this['limits']['installment_amount']['min'];
        $installmentMax = isset($this['limits']['installment_amount']['max']) ? $this['limits']['installment_amount']['max'] : PHP_INT_MAX;

        return function ($backend) use ($amount, $chargeLimit, $installmentMin, $installmentMax) {
            if (self::isInstallmentBackend($backend)) {
                return $amount >= $installmentMin && $amount <= $installmentMax;
            } else {
                return $amount >= $chargeLimit['min'] && $amount <= $chargeLimit['max'];
            }
        };
    }

    /**
     * Combines boolean filters.
     *
     * @param  [functions] $filters
     *
     * @return function
     */
    private static function combineFilters($filters)
    {
        return function ($value) use ($filters) {
            foreach ($filters as $filter) {
                if (!$filter($value)) {
                    return false;
                }
            }

            return true;
        };
    }

    /**
     * Converts args to variadic fashion, rather than as a single array
     *
     * @param  [functions] $filters
     *
     * @return function
     */
    private static function argsToVariadic($argArray)
    {
        return count($argArray) === 1 && is_array($argArray[0]) ? $argArray[0] : $argArray;
    }

    /**
     * @return string
     */
    private static function getUrl()
    {
        return OMISE_API_URL . self::ENDPOINT;
    }

    /**
     * Check if the backend is the installment backend
     * @return boolean
     */
    private static function isInstallmentBackend($backend)
    {
        $installmentPrefix = 'installment';

        return strncmp($backend->name, $installmentPrefix, strlen($installmentPrefix)) === 0;
    }
}
