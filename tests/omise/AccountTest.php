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
   * ----- Test OmiseAccount's method exists -----
   * OmiseAccount should contain some method like below.
   */
  public function testOmiseAccountMethodExists() {

    $this->assertTrue(method_exists('OmiseAccount', 'retrieve'));
    $this->assertTrue(method_exists('OmiseAccount', 'reload'));
  }

  /**
   * ----- Test retrieve -----
   * Assert that an account object is returned after a successful retrieve.
   */
  public function testRetrieve() {
    $account = OmiseAccount::retrieve();

    $this->assertArrayHasKey('object', $account);
    $this->assertEquals('account', $account['object']);
  }

  /**
   * ----- Test response structure -----
   * Assert that an account object is returned after a successful retrieve.
   * And It should receive a right key that it should be
   * (It's need for first time when run test with the real server).
   */
  public function testJsonResponseStructure() {
    $account = OmiseAccount::retrieve();

    $this->assertArrayHasKey('object', $account);
    $this->assertArrayHasKey('id', $account);
    $this->assertArrayHasKey('email', $account);
    $this->assertArrayHasKey('created', $account);
  }

  /**
   * ----- Test reload -----
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
