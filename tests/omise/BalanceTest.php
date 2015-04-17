<?php

require_once dirname(__FILE__).'/TestConfig.php';
if(version_compare(phpversion(), '5.3.2') >= 0 && file_exists(dirname(__FILE__).'/../../vendor/autoload.php')) {
  require_once dirname(__FILE__).'/../../vendor/autoload.php';
} else {
  require_once dirname(__FILE__).'/../../lib/Omise.php';
}

class OmiseBalanceTest extends PHPUnit_Framework_TestCase {
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
  public function testOmiseBalanceMethodExists() {

    // This's need for retrieve users balance.
    $this->assertTrue(method_exists('OmiseBalance', 'retrieve'));

    // This's need for reload user balance.
    $this->assertTrue(method_exists('OmiseBalance', 'reload'));
  }

  /**
   * ----- Test retrieve -----
   * Assert that a balance object is returned after a successful retrieve.
   */
  public function testRetrieve() {
    $balance = OmiseBalance::retrieve();

    $this->assertArrayHasKey('object', $balance);
    $this->assertEquals('balance', $balance['object']);
  }

  /**
   * ----- Test response structure -----
   * Assert that a balance object is returned after a successful retrieve.
   * And It should receive a right key that it should be
   * (It's need for first time when run test with the real server).
   */
  public function testJsonResponseStructure() {
    $balance = OmiseBalance::retrieve();

    $this->assertArrayHasKey('object', $balance);
    $this->assertArrayHasKey('livemode', $balance);
    $this->assertArrayHasKey('available', $balance);
    $this->assertArrayHasKey('total', $balance);
    $this->assertArrayHasKey('currency', $balance);
  }

  /**
   * ----- Test reload -----
   * Assert that a balance object is returned after a successful reload.
   */
  public function testReload() {
    $balance = OmiseBalance::retrieve();
    $balance->reload();

    $this->assertArrayHasKey('object', $balance);
    $this->assertEquals('balance', $balance['object']);
  }

  public function tearDown() {
    /** Do Nothing **/
  }

  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
