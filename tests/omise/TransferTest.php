<?php

require_once dirname(__FILE__).'/TestConfig.php';
if(version_compare(phpversion(), '5.3.2') >= 0 && file_exists(dirname(__FILE__).'/../../vendor/autoload.php')) {
  require_once dirname(__FILE__).'/../../vendor/autoload.php';
} else {
  require_once dirname(__FILE__).'/../../lib/Omise.php';
}

class TransferTest extends PHPUnit_Framework_TestCase {
  static $_transter;

  /**
   * Setup the transfer to be used in test cases (except in create).
   */
  public static function setUpBeforeClass() {
  	/** Do Nothing **/
  }

  public function setUp() {
    /** Do Nothing **/
  }

  /**
   * ----- Test list all -----
   * Assert that a list of transfer object could be successfully retrieved.
   */
  public function testListAll() {
    $transfers = OmiseTransfer::retrieve();

    $this->assertArrayHasKey('object', $transfers);
    $this->assertEquals('list', $transfers['object']);
  }

  /**
   * ----- Test create -----
   * Assert that a transfer is successfully created with the given parameters set.
   */
  public function testCreate() {
  	$amount = 100000;

    self::$_transter = OmiseTransfer::create(array(
      'amount' => $amount
    ));

    $this->assertEquals($amount, self::$_transter['amount']);
  }

  /**
   * ----- Test retrieve -----
   * Assert that a transfer object is returned after a successful retrieve.
   */
  public function testRetrieve() {
  	$transfer = OmiseTransfer::retrieve(self::$_transter['id']);

  	$this->assertArrayHasKey('object', $transfer);
  	$this->assertEquals('transfer', $transfer['object']);
  }

  /**
   * ----- Test update -----
   * Assert that a transfer is successfully updated with the given parameters set.
   */
  public function testUpdate() {
    $amount = 5000;

  	self::$_transter['amount'] = $amount;
  	self::$_transter->save();

    $this->assertEquals($amount, self::$_transter['amount']);
  }

  /**
   * ----- Test destroy -----
   * Assert that a destroyed flag is set after a transfer is successfully destroyed.
   */
  public function testDestroy() {
  	self::$_transter->destroy();

  	$this->assertTrue(self::$_transter->isDestroyed());
  }

  public function tearDown() {
    /** Do Nothing **/
  }

  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
