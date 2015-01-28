<?php

if(version_compare(phpversion(), '5.3.2') >= 0) {
  require_once dirname(__FILE__).'/../../vendor/autoload.php';
} else {
  require_once dirname(__FILE__).'/../../lib/Omise.php';
}

define('OMISE_PUBLIC_KEY', 'pkey');
define('OMISE_SECRET_KEY', 'skey');

class TransactionTest extends PHPUnit_Framework_TestCase {
  public static function setUpBeforeClass() {
    /** Do Nothing **/
  }

  public function setUp() {
    /** Do Nothing **/
  }

  /**
   * ----- ritrieveのテスト -----
   * ritrieve()に成功し、objectの値がlistであれば正しいとみなす
   */
  public function testListAll() {
    $transactions = OmiseTransaction::retrieve();

    $this->assertArrayHasKey('object', $transactions);
    $this->assertEquals('list', $transactions['object']);
  }

  /**
   * ----- ritrieveのテスト -----
   * ritrieve(transactionID)に成功し、objectの値がtransactionであれば正しいとみなす。
   * 有効なtransactionが存在しなく、テストが行えなかった場合標準出力でメッセージを出力する。
   */
  public function testRetrieve() {
  	$transactions = OmiseTransaction::retrieve();
  	if(count($transactions['data']) > 0) {
  	  $transaction = OmiseTransaction::retrieve($transactions['data'][0]['id']);

  	  $this->assertArrayHasKey('object', $transaction);
  	  $this->assertEquals('transaction', $transaction['object']);
  	} else {
  		echo 'Can not run  testRetrieve()';
  	}
  }

  public function tearDown() {
    /** Do Nothing **/
  }

  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
