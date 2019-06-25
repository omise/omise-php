<?php
namespace Omise;

use Omise\Http\Response\Handler as ResponseHandler;
use Exception;

class ApiRequestor
{
    /**
     * @var string
     */
    const OMISE_API_URL   = 'https://api.omise.co/';
    const OMISE_VAULT_URL = 'https://vault.omise.co/';

    /**
     * Allowed request methods.
     *
     * @var string
     */
    const REQUEST_GET     = 'GET';
    const REQUEST_POST    = 'POST';
    const REQUEST_PATCH   = 'PATCH';
    const REQUEST_DELETE  = 'DELETE';
    const REQUEST_METHODS = array(self::REQUEST_GET, self::REQUEST_POST, self::REQUEST_PATCH, self::REQUEST_DELETE);

    /**
     * @var Omise\Client\ClientInterface
     */
    protected static $client;

    /**
     * @param string $arguments[0]  An API endpoint
     * @param string $arguments[1]  Omise secret key 
     * @param array  $arguments[2]  Parameters
     */
    public function __call($name, $arguments)
    {
        $requestMethodName = strtoupper($name);
        if (! in_array($requestMethodName, self::REQUEST_METHODS)) {
            throw new Exception('Request method "' . $requestMethodName . '" not supported.', 1);
        }

        return $this->request($arguments[0], $requestMethodName, $arguments[1], count($arguments) > 2 ? $arguments[2] : null);
    }

    /**
     * @param string $url
     * @param string $requestMethod
     * @param string $key
     * @param array  $params
     */
    public function request($url, $method, $key, $params = null)
    {
        $client = $this->client();
        $client->setCredential($key);

        $result = $client->execute($url, $method, $params);

        $responseHandler = new ResponseHandler;
        return $responseHandler->handle($result);
    }

    /**
     * @return \Omise\Client\ClientInterface  An instance of a ClientInterface-implemented object.
     */
    public function client()
    {
        static::$client = static::$client ?: \Omise\Omise::client();
        return static::$client;
    }
}
