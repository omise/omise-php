<?php

namespace Omise\Tests;

use Omise\OmiseTransfer;

define('OMISE_PUBLIC_KEY', 'pkey');
define('OMISE_SECRET_KEY', 'skey');

class OmiseTransferTest extends \PHPUnit_Framework_TestCase {
  static $transferID = 'trsf_test_4y3miv1nhy0rceit4w4';
  
  public static function setUpBeforeClass() {
  	$transfers = OmiseTransfer::retrieve();
  	
    if(count($transfers['data']) > 0) {
  	  OmiseTransferTest::$transferID = $transfers['data'][0]['id'];
    }
  }

  public function setUp() {
    /** Do Nothing **/
  }

  public function testListAll() {
    $transfers = OmiseTransfer::retrieve();

    // objectを持っており、そのオブジェクトの実態がlistである
    $this->assertArrayHasKey('object', $transfers);
    $this->assertEquals('list', $transfers['object']);
  }

  public function testCreate() {
  	$amount = 100000;
  	
    $transfer = OmiseTransfer::create(array(
      'amount' => $amount
    ));

    // createした値になっている
    $this->assertEquals($amount, $transfer['amount']);
  }

  public function testRetrieve() {
  	$transfer = OmiseTransfer::retrieve(OmiseTransferTest::$transferID);
  
  	// objectを持っており、そのオブジェクトの実態がtransferである
  	$this->assertArrayHasKey('object', $transfer);
  	$this->assertEquals('transfer', $transfer['object']);
  }
  
  public function testUpdate() {
    $amount = 5000;
    
  	$transfer = OmiseTransfer::retrieve(OmiseTransferTest::$transferID);
  	$transfer['amount'] = $amount;
  	$transfer->save();
    
    // updateした値になっている
    $this->assertEquals($amount, $transfer['amount']);
  }
  
  public function testDestroy() {
  	$transfer = OmiseTransfer::retrieve(OmiseTransferTest::$transferID);
  	$transfer->destroy();
  
  	// 削除されている
  	$this->assertTrue($transfer->isDestroyed());
  }

  public function tearDown() {
    /** Do Nothing **/
  }

  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
