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
   * OmiseTransfer should contain some method like below.
   */
  public function testMethodExists() {
    $this->assertTrue(method_exists('OmiseTransfer', 'retrieve'));
    $this->assertTrue(method_exists('OmiseTransfer', 'create'));
    $this->assertTrue(method_exists('OmiseTransfer', 'reload'));
    $this->assertTrue(method_exists('OmiseTransfer', 'save'));
    $this->assertTrue(method_exists('OmiseTransfer', 'update'));
    $this->assertTrue(method_exists('OmiseTransfer', 'destroy'));
    $this->assertTrue(method_exists('OmiseTransfer', 'isDestroyed'));
    $this->assertTrue(method_exists('OmiseTransfer', 'getUrl'));
  }

  /**
   * Assert that a list of transfer object could be successfully retrieved.
   */
  public function testRetrieveTransferListObject() {
    $transfers = OmiseTransfer::retrieve();

    $this->assertArrayHasKey('object', $transfers);
    $this->assertEquals('list', $transfers['object']);
  }

  /**
   * Assert that a transfer is successfully created with the given parameters set.
   */
  public function testCreate() {
    self::$_transter = OmiseTransfer::create(array('amount' => 100000));

    $this->assertArrayHasKey('object', self::$_transter);
    $this->assertEquals('transfer', self::$_transter['object']);
  }

  /**
   * Assert that a transfer object is returned after a successful retrieve.
   */
  public function testRetrieve() {
    $transfer = OmiseTransfer::retrieve('trsf_test_4zmrjicrvw7j6uhv1l4');

    $this->assertArrayHasKey('object', $transfer);
    $this->assertEquals('transfer', $transfer['object']);
  }

  /**
   * Assert that a transfer is successfully updated with the given parameters set.
   */
  public function testUpdate() {
    $amount = 5000;

    self::$_transter['amount'] = $amount;
    self::$_transter->save();

    $this->assertEquals($amount, self::$_transter['amount']);
  }

  /**
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
