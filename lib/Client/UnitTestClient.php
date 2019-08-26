<?php

namespace Omise\Client;

use Exception;

class UnitTestClient implements ClientInterface
{
    /**
     * {@inheritDoc}
     */
    public function setCredential($key)
    {
        return;
    }

    /**
     * {@inheritDoc}
     */
    public function execute($url, $method, $params)
    {
        $fixtureDirectory = __DIR__ . '/../../tests/fixtures';
        $requestUrl       = $this->extractRequestUrl($url);

        $fixture = $fixtureDirectory . '/' . $requestUrl . '-' . strtolower($method) . '.json';
        if (! file_exists($fixture)) {
            throw new Exception('Fixture not found: ' . $fixture);
        }

        return file_get_contents($fixture);
    }

    protected function extractRequestUrl($url)
    {
        // Extract only hostname and URL path without trailing slash.
        $parsed      = parse_url($url);
        $requestUrl = $parsed['host'] . rtrim($parsed['path'], '/');

        // Convert query string into filename friendly format.
        if (! empty($parsed['query'])) {
            $query      = base64_encode($parsed['query']);
            $query      = str_replace(array('+', '/', '='), array('-', '_', ''), $query);
            $requestUrl = $requestUrl . '-' . $query;
        }

        return $requestUrl;
    }
}
