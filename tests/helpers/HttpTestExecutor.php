<?php

class HttpTestExecutor implements OmiseHttpExecutorInterface
{
    public function execute($url, $requestMethod, $key, $params = null)
    {
        // Extract only hostname and URL path without trailing slash.
        $parsed = parse_url($url);
        $request_url = $parsed['host'] . rtrim($parsed['path'], '/');

        // Convert query string into filename friendly format.
        if (!empty($parsed['query'])) {
            $query = base64_encode($parsed['query']);
            $query = str_replace(['+', '/', '='], ['-', '_', ''], $query);
            $request_url = $request_url . '-' . $query;
        }

        // Finally.
        $request_url = dirname(__FILE__) . '/../fixtures/' . $request_url . '-' . strtolower($requestMethod) . '.json';

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

            $result = (new OmiseHttpExecutor())->execute($url, $requestMethod, $key, $params);

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
}
