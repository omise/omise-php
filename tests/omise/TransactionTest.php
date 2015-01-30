<?php

require_once dirname(__FILE__).'/TestConfig.php';
if(version_compare(phpversion(), '5.3.2') >= 0 && file_exists(dirname(__FILE__).'/../../vendor/autoload.php')) {
  require_once dirname(__FILE__).'/../../vendor/autoload.php';
} else {
  require_once dirname(__FILE__).'/../../lib/Omise.php';
}

class TransactionTest extends PHPUnit_Framework_TestCase {
  public static function setUpBeforeClass() {
    /** Do Nothing **/
  }

  public function setUp() {
    /** Do Nothing **/
  }

  /**
   * ----- Test list all -----
   * Assert that a list of transactions object could be successfully retrieved.
   */
  public function testListAll() {
    $transactions = OmiseTransaction::retrieve();

    $this->assertArrayHasKey('object', $transactions);
    $this->assertEquals('list', $transactions['object']);
  }

  /**
   * ----- Test retrieve -----
   * Assert that a transaction object is returned after a successful retrieve.
   * This test will echo to STDOUT if there is no transaction available for testing.
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
