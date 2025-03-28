<?php

define('OMISE_PHP_LIB_VERSION', '3.0.0');
define('OMISE_API_URL', 'https://api.omise.co/');
define('OMISE_VAULT_URL', 'https://vault.omise.co/');

#[\AllowDynamicProperties]
class OmiseApiResource extends OmiseObject
{
    // Request methods
    const REQUEST_GET = 'GET';
    const REQUEST_POST = 'POST';
    const REQUEST_DELETE = 'DELETE';
    const REQUEST_PATCH = 'PATCH';

    protected static $instances = [];
    protected static $httpExecutor = null;

    private static $classesToUsePublicKey = [
        OmiseToken::class,
        OmiseSource::class
    ];

    /**
     * Returns an instance of the class given in $class or raise an error.
     *
     * @param  string $class
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @throws Exception
     *
     * @return OmiseResource
     */
    protected static function getInstance($publickey = null, $secretkey = null)
    {
        $resource = new static($publickey, $secretkey);
        $className = get_class($resource);
        if (!isset(self::$instances[$className])) {
            static::$instances[$className] = $resource;

            if (preg_match('/phpunit/', $_SERVER['SCRIPT_NAME']) && getenv('TEST_TYPE') == 'unit') {
                static::$httpExecutor = OMISE_HTTP_TEST_EXECUTOR;
            } else {
                static::$httpExecutor = new OmiseHttpExecutor();
            }

            return static::$instances[$className];
        }

        $resource = static::$instances[$className];

        $resource->setPublicKey($publickey);
        $resource->setSecretKey($secretkey);

        return $resource;
    }

    /**
     * Retrieves the resource.
     *
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @throws Exception|OmiseException
     *
     * @return OmiseAccount|OmiseBalance|OmiseCharge|OmiseCustomer|OmiseToken|OmiseTransaction|OmiseTransfer
     */
    protected static function g_retrieve($url, $publickey = null, $secretkey = null)
    {
        $resource = self::getInstance($publickey, $secretkey);
        $result = $resource->execute($url, self::REQUEST_GET, self::getResourceKey($resource));
        $resource->refresh($result);

        return $resource;
    }

    /**
     * Creates the resource with given parameters in an associative array.
     *
     * @param  string $url
     * @param  array  $params
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @throws Exception|OmiseException
     *
     * @return OmiseAccount|OmiseBalance|OmiseCharge|OmiseCustomer|OmiseToken|OmiseTransaction|OmiseTransfer
     */
    protected static function g_create($url, $params, $publickey = null, $secretkey = null)
    {
        $resource = self::getInstance($publickey, $secretkey);
        $result = $resource->execute($url, self::REQUEST_POST, self::getResourceKey($resource), $params);
        $resource->refresh($result);

        return $resource;
    }

    /**
     * Updates the resource with the given parameters in an associative array.
     *
     * @param  string $url
     * @param  array  $params
     *
     * @throws Exception|OmiseException
     */
    protected static function g_update($url, $params = null)
    {
        $resource = self::getInstance();
        $result = $resource->execute($url, self::REQUEST_PATCH, self::getResourceKey($resource), $params);
        $resource->refresh($result);
    }

    /**
     * Set the resource to expire.
     *
     * @param  string $url
     *
     * @throws Exception|OmiseException
     */
    protected static function g_expire($url)
    {
        $resource = self::getInstance();
        $result = $resource->execute($url, self::REQUEST_POST, self::getResourceKey($resource));
        $resource->refresh($result, true);
    }

    /**
     * Destroys the resource.
     *
     * @param  string $url
     *
     * @throws Exception|OmiseException
     */
    protected static function g_destroy($url)
    {
        $resource = self::getInstance();
        $result = $resource->execute($url, self::REQUEST_DELETE, self::getResourceKey($resource));
        $resource->refresh($result, true);
    }

    /**
     * Revokes the resource.
     *
     * @param  string $url
     *
     * @throws Exception|OmiseException
     */
    protected static function g_revoke($url)
    {
        $resource = self::getInstance();
        $result = $resource->execute($url, self::REQUEST_POST, self::getResourceKey($resource));
        $resource->refresh($result, true);
    }

    /**
     * Reloads the resource with latest data.
     *
     * @param  string $url
     *
     * @throws Exception|OmiseException
     */
    protected static function g_reload($url)
    {
        $resource = self::getInstance();
        $result = $resource->execute($url, self::REQUEST_GET, self::getResourceKey($resource));
        $resource->refresh($result);
    }

    /**
     * Makes a request and returns a decoded JSON data as an associative array.
     *
     * @param  string $url
     * @param  string $requestMethod
     * @param  array  $params
     *
     * @throws OmiseException
     *
     * @return array
     */
    protected function execute($url, $requestMethod, $key, $params = null)
    {
        $result = self::$httpExecutor->execute($url, $requestMethod, $key, $params);

        // Decode the JSON response as an associative array.
        $array = json_decode($result, true);

        // If response is invalid or not a JSON.
        if (!$this->isValidAPIResponse($array)) {
            throw new Exception('Unknown error. (Bad Response)');
        }

        if (!empty($array['object']) && $array['object'] === 'error') {
            throw OmiseException::getInstance($array);
        }

        return $array;
    }

    /**
     * Checks if response from API was valid.
     *
     * @param  array  $array  - decoded JSON response
     *
     * @return boolean
     */
    protected static function isValidAPIResponse($array)
    {
        return $array && count($array) && isset($array['object']);
    }

    /**
     * Checks whether the resource has been destroyed.
     *
     * @return bool|null
     */
    protected static function isDestroyed()
    {
        $resource = self::getInstance();

        return $resource['deleted'];
    }

    /**
     * Returns the secret key.
     *
     * @return string
     */
    protected static function getResourceKey($resource = null)
    {
        if (!$resource) {
            $resource = self::getInstance();
        }

        if (in_array(get_class($resource), self::$classesToUsePublicKey)) {
            return $resource->_publickey;
        }

        return $resource->_secretkey;
    }
}
