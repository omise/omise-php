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
   * ----- Test reload -----
   * Assert that an account object is returned after a successful reload.
   */
  public function testReload() {
    $account = OmiseAccount::retrieve();
    $account->reload();

    $this->assertArrayHasKey('object', $account);
    $this->assertEquals('account', $account['object']);
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
   * ----- Test singleton -----
   * Assert that retrieving the account twice returns the same instance.
   */
  public function testSameInstance() {
    $account1 = OmiseAccount::retrieve();
    $account2 = OmiseAccount::retrieve();

    $this->assertTrue($account1 === $account2);
  }

  public function tearDown() {
    /** Do Nothing **/
  }

  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
