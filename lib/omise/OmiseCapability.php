<?php

class OmiseCapability extends OmiseApiResource
{
    const ENDPOINT = 'capability';

    /**
     * @var array  of the filterable keys.
     */
    public static $filters = [
        'paymentMethod' => ['currency', 'exactName', 'name', 'chargeAmount']
    ];

    public function __construct($publickey = null, $secretkey = null)
    {
        parent::__construct($publickey, $secretkey);
        $this->setupFilterShortcuts();
    }

    /**
     * Sets up 'shortcuts' to filters so they may be used thus:
     *    $capability->filterPaymentMethod['currency']('THB')
     * As well as the original:
     *    $capability->filterPaymentMethodCurrency('THB')
     */
    protected function setupFilterShortcuts()
    {
        foreach (self::$filters as $filterSubject => $availableFilters) {
            $filterArrayName = 'filter' . ucfirst($filterSubject);
            $this->$filterArrayName = [];
            $tempArr = &$this->$filterArrayName;
            foreach ($availableFilters as $type) {
                $funcName = 'filter' . ucfirst($filterSubject) . ucfirst($type);
                $tempArr[$type] = function () use ($funcName) {
                    return call_user_func_array([$this, $funcName], func_get_args());
                };
            }
        }
    }

    /**
     * Retrieves capability.
     *
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseCapability
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
     * Retrieves array of payment methods. Optionally pass in as many filter functions as you want
     * (muliple arguments, or a single array)
     *
     * @param [func1,fun2,...] OR func1, func2,...
     *
     * @return array
     */
    public function getPaymentMethods()
    {
        $methods = array_map(function ($method) {
            return (object) $method;
        }, $this['payment_methods']);

        return ($filters = func_get_args()) ? array_filter($methods, self::combineFilters(self::argsToVariadic($filters))) : $methods;
    }

    /**
     * Makes a filter function to check supported currency of payment method.
     *
     * @param  string $currency
     *
     * @return function
     */
    public function filterPaymentMethodCurrency($currency)
    {
        return function ($method) use ($currency) {
            return in_array(strtolower($currency), array_map('strtolower', $method->currencies));
        };
    }

    /**
     * Makes a filter function to check exact name of payment method.
     *
     * @param  string $type
     *
     * @return function
     */
    public function filterPaymentMethodExactName($name)
    {
        return function ($method) use ($name) {
            return $method->name === $name;
        };
    }

    /**
     * Makes a filter function to check name of payment method.
     *
     * @param  string $type
     *
     * @return function
     */
    public function filterPaymentMethodName($name)
    {
        return function ($method) use ($name) {
            return strpos($method->name, $name) !== false;
        };
    }

    /**
     * Makes a filter function to check if payment method can handle given amount.
     *
     * @param  int $amount
     *
     * @return function
     */
    public function filterPaymentMethodChargeAmount($amount)
    {
        $chargeLimit = $this['limits']['charge_amount'];
        $installmentMin = $this['limits']['installment_amount']['min'];
        $installmentMax = isset($this['limits']['installment_amount']['max']) ? $this['limits']['installment_amount']['max'] : PHP_INT_MAX;

        return function ($method) use ($amount, $chargeLimit, $installmentMin, $installmentMax) {
            if (self::isInstallmentPaymentMethod($method)) {
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
     * Check if the payment method is the installment
     * @return boolean
     */
    private static function isInstallmentPaymentMethod($paymentMethod)
    {
        $installmentPrefix = 'installment';

        return strncmp($paymentMethod->name, $installmentPrefix, strlen($installmentPrefix)) === 0;
    }
}
