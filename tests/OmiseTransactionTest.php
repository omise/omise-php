<?php

require_once 'PHPUnit.phar';
require_once dirname(__FILE__).'/../lib/Omise.php';

define('OMISE_PUBLIC_KEY', 'pkey');
define('OMISE_SECRET_KEY', 'skey');

class OmiseTransactionTest extends PHPUnit_Framework_TestCase {
  public static function setUpBeforeClass() {
    /** Do Nothing **/
  }

  public function setUp() {
    /** Do Nothing **/
  }

  public function testListAll() {
    $transactions = OmiseTransaction::retrieve();

    // objectを持っており、そのオブジェクトの実態がlistである
    $this->assertArrayHasKey('object', $transactions);
    $this->assertEquals('list', $transactions['object']);
  }

  public function testRetrieve() {
  	$transactions = OmiseTransaction::retrieve();
  	if(count($transactions['data']) > 0) {
  	  $transaction = OmiseTransaction::retrieve($transactions['data'][0]['id']);

  	  // objectを持っており、そのオブジェクトの実態がtransactionである
  	  $this->assertArrayHasKey('object', $transaction);
  	  $this->assertEquals('transaction', $transaction['object']);
  	}
  }

  public function tearDown() {
    /** Do Nothing **/
  }

  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
