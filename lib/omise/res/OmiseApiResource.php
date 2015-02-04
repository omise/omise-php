<?php

require_once dirname(__FILE__).'/obj/OmiseObject.php';
require_once dirname(__FILE__).'/../exception/OmiseExceptions.php';

define('OMISE_PHP_LIB_VERSION', '2.1.2');
define('OMISE_API_VERSION', '2014-07-27');
define('OMISE_API_URL', 'https://api.omise.co/');
define('OMISE_VAULT_URL', 'https://vault.omise.co/');

class OmiseApiResource extends OmiseObject {
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
   * @param string $clazz
   * @param string $publickey
   * @param string $secretkey
   * @throws Exception
   * @return OmiseResource
   */
  protected static function getInstance($clazz, $publickey = null, $secretkey = null) {
    if(class_exists($clazz)) {
      return new $clazz($publickey, $secretkey);
    } else {
      throw new Exception('Undefined class.');
    }
  }

  /**
   * Retrieves the resource.
   * @param string $clazz
   * @param string $publickey
   * @param string $secretkey
   * @return OmiseAccount|OmiseBalance|OmiseCharge|OmiseCustomer|OmiseToken|OmiseTransaction|OmiseTransfer
   * @throws Exception|OmiseException
   */
  protected static function g_retrieve($clazz, $url, $publickey = null, $secretkey = null) {
  	$resource = call_user_func(array($clazz, 'getInstance'), $clazz, $publickey, $secretkey);
    $result = $resource->execute($url, self::REQUEST_GET, $resource->getResourceKey());
    $resource->refresh($result);

    return $resource;
  }

  /**
   * Creates the resource with given parameters.in an associative array.
   * @param string $clazz
   * @param string $url
   * @param array $params
   * @param string $publickey
   * @param string $secretkey
   * @return OmiseAccount|OmiseBalance|OmiseCharge|OmiseCustomer|OmiseToken|OmiseTransaction|OmiseTransfer
   * @throws Exception|OmiseException
   */
  protected static function g_create($clazz, $url, $params, $publickey = null, $secretkey = null) {
  	$resource = call_user_func(array($clazz, 'getInstance'), $clazz, $publickey, $secretkey);
    $result = $resource->execute($url, self::REQUEST_POST, $resource->getResourceKey(), $params);
    $resource->refresh($result);

    return $resource;
  }

  /**
   * Updates the resource with the given parameters in an associative array.
   * @param string $url
   * @param array $params
   * @throws Exception|OmiseException
   */
  protected function g_update($url, $params) {
    $result = $this->execute($url, self::REQUEST_PATCH, $this->getResourceKey(), $params);
    $this->refresh($result);
  }

  /**
   * Destroys the resource.
   * @param string $url
   * @return OmiseApiResource
   * @throws Exception|OmiseException
   */
  protected function g_destroy($url) {
    $result = $this->execute($url, self::REQUEST_DELETE, $this->getResourceKey());
    $this->refresh($result, true);
  }

  /**
   * Reloads the resource with latest data.
   * @param string $url
   * @throws Exception|OmiseException
   */
  protected function g_reload($url) {
    $result = $this->execute($url, self::REQUEST_GET, $this->getResourceKey());
    $this->refresh($result);
  }

  /**
   * Makes a request and returns a decoded JSON data as an associative array.
   * @param string $url
   * @param string $requestMethod
   * @param array $params
   * @throws OmiseException
   * @return array
   */
  protected function execute($url, $requestMethod, $key, $params = null) {
    $ch = curl_init($url);
    curl_setopt_array($ch, $this->genOptions($requestMethod, $key.':', $params));
    // Make a request or thrown an exception.
    if(($result = curl_exec($ch)) === false) {
      $error = curl_error($ch);
      curl_close($ch);

      throw new Exception($error);
    }
    // Close.
    curl_close($ch);
    // Decode the JSON response as an associative array.
    $array = json_decode($result, true);

    // If response is invalid or not a JSON.
    if(count($array) === 0 || !isset($array['object'])) throw new Exception('Unknown error. (Bad Response)');
    // If response is an error object.
    if($array['object'] === 'error') throw OmiseException::getInstance($array);

    return $array;
  }

  /**
   * Creates an option for php-curl from the given request method and parameters in an associative array.
   * @param string $requestMethod
   * @param array $params
   * @return array
   */
  private function genOptions($requestMethod, $userpwd, $params) {
    $options = array(
        // Set the HTTP version to 1.1.
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        // Set the request method.
        CURLOPT_CUSTOMREQUEST => $requestMethod,
        // Set the user agent.
        CURLOPT_USERAGENT => "OmisePHP/".OMISE_PHP_LIB_VERSION." OmiseAPI/".OMISE_API_VERSION,
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
        CURLOPT_USERPWD => $userpwd,
        // CA bundle.
        CURLOPT_CAINFO => dirname(__FILE__).'/../../../data/ca_certificates.pem'
    );

    // Also merge POST parameters with the option.
    if(count($params) > 0) $options += array(CURLOPT_POSTFIELDS => http_build_query($params));

    return $options;
  }

  /**
   * Checks whether the resource has been destroyed.
   * @return OmiseApiResource
   */
  protected function isDestroyed() {
    return $this['deleted'];
  }

  /**
   * Returns the secret key.
   * @return string
   */
  protected function getResourceKey() {
    return $this->_secretkey;
  }
}
