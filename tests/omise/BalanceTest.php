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
   * ----- Test reload -----
   * Assert that a balance object is returned after a successful reload.
   */
  public function testReload() {
    $balance = OmiseBalance::retrieve();
    $balance->reload();

    $this->assertArrayHasKey('object', $balance);
    // $this->assertEquals('balance', $balance['object']);
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

  public function tearDown() {
    /** Do Nothing **/
  }

  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
