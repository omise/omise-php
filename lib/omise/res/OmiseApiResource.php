<?php

define('OMISE_PHP_LIB_VERSION', '2.13.0');
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
    private $OMISE_CONNECTTIMEOUT = 30;
    private $OMISE_TIMEOUT = 60;

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
    protected static function getInstance($clazz, $publickey = null, $secretkey = null)
    {
        if (class_exists($clazz)) {
            return new $clazz($publickey, $secretkey);
        }

        throw new Exception('Undefined class.');
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
        $resource = call_user_func(array($clazz, 'getInstance'), $clazz, $publickey, $secretkey);
        $result   = $resource->execute($url, self::REQUEST_GET, $resource->getResourceKey());
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
        $resource = call_user_func(array($clazz, 'getInstance'), $clazz, $publickey, $secretkey);
        $result   = $resource->execute($url, self::REQUEST_POST, $resource->getResourceKey(), $params);
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
    protected function g_update($url, $params = null)
    {
        $result = $this->execute($url, self::REQUEST_PATCH, $this->getResourceKey(), $params);
        $this->refresh($result);
    }

    /**
     * Set the resource to expire.
     *
     * @param  string $url
     *
     * @throws Exception|OmiseException
     *
     * @return OmiseApiResource
     */
    protected function g_expire($url)
    {
        $result = $this->execute($url, self::REQUEST_POST, $this->getResourceKey());
        $this->refresh($result, true);
    }

    /**
     * Destroys the resource.
     *
     * @param  string $url
     *
     * @throws Exception|OmiseException
     *
     * @return OmiseApiResource
     */
    protected function g_destroy($url)
    {
        $result = $this->execute($url, self::REQUEST_DELETE, $this->getResourceKey());
        $this->refresh($result, true);
    }

    /**
     * Revokes the resource.
     *
     * @param  string $url
     *
     * @throws Exception|OmiseException
     */
    protected function g_revoke($url)
    {
        $result = $this->execute($url, self::REQUEST_POST, $this->getResourceKey());
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
     * @param  array  $params
     *
     * @throws OmiseException
     *
     * @return array
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
        if (!$this->isValidAPIResponse($array)) {
            throw new Exception('Unknown error. (Bad Response)');
        }

        // If response is an error object.
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
    protected function isValidAPIResponse($array)
    {
        return count($array) && isset($array['object']);
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
        $ch = curl_init($url);

        curl_setopt_array($ch, $this->genOptions($requestMethod, $key.':', $params));

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
     * @param  array  $params
     *
     * @throws OmiseException
     *
     * @return string
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
            $request_url = $request_url.'-'.$query;
        }

        // Finally.
        $request_url = dirname(__FILE__).'/../../../tests/fixtures/'.$request_url.'-'.strtolower($requestMethod).'.json';

        // Make a request from Curl if json file was not exists.
        if (! file_exists($request_url)) {
            // Get a directory that's file should contain.
            $request_dir = explode('/', $request_url);
            unset($request_dir[count($request_dir) - 1]);
            $request_dir = implode('/', $request_dir);

            // Create directory if it not exists.
            if (! file_exists($request_dir)) {
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
     * @param  array  $params
     *
     * @return array
     */
    private function genOptions($requestMethod, $userpwd, $params)
    {
        $user_agent        = "OmisePHP/".OMISE_PHP_LIB_VERSION." PHP/".phpversion();
        $omise_api_version = defined('OMISE_API_VERSION') ? OMISE_API_VERSION : null;

        $options = array(
            // Set the HTTP version to 1.1.
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            // Set the request method.
            CURLOPT_CUSTOMREQUEST  => $requestMethod,
            // Make php-curl returns the data as string.
            CURLOPT_RETURNTRANSFER => true,
            // Do not include the header in the output.
            CURLOPT_HEADER         => false,
            // Track the header request string and set the referer on redirect.
            CURLINFO_HEADER_OUT    => true,
            CURLOPT_AUTOREFERER    => true,
            // Make HTTP error code above 400 an error.
            // CURLOPT_FAILONERROR => true,
            // Time before the request is aborted.
            CURLOPT_TIMEOUT        => $this->OMISE_TIMEOUT,
            // Time before the request is aborted when attempting to connect.
            CURLOPT_CONNECTTIMEOUT => $this->OMISE_CONNECTTIMEOUT,
            // Authentication.
            CURLOPT_USERPWD        => $userpwd
        );

        // Config Omise API Version
        if ($omise_api_version) {
            $options += array(CURLOPT_HTTPHEADER => array("Omise-Version: ".$omise_api_version));

            $user_agent .= ' OmiseAPI/'.$omise_api_version;
        }

        // Config UserAgent
        if (defined('OMISE_USER_AGENT_SUFFIX')) {
            $options += array(CURLOPT_USERAGENT => $user_agent." ".OMISE_USER_AGENT_SUFFIX);
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
        return $this->_secretkey;
    }
}
