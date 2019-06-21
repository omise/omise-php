<?php
namespace Omise;

use Omise\Http\Response\Handler as ResponseHandler;
use Exception;

class ApiRequestor
{
    /**
     * @var string
     */
    const OMISE_PHP_LIB_VERSION = '3.0.0-dev';
    const OMISE_API_URL         = 'https://api.omise.co/';
    const OMISE_VAULT_URL       = 'https://vault.omise.co/';

    /**
     * Request methods
     * @var string
     */
    const REQUEST_GET     = 'GET';
    const REQUEST_POST    = 'POST';
    const REQUEST_PATCH   = 'PATCH';
    const REQUEST_DELETE  = 'DELETE';
    const REQUEST_METHODS = array(self::REQUEST_GET, self::REQUEST_POST, self::REQUEST_PATCH, self::REQUEST_DELETE);

    /**
     * Timeout setting
     * @var int
     */
    private $OMISE_CONNECTTIMEOUT = 30;
    private $OMISE_TIMEOUT        = 60;

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
    public function request($url, $requestMethod, $key, $params = null)
    {
        // If this class is execute by phpunit > get test mode.
        if (preg_match('/phpunit/', $_SERVER['SCRIPT_NAME'])) {
            $result = $this->_executeTest($url, $requestMethod, $key, $params);
        } else {
            $result = $this->_executeCurl($url, $requestMethod, $key, $params);
        }

        $responseHandler = new ResponseHandler;
        return $responseHandler->handle($result);
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
        $parsed      = parse_url($url);
        $requestUrl = $parsed['host'] . rtrim($parsed['path'], '/');

        // Convert query string into filename friendly format.
        if (!empty($parsed['query'])) {
            $query      = base64_encode($parsed['query']);
            $query      = str_replace(array('+', '/', '='), array('-', '_', ''), $query);
            $requestUrl = $requestUrl . '-' . $query;
        }

        // Finally.
        $requestUrl = dirname(__FILE__) . '/../../tests/fixtures/' . $requestUrl . '-' . strtolower($requestMethod) . '.json';

        // Make a request from Curl if json file was not exists.
        if (!file_exists($requestUrl)) {
            // Get a directory that's file should contain.
            $request_dir = explode('/', $requestUrl);
            unset($request_dir[count($request_dir) - 1]);
            $request_dir = implode('/', $request_dir);

            // Create directory if it not exists.
            if (! file_exists($request_dir)) {
                mkdir($request_dir, 0777, true);
            }

            $result = $this->_executeCurl($url, $requestMethod, $key, $params);

            $f = fopen($requestUrl, 'w');
            if ($f) {
                fwrite($f, $result);
                fclose($f);
            }
        } else {
            // Or get response from json file.
            $result = file_get_contents($requestUrl);
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
    private function genOptions($requestMethod, $userpassword, $params)
    {
        $certificateFileLocation = dirname(__FILE__) . '/../../data/ca_certificates.pem';
        $userAgent               = 'OmisePHP/' . self::OMISE_PHP_LIB_VERSION . ' PHP/' . phpversion();

        $options = array(
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,       // Set the HTTP version to 1.1.
            CURLOPT_CUSTOMREQUEST  => $requestMethod,              // Set the request method.
            CURLOPT_RETURNTRANSFER => true,                        // Make php-curl returns the data as string.
            CURLOPT_HEADER         => false,                       // Do not include the header in the output.
            CURLINFO_HEADER_OUT    => true,                        // Track the header request string and set the referer on redirect.
            CURLOPT_AUTOREFERER    => true,
            CURLOPT_TIMEOUT        => $this->OMISE_TIMEOUT,        // Time before the request is aborted.
            CURLOPT_CONNECTTIMEOUT => $this->OMISE_CONNECTTIMEOUT, // Time before the request is aborted when attempting to connect.
            CURLOPT_USERPWD        => $userpassword,               // Authentication.
            CURLOPT_CAINFO         => $certificateFileLocation     // CA bundle.
        );

        // Config Omise API Version
        if ($apiVersion = \Omise\Omise::apiVersion()) {
            $options += array(CURLOPT_HTTPHEADER => array('Omise-Version: ' . $apiVersion));

            $userAgent .= ' OmiseAPI/' . $apiVersion;
        }

        // Config UserAgent
        if ($suffixUserAgent = \Omise\Omise::userAgent()) {
            $userAgent .= ' ' . $suffixUserAgent;
        }

        $options += array(CURLOPT_USERAGENT => $userAgent);

        // Also merge POST parameters with the option.
        if (is_array($params) && count($params) > 0) {
            $httpQuery = http_build_query($params);
            $httpQuery = preg_replace('/%5B[0-9]+%5D/simU', '%5B%5D', $httpQuery);

            $options += array(CURLOPT_POSTFIELDS => $httpQuery);
        }

        return $options;
    }
}
