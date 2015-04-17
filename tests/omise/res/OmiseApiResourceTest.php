<?php

require_once dirname(__FILE__).'/../TestConfig.php';
if(version_compare(phpversion(), '5.3.2') >= 0 && file_exists(dirname(__FILE__).'/../../../vendor/autoload.php')) {
  require_once dirname(__FILE__).'/../../../vendor/autoload.php';
} else {
  require_once dirname(__FILE__).'/../../../lib/Omise.php';
}

class OmiseApiResourceTest extends PHPUnit_Framework_TestCase {
  /**
   * This method's use for test with private/protecterd method.
   */
  protected static function getMethod($clazz, $requestMethod, array $args = array()) {
    $clazz  = new ReflectionClass($clazz);
    $method = $clazz->getMethod($requestMethod);
    $method->setAccessible(true);

    return $method->invokeArgs($clazz, $args);
  }

  public static function setUpBeforeClass() {
    /** Do Nothing **/
  }

  public function setUp() {
    /** Do Nothing **/
  }

  /**
   * Whatever that g_retrieve method return
   * should be an instance of whatever it call.
   */
  public function testRetrieveMethod() {
    $object = self::getMethod('OmiseApiResource', 'g_retrieve', array('OmiseAccount', 'http://api.omise.co/account'));

    $this->assertInstanceOf('OmiseAccount', $object);
  }

  /**
   * Whatever that g_create method return
   * should be an instance of whatever it call.
   */
  public function testCreateMethod() {
    $mock = array('email'       => 'john.doe@example.com',
                  'description' => 'John Doe (id: 30)');

    $object = self::getMethod('OmiseApiResource', 'g_create', array('OmiseCustomer', 'http://api.omise.co/customers', $mock));

    $this->assertInstanceOf('OmiseCustomer', $object);
  }
 
  public function tearDown() {
    /** Do Nothing **/
  }

  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}