<?php

require_once dirname(__FILE__).'/TestConfig.php';
if(version_compare(phpversion(), '5.3.2') >= 0 && file_exists(dirname(__FILE__).'/../../vendor/autoload.php')) {
  require_once dirname(__FILE__).'/../../vendor/autoload.php';
} else {
  require_once dirname(__FILE__).'/../../lib/Omise.php';
}

class OmiseAccountTest extends PHPUnit_Framework_TestCase {
  public static function setUpBeforeClass() {
    /** Do Nothing **/
  }

  public function setUp() {
    /** Do Nothing **/
  }

  /**
   * OmiseAccount class must be contain some method below.
   */
  public function testMethodExists() {
    $this->assertTrue(method_exists('OmiseAccount', 'retrieve'));
    $this->assertTrue(method_exists('OmiseAccount', 'reload'));
    $this->assertTrue(method_exists('OmiseAccount', 'getUrl'));
  }

  /**
   * Assert that an account object is returned after a successful retrieve.
   */
  public function testRetrieveOmiseAccountObject() {
    $account = OmiseAccount::retrieve();

    $this->assertArrayHasKey('object', $account);
    $this->assertEquals('account', $account['object']);
  }

  /**
   * Assert that an account object is returned after a successful retrieve.
   * It should be contain all of value like below
   * (use it when run test with the real server).
   */
  public function testValidateOmiseAccountObjectRetrievedStructure() {
    $account = OmiseAccount::retrieve();

    $this->assertArrayHasKey('object', $account);
    $this->assertInternalType('string', $account['object']);

    $this->assertArrayHasKey('id', $account);
    $this->assertInternalType('string', $account['id']);

    $this->assertArrayHasKey('email', $account);
    $this->assertInternalType('string', $account['email']);
    
    $this->assertArrayHasKey('created', $account);
    $this->assertInternalType('string', $account['created']);
  }

  /**
   * Assert that an account object is returned after a successful reload.
   */
  public function testReload() {
    $account = OmiseAccount::retrieve();
    $account->reload();

    $this->assertArrayHasKey('object', $account);
    $this->assertEquals('account', $account['object']);
  }

  public function tearDown() {
    /** Do Nothing **/
  }

  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
