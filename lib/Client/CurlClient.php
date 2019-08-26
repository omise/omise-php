<?php

namespace Omise\Client;

use Exception;

class CurlClient implements ClientInterface
{
    /**
     * @var string
     */
    protected static $credential;

    /**
     * Timeout setting
     *
     * @var int
     */
    private $OMISE_CONNECTTIMEOUT = 30;
    private $OMISE_TIMEOUT        = 60;

    /**
     * {@inheritDoc}
     */
    public function setCredential($key)
    {
        static::$credential = $key;
    }

    /**
     * {@inheritDoc}
     */
    public function execute($url, $method, $params)
    {
        $options = $this->genOptions($method, static::$credential . ':', $params);
        $curl    = curl_init($url);

        curl_setopt_array($curl, $options);

        // Make a request or thrown an exception.
        if (($result = curl_exec($curl)) === false) {
            $error = curl_error($curl);
            curl_close($curl);

            throw new Exception($error);
        }

        curl_close($curl);
        return $result;
    }

    /**
     * Creates an option for php-curl from the given request method
     * and parameters in an associative array.
     *
     * @param  string $requestMethod
     * @param  string $userpassword
     * @param  array  $params
     *
     * @return array
     */
    private function genOptions($requestMethod, $userpassword, $params)
    {
        $userAgent = 'OmisePHP/' . OMISE_PHP_LIB_VERSION . ' PHP/' . phpversion();

        $options = array(
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,       // Set the HTTP version to 1.1.
            CURLOPT_CUSTOMREQUEST  => $requestMethod,              // Set the request method.
            CURLOPT_RETURNTRANSFER => true,                        // Make php-curl returns the data as string.
            CURLOPT_HEADER         => false,                       // Do not include the header in the output.
            CURLINFO_HEADER_OUT    => true,                        // Track the header request string and set the referer on redirect.
            CURLOPT_AUTOREFERER    => true,
            CURLOPT_TIMEOUT        => $this->OMISE_TIMEOUT,        // Time before the request is aborted.
            CURLOPT_CONNECTTIMEOUT => $this->OMISE_CONNECTTIMEOUT, // Time before the request is aborted when attempting to connect.
            CURLOPT_USERPWD        => $userpassword                // Authentication.
        );

        // Config Omise API Version
        if (defined('OMISE_API_VERSION')) {
            $options += array(CURLOPT_HTTPHEADER => array('Omise-Version: ' . OMISE_API_VERSION));

            $userAgent .= ' OmiseAPI/' . OMISE_API_VERSION;
        }

        // Config UserAgent
        if (defined('OMISE_USER_AGENT_SUFFIX')) {
            $userAgent .= ' ' . OMISE_USER_AGENT_SUFFIX;
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
