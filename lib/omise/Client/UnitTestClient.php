<?php
namespace Omise\Client;

use Exception;
use Omise\Omise;

class UnitTestClient implements ClientInterface
{
    protected $apiVersion = '2019-05-29';

    public function setCredential($key)
    {
        return;
    }

    /**
     * @param string $url
     * @param string $method
     * @param array  $params
     */
    public function execute($url, $method, $params)
    {
        $apiVersion       = Omise::apiVersion() ?: $this->apiVersion;
        $requestUrl       = $this->extractRequestUrl($url);
        $fixtureDirectory = __DIR__ . '/../../../tests/fixtures/';

        $fixture = $fixtureDirectory . $apiVersion . '/' . $requestUrl . '-' . strtolower($method) . '.json';

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
