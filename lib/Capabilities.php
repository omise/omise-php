<?php
namespace Omise;

use Omise\ApiResource;

class Capabilities extends ApiResource
{
    const OBJECT_NAME = 'capability';

    /**
     * @var array  of the filterable keys.
     */
    static $filters = [
        'backend' => ['currency', 'type', 'chargeAmount']
    ];

    public function __construct()
    {
        parent::__construct();
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
     * @return Omise\Capabilities
     */
    public static function retrieve()
    {
        return parent::resourceRetrieve();
    }

    /**
     * @see Omise\ApiResource::resourceReload()
     */
    public function reload()
    {
        parent::resourceReload();
    }

    /**
     * Retrieves array of payment backends. Optionally pass in as many filter functions as you want
     * (muliple arguments, or a single array)
     *
     * @param  [func1,fun2,...] OR func1, func2,...
     *
     * @return array
     */
    public function getBackends()
    {
        $backends = array_map(
            function ($backend) {
                $new = (object)(array_merge(reset($backend), ['_id'=>array_keys($backend)[0]]));
                return $new;
            },
            $this['payment_backends']
        );
        // return backends (filtered if requested)
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
     * Makes a filter function to check type of backend.
     *
     * @param  string $type
     *
     * @return function
     */
    public function makeBackendFilterType($type)
    {
        return function ($backend) use ($type) {
            return $backend->type == $type;
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
        $defMin = $this['limits']['charge_amount']['min'];
        $defMax = $this['limits']['charge_amount']['max'];
        return function ($backend) use ($amount, $defMin, $defMax) {
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
        return count($argArray) == 1 && is_array($argArray[0]) ? $argArray[0] : $argArray;
    }

    /**
     * @return string
     */
    protected function credential()
    {
        return 'pkey_test_5fcnkn4378pmguq5zpy';
    }
}
