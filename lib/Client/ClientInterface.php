<?php

namespace Omise\Client;

interface ClientInterface
{
    /**
     * @param string $key
     */
    public function setCredential($key);

    /**
     * @param string $url     An API endpoint
     * @param string $method  A HTTP request method
     * @param array  $params  Request body
     */
    public function execute($url, $method, $params);
}
