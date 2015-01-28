<?php

namespace Omise\Tests;

require_once dirname(__FILE__).'/../../vendor/autoload.php';

define('OMISE_PUBLIC_KEY', 'pkey');
define('OMISE_SECRET_KEY', 'skey');

class TransferTest extends \PHPUnit_Framework_TestCase {
  static $_transter;
  
  /**
   * テストケースに使うTransferを作っておく
   */
  public static function setUpBeforeClass() {
  	/** Do Nothing **/
  }

  public function setUp() {
    /** Do Nothing **/
  }

  /**
   * ----- list allのテスト -----
   * retrieve()に成功し、objectの値がlistであれば正しいとみなす
   */
  public function testListAll() {
    $transfers = \Omise\Transfer::retrieve();

    $this->assertArrayHasKey('object', $transfers);
    $this->assertEquals('list', $transfers['object']);
  }

  /**
   * ----- createのテスト -----
   * createに成功し、createで渡したパラメータの値になっていれば正しいとみなす
   */
  public function testCreate() {
  	$amount = 100000;
  	
    self::$_transter = \Omise\Transfer::create(array(
      'amount' => $amount
    ));

    $this->assertEquals($amount, self::$_transter['amount']);
  }

  /**
   * ----- ritrieveのテスト -----
   * ritrieveに成功し、objectの値がtransferであれば正しいとみなす
   */
  public function testRetrieve() {
  	$transfer = \Omise\Transfer::retrieve(self::$_transter['id']);

  	$this->assertArrayHasKey('object', $transfer);
  	$this->assertEquals('transfer', $transfer['object']);
  }

  /**
   * ----- updateのテスト -----
   * updateに成功し、update後の値が反映されていれば正しいとみなす
   */
  public function testUpdate() {
    $amount = 5000;
    
  	self::$_transter['amount'] = $amount;
  	self::$_transter->save();
    
    $this->assertEquals($amount, self::$_transter['amount']);
  }

  /**
   * ----- destroyのテスト -----
   * destroyに成功し、destroyedのフラグが立っていれば正しいとみなす
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
