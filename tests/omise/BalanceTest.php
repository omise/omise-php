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
   * OmiseBalance class must be contain some method below.
   */
  public function testMethodExists() {
    $this->assertTrue(method_exists('OmiseBalance', 'retrieve'));
    $this->assertTrue(method_exists('OmiseBalance', 'reload'));
    $this->assertTrue(method_exists('OmiseBalance', 'getUrl'));
  }

  /**
   * Assert that a balance object is returned after a successful retrieve.
   */
  public function testRetrieveOmiseBalanceObject() {
    $balance = OmiseBalance::retrieve();

    $this->assertArrayHasKey('object', $balance);
    $this->assertEquals('balance', $balance['object']);
  }

  /**
   * Assert that a balance object is returned after a successful retrieve.
   * It should be contain all of value like below
   * (use it when run test with the real server).
   */
  public function testValidateOmiseBalanceObjectRetrievedStructure() {
    $balance = OmiseBalance::retrieve();

    $this->assertArrayHasKey('object', $balance);
    $this->assertInternalType('string', $balance['object']);

    $this->assertArrayHasKey('livemode', $balance);
    $this->assertInternalType('boolean', $balance['livemode']);

    $this->assertArrayHasKey('available', $balance);
    $this->assertInternalType('int', $balance['available']);

    $this->assertArrayHasKey('total', $balance);
    $this->assertInternalType('int', $balance['total']);

    $this->assertArrayHasKey('currency', $balance);
    $this->assertInternalType('string', $balance['currency']);
  }

  /**
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
