<?php

class OmiseHttpExecutor implements OmiseHttpExecutorInterface
{
    private $OMISE_CONNECTTIMEOUT = 30;
    private $OMISE_TIMEOUT = 60;

    public function execute($url, $requestMethod, $key, $params = null)
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
     * Creates an option for php-curl from the given request method and parameters in an associative array.
     *
     * @param  string $requestMethod
     * @param  array  $params
     *
     * @return array
     */
    private function genOptions($requestMethod, $userpwd, $params)
    {
        $user_agent = 'OmisePHP/' . OMISE_PHP_LIB_VERSION . ' PHP/' . PHP_VERSION;
        $omise_api_version = defined('OMISE_API_VERSION') ? OMISE_API_VERSION : null;

        $options = [
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
            CURLOPT_CONNECTTIMEOUT => $this->OMISE_CONNECTTIMEOUT,
            // Authentication.
            CURLOPT_USERPWD => $userpwd
        ];

        // Config Omise API Version
        if ($omise_api_version) {
            $options += [CURLOPT_HTTPHEADER => ['Omise-Version: ' . $omise_api_version]];

            $user_agent .= ' OmiseAPI/' . $omise_api_version;
        }

        // Config UserAgent
        if (defined('OMISE_USER_AGENT_SUFFIX')) {
            $options += [CURLOPT_USERAGENT => $user_agent . ' ' . OMISE_USER_AGENT_SUFFIX];
        } else {
            $options += [CURLOPT_USERAGENT => $user_agent];
        }

        // Also merge POST parameters with the option.
        if (is_array($params) && count($params) > 0) {
            $http_query = http_build_query($params);
            $http_query = preg_replace('/%5B\d+%5D/simU', '%5B%5D', $http_query);

            $options += [CURLOPT_POSTFIELDS => $http_query];
        }

        return $options;
    }
}
