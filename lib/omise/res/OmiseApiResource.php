<?php


namespace Omise\Res;

use Exception;
use Omise\Exceptions\OmiseException;
use Omise\OmiseAccount;
use Omise\OmiseBalance;
use Omise\OmiseCharge;
use Omise\OmiseCustomer;
use Omise\OmiseToken;
use Omise\OmiseTransaction;
use Omise\OmiseTransfer;
use Omise\Res\Obj\OmiseObject;

define('OMISE_PHP_LIB_VERSION', '2.9.1');
define('OMISE_API_URL', 'https://api.omise.co/');
define('OMISE_VAULT_URL', 'https://vault.omise.co/');

class OmiseApiResource extends OmiseObject
{
    // Request methods
    const REQUEST_GET = 'GET';
    const REQUEST_POST = 'POST';
    const REQUEST_DELETE = 'DELETE';
    const REQUEST_PATCH = 'PATCH';

    // Timeout settings
    private $OMISE_CONNECT_TIMEOUT = 30;
    private $OMISE_TIMEOUT = 60;

    /**
     * Returns an instance of the class given in $clazz or raise an error.
     *
     * @param  string $clazz
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @throws Exception
     *
     * @return OmiseResource
     */
    protected static function getInstance($clazz, $publicKey = null, $secretKey = null)
    {
        if (class_exists($clazz)) {
            return new $clazz($publicKey, $secretKey);
        }

        throw new Exception('Undefined class.');
    }

    /**
     * Retrieves the resource.
     *
     * @param  string $clazz
     * @param  string $url
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseAccount|OmiseBalance|OmiseCharge|OmiseCustomer|OmiseToken|OmiseTransaction|OmiseTransfer
     */
    protected static function g_retrieve($clazz, $url, $publicKey = null, $secretKey = null)
    {
        $resource = call_user_func(array($clazz, 'getInstance'), $clazz, $publicKey, $secretKey);

        $result = $resource->execute($url, self::REQUEST_GET, $resource->getResourceKey());

        $resource->refresh($result);

        return $resource;
    }

    /**
     * Creates the resource with given parameters.in an associative array.
     *
     * @param  string $clazz
     * @param  string $url
     * @param  array $params
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @throws Exception|OmiseException
     *
     * @return OmiseAccount|OmiseBalance|OmiseCharge|OmiseCustomer|OmiseToken|OmiseTransaction|OmiseTransfer
     */
    protected static function g_create($clazz, $url, $params, $publicKey = null, $secretKey = null)
    {
        $resource = call_user_func(array($clazz, 'getInstance'), $clazz, $publicKey, $secretKey);
        $result = $resource->execute($url, self::REQUEST_POST, $resource->getResourceKey(), $params);
        $resource->refresh($result);

        return $resource;
    }

    /**
     * Updates the resource with the given parameters in an associative array.
     *
     * @param  string $url
     * @param  array $params
     *
     * @throws Exception|OmiseException
     */
    protected function g_update($url, $params)
    {
        $result = $this->execute($url, self::REQUEST_PATCH, $this->getResourceKey(), $params);
        $this->refresh($result);
    }

    /**
     * Destroys the resource.
     *
     * @param  string $url
     *
     * @return void
     * @throws OmiseException
     */
    protected function g_destroy($url)
    {
        $result = $this->execute($url, self::REQUEST_DELETE, $this->getResourceKey());
        $this->refresh($result, true);
    }

    /**
     * Reloads the resource with latest data.
     *
     * @param  string $url
     *
     * @throws Exception|OmiseException
     */
    protected function g_reload($url)
    {
        $result = $this->execute($url, self::REQUEST_GET, $this->getResourceKey());
        $this->refresh($result);
    }

    /**
     * Makes a request and returns a decoded JSON data as an associative array.
     *
     * @param  string $url
     * @param  string $requestMethod
     * @param $key
     * @param  array $params
     *
     * @return array
     * @throws OmiseException
     * @throws \Omise\Exceptions\OmiseAuthenticationFailureException
     * @throws \Omise\Exceptions\OmiseFailedCaptureException
     * @throws \Omise\Exceptions\OmiseFailedFraudCheckException
     * @throws \Omise\Exceptions\OmiseInvalidCardException
     * @throws \Omise\Exceptions\OmiseInvalidCardTokenException
     * @throws \Omise\Exceptions\OmiseInvalidChargeException
     * @throws \Omise\Exceptions\OmiseMissingCardException
     * @throws \Omise\Exceptions\OmiseNotFoundException
     * @throws \Omise\Exceptions\OmiseUndefinedException
     * @throws \Omise\Exceptions\OmiseUsedTokenException
     * @throws Exception
     */
    protected function execute($url, $requestMethod, $key, $params = null)
    {
        // If this class is execute by phpunit > get test mode.
        if (preg_match('/phpunit/', $_SERVER['SCRIPT_NAME'])) {
            $result = $this->_executeTest($url, $requestMethod, $key, $params);
        } else {
            $result = $this->_executeCurl($url, $requestMethod, $key, $params);
        }

        // Decode the JSON response as an associative array.
        $array = json_decode($result, true);

        // If response is invalid or not a JSON.
        if (count($array) === 0 || !isset($array['object'])) {
            throw new Exception('Unknown error. (Bad Response)');
        }

        // If response is an error object.
        if ($array['object'] === 'error') {
            throw OmiseException::getInstance($array);
        }

        return $array;
    }

    /**
     * @param  string $url
     * @param  string $requestMethod
     * @param $key
     * @param  array $params
     *
     * @return string
     * @throws Exception
     */
    private function _executeCurl($url, $requestMethod, $key, $params = null)
    {
        $ch = curl_init($url);

        curl_setopt_array($ch, $this->genOptions($requestMethod, $key . ':', $params));

        // Make a request or thrown an exception.
        if (($result = curl_exec($ch)) === false) {
            $error = curl_error($ch);
            curl_close($ch);

            throw new Exception($error);
        }

        // Close.
        curl_close($ch);

        return $result;
    }

    /**
     * @param  string $url
     * @param  string $requestMethod
     * @param  string $key
     * @param  array $params
     *
     * @return string
     * @throws Exception
     */
    private function _executeTest($url, $requestMethod, $key, $params = null)
    {
        // Extract only hostname and URL path without trailing slash.
        $parsed = parse_url($url);
        $request_url = $parsed['host'] . rtrim($parsed['path'], '/');

        // Convert query string into filename friendly format.
        if (!empty($parsed['query'])) {
            $query = base64_encode($parsed['query']);
            $query = str_replace(array('+', '/', '='), array('-', '_', ''), $query);
            $request_url = $request_url . '-' . $query;
        }

        // Finally.
        $request_url = dirname(__FILE__) . '/../../../tests/fixtures/' . $request_url . '-' . strtolower($requestMethod) . '.json';

        // Make a request from Curl if json file was not exists.
        if (!file_exists($request_url)) {
            // Get a directory that's file should contain.
            $request_dir = explode('/', $request_url);
            unset($request_dir[count($request_dir) - 1]);
            $request_dir = implode('/', $request_dir);

            // Create directory if it not exists.
            if (!file_exists($request_dir)) {
                mkdir($request_dir, 0777, true);
            }

            $result = $this->_executeCurl($url, $requestMethod, $key, $params);

            $f = fopen($request_url, 'w');
            if ($f) {
                fwrite($f, $result);

                fclose($f);
            }
        } else { // Or get response from json file.
            $result = file_get_contents($request_url);
        }

        return $result;
    }

    /**
     * Creates an option for php-curl from the given request method and parameters in an associative array.
     *
     * @param  string $requestMethod
     * @param $userPwd
     * @param  array $params
     *
     * @return array
     */
    private function genOptions($requestMethod, $userPwd, $params)
    {
        $user_agent = "OmisePHP/" . OMISE_PHP_LIB_VERSION . " PHP/" . phpversion();
        $omise_api_version = defined('OMISE_API_VERSION') ? OMISE_API_VERSION : null;

        $options = array(
            // Set the HTTP version to 1.1.
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            // Set the request method.
            CURLOPT_CUSTOMREQUEST => $requestMethod,
            // Make php-curl returns the data as string.
            CURLOPT_RETURNTRANSFER => true,
            // Do not include the header in the output.
            CURLOPT_HEADER => false,
            // Track the header request string and set the referer on redirect.
            CURLINFO_HEADER_OUT => true,
            CURLOPT_AUTOREFERER => true,
            // Make HTTP error code above 400 an error.
            // CURLOPT_FAILONERROR => true,
            // Time before the request is aborted.
            CURLOPT_TIMEOUT => $this->OMISE_TIMEOUT,
            // Time before the request is aborted when attempting to connect.
            CURLOPT_CONNECTTIMEOUT => $this->OMISE_CONNECT_TIMEOUT,
            // Authentication.
            CURLOPT_USERPWD => $userPwd,
            // CA bundle.
            CURLOPT_CAINFO => dirname(__FILE__) . '/../../../data/ca_certificates.pem'
        );

        // Config Omise API Version
        if ($omise_api_version) {
            $options += array(CURLOPT_HTTPHEADER => array("Omise-Version: " . $omise_api_version));

            $user_agent .= ' OmiseAPI/' . $omise_api_version;
        }

        // Config UserAgent
        if (defined('OMISE_USER_AGENT_SUFFIX')) {
            $options += array(CURLOPT_USERAGENT => $user_agent . " " . OMISE_USER_AGENT_SUFFIX);
        } else {
            $options += array(CURLOPT_USERAGENT => $user_agent);
        }

        // Also merge POST parameters with the option.
        if (is_array($params) && count($params) > 0) {
            $http_query = http_build_query($params);
            $http_query = preg_replace('/%5B[0-9]+%5D/simU', '%5B%5D', $http_query);

            $options += array(CURLOPT_POSTFIELDS => $http_query);
        }

        return $options;
    }

    /**
     * Checks whether the resource has been destroyed.
     *
     * @return bool|null
     */
    protected function isDestroyed()
    {
        return $this['deleted'];
    }

    /**
     * Returns the secret key.
     *
     * @return string
     */
    protected function getResourceKey()
    {
        return $this->_secretKey;
    }
}
