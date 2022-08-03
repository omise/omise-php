<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

define('OMISE_PHP_LIB_VERSION', '2.15.0');
define('OMISE_API_URL', 'https://api.omise.co/');
define('OMISE_VAULT_URL', 'https://vault.omise.co/');

class OmiseApiResource extends OmiseObject
{
    private $httpClient;

    // Request methods
    public const REQUEST_GET = 'GET';
    public const REQUEST_POST = 'POST';
    public const REQUEST_DELETE = 'DELETE';
    public const REQUEST_PATCH = 'PATCH';

    // Timeout settings
    private $OMISE_CONNECTTIMEOUT = 30;
    private $OMISE_TIMEOUT = 60;

    protected static $instances = [];

    private static $classesToUsePublicKey = [
        OmiseToken::class,
    ];

    /**
     * Returns an instance of the class given in $clazz or raise an error.
     *
     * @param  string $clazz
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
        }
        return static::$instances[$className];
    }

    /**
     * Retrieves the resource.
     *
     * @param  string $clazz
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @throws Exception|OmiseException
     *
     * @return OmiseAccount|OmiseBalance|OmiseCharge|OmiseCustomer|OmiseToken|OmiseTransaction|OmiseTransfer
     */
    protected static function g_retrieve($clazz, $url, $publickey = null, $secretkey = null)
    {
        $resource = self::getInstance($publickey, $secretkey);
        $result = $resource->execute($url, self::REQUEST_GET, $resource->getResourceKey());
        $resource->refresh($result);

        return $resource;
    }

    /**
     * Creates the resource with given parameters in an associative array.
     *
     * @param  string $clazz
     * @param  string $url
     * @param  array  $params
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @throws Exception|OmiseException
     *
     * @return OmiseAccount|OmiseBalance|OmiseCharge|OmiseCustomer|OmiseToken|OmiseTransaction|OmiseTransfer
     */
    protected static function g_create($clazz, $url, $params, $publickey = null, $secretkey = null)
    {
        $resource = self::getInstance($publickey, $secretkey);
        $result = $resource->execute($url, self::REQUEST_POST, $resource->getResourceKey(), $params);
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
        $result = $resource->execute($url, self::REQUEST_PATCH, $resource->getResourceKey(), $params);
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
        $result = $resource->execute($url, self::REQUEST_POST, $resource->getResourceKey());
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
        $result = $resource->execute($url, self::REQUEST_DELETE, $resource->getResourceKey());
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
        $result = $resource->execute($url, self::REQUEST_POST, $resource->getResourceKey());
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
        $result = $resource->execute($url, self::REQUEST_GET, $resource->getResourceKey());
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
        $result = $this->_executeCurl($url, $requestMethod, $key, $params);

        // Decode the JSON response as an associative array.
        $array = json_decode($result, true);

        // If response is invalid or not a JSON.
        if (!$this->isValidAPIResponse($array)) {
            throw new Exception('Unknown error. (Bad Response)');
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
     * get http guzzle client
     * @return Client
     */
    protected function httpClient()
    {
        if (!$this->httpClient) {
            $this->httpClient = new Client();
        }
        return $this->httpClient;
    }

    /**
     * @param  string $url
     * @param  string $requestMethod
     * @param  array  $params
     *
     * @throws OmiseException
     *
     * @return string
     */
    private function _executeCurl($url, $requestMethod, $key, $params = null)
    {
        try {
            $options = $this->getOptions($requestMethod, $key, $params);
            $result = $this->httpClient()->request($requestMethod, $url, $options);
            return $result->getBody();
        } catch (ClientException $e) {
            $array = json_decode($e->getResponse()->getBody()->getContents(), true);
            throw OmiseException::getInstance($array);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Creates an option for php-curl from the given request method and parameters in an associative array.
     *
     * @param  string $requestMethod
     * @param  array  $params
     *
     * @return array
     */
    public function getOptions($requestMethod, $key, $params = [])
    {
        $userAgent = 'OmisePHP/'.OMISE_PHP_LIB_VERSION.' PHP/'.phpversion();
        $omiseApiVersion = defined('OMISE_API_VERSION') ? OMISE_API_VERSION : null;
        $omiseVersionHeader = [];

        // Config Omise API Version
        if ($omiseApiVersion) {
            $omiseVersionHeader = ['Omise-Version' => $omiseApiVersion];
            $userAgent .= ' OmiseAPI/' . $omiseApiVersion;
        }

        $options = [
            'connect_timeout' => $this->OMISE_CONNECTTIMEOUT,
            'timeout' => $this->OMISE_TIMEOUT,
            'allow_redirects' => ['referer' => true],
            'headers' => array_merge($omiseVersionHeader, [
                'User-Agent' => $userAgent,
                'Omise-Version' => $omiseApiVersion,
                'Authorization' => 'Basic ' . base64_encode($key)
            ]),
        ];
        if (is_array($params) && count($params) > 0) {
            return array_merge($options, $this->getQueryBodyParameters($params));
        }
        return $options;
    }

    /**
     * remove empty value from params
     * @param  array $params
     * @return array
     */
    private function getQueryBodyParameters($params)
    {
        $requestBody = [];
        foreach ($params as $key => $value) {
            if (gettype($value) == 'boolean') {
                $requestBody[$key] = $value;
            } else {
                if ($value) {
                    $requestBody[$key] = $value;
                }
            }
        }
        return ['json' => $requestBody];
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
    protected static function getResourceKey()
    {
        $resource = self::getInstance();
        if (in_array(get_class($resource), self::$classesToUsePublicKey)) {
            return $resource->_publickey;
        }
        return $resource->_secretkey;
    }
}
