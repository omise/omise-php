<?php

namespace Omise\OmisePHP\Tests;

use Omise\OmisePHP\OmiseCustomer;
use Omise\OmisePHP\OmiseCard;

define('OMISE_PUBLIC_KEY', 'pkey');
define('OMISE_SECRET_KEY', 'skey');

class OmiseCardTest extends \PHPUnit_Framework_TestCase {
  static $customerID = 'cust_test_4xsjvylia03ur542vn6';
  static $cardID = 'card_test_4xsjw0t21xaxnuzi9gs';
  
  public static function setUpBeforeClass() {
  	$customer = OmiseCustomer::retrieve();
  	
  	if(count($customer['data']) > 0) {
  	  OmiseCardTest::$customerID = $customer['data'][0]['id'];
  	  
  	  $customer = OmiseCustomer::retrieve(OmiseCardTest::$customerID);
  	  $cards = $customer->getCards();
  	  if(count($cards) > 0) {
  	  	foreach ($cards as $key => $value) {
  	  	  OmiseCardTest::$cardID = $value['id'];
  	  	  break;
  	  	}
  	  }
  	}
  }

  public function setUp() {
    /** Do Nothing **/
  }
  
  public function testListAll() {
    $customer = OmiseCustomer::retrieve(OmiseCardTest::$customerID);
    
    // objectを持っており、そのオブジェクトの実態がlistである
    $this->assertArrayHasKey('object', $customer);
    $this->assertEquals('customer', $customer['object']);

    $cards = $customer->getCards();
    // $cardsが全てCardオブジェクトである
    if(count($cards) > 0) {
      foreach ($cards as $key => $value) {
        $this->assertArrayHasKey('object', $value);
        $this->assertEquals('card', $value['object']);
      }
    }
  }
  
  public function testRetrieve() {
  	$customer = OmiseCustomer::retrieve(OmiseCardTest::$customerID);
  	$card = $customer->getCards()->retrieve(OmiseCardTest::$cardID);

  	// objectを持っており、そのオブジェクトの実態がcardである
    $this->assertArrayHasKey('object', $card);
    $this->assertEquals('card', $card['object']);
  }

  public function testReload() {
  	$customer = OmiseCustomer::retrieve(OmiseCardTest::$customerID);
  	$card = $customer->getCards()->retrieve(OmiseCardTest::$cardID);
  	$card->reload();
  
  	// objectを持っており、そのオブジェクトの実態がcardである
  	$this->assertArrayHasKey('object', $card);
  	$this->assertEquals('card', $card['object']);
  }

  public function testUpdate() {
  	$month = 11;
  	$year = 2017;
  	$name = 'Somchai Praset';
  	$postalcode = '10310';
  	
  	$customer = OmiseCustomer::retrieve(OmiseCardTest::$customerID);
  	$card = $customer->getCards()->retrieve(OmiseCardTest::$cardID);
  	$card->update(array(
      'expiration_month' => $month,
      'expiration_year' => $year,
      'name' => $name,
      'postal_code' => $postalcode
    ));

    // updateした値になっている
    $this->assertEquals($month, $card['expiration_month']);
    $this->assertEquals($year, $card['expiration_year']);
    $this->assertEquals($name, $card['name']);
    $this->assertEquals($postalcode, $card['postal_code']);
  }
  
  /*
   * destroyのテストを有効にする場合コメント解除
  public function testDestroy() {
    $customer = OmiseCustomer::retrieve(OmiseCardTest::$customerID);
    $card = $customer->getCards()->retrieve(OmiseCardTest::$cardID);
    $card->destroy();

    // 削除されている
    $this->assertTrue($card->isDestroyed());
  }
  */

  public function tearDown() {
    /** Do Nothing **/
  }

  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
