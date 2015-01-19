<?php

require_once 'PHPUnit.phar';
require_once dirname(__FILE__).'/../lib/Omise.php';

define('OMISE_PUBLIC_KEY', 'pkey');
define('OMISE_SECRET_KEY', 'skey');

class OmiseChargeTest extends PHPUnit_Framework_TestCase {
  static $chargeID = 'chrg_test_4xso2s8ivdej29pqnhz';
  
  public static function setUpBeforeClass() {
    $charge = OmiseCharge::retrieve();
    if(count($charge['data']) > 0) {
      OmiseChargeTest::$chargeID = $charge['data'][0]['id'];
    }
  }

  public function setUp() {
    /** Do Nothing **/
  }

  public function testListAll() {
    $charge = OmiseCharge::retrieve();

    // objectを持っており、そのオブジェクトの実態がlistである
    $this->assertArrayHasKey('object', $charge);
    $this->assertEquals('list', $charge['object']);
  }

  public function testCreate() {
    $returnUrl = 'https://example.co.th/orders/384/complete';
    $amount = 100000;
    $currency = 'thb';
    $description = 'Order-384';
    $ip = '127.0.0.1';
    $token = OmiseToken::create(
      array('card' => array(
        'name' => 'Somchai Prasert',
        'number' => '4242424242424242',
        'expiration_month' => 10,
        'expiration_year' => 2018,
        'city' => 'Bangkok',
        'postal_code' => '10320',
        'security_code' => 123
      ))
    );

    $charge = OmiseCharge::create(array(
      'return_uri' => $returnUrl,
      'amount' => $amount,
      'currency' => $currency,
      'description' => $description,
      'ip' => $ip,
      'card' => $token['id']
    ));

    // createした値になっている
    $this->assertEquals($returnUrl, $charge['return_uri']);
    $this->assertEquals($amount, $charge['amount']);
    $this->assertEquals($currency, $charge['currency']);
    $this->assertEquals($description, $charge['description']);
    $this->assertEquals($ip, $charge['ip']);
  }
  
  public function testRetrieve() {
  	$charge = OmiseCharge::retrieve(OmiseChargeTest::$chargeID);

  	// objectを持っており、そのオブジェクトの実態がchargeであり、目的のchargeオブジェクトである
  	$this->assertArrayHasKey('object', $charge);
  	$this->assertEquals('charge', $charge['object']);
  	$this->assertEquals(OmiseChargeTest::$chargeID, $charge['id']);
  }
  
  public function testUpdate() {
    $description = 'Another description';
  	
    $charge = OmiseCharge::retrieve(OmiseChargeTest::$chargeID);
    $charge->update(array(
      'description' => $description
    ));

    // 正しくアップデートされている
  	$this->assertEquals($charge['description'], $description);
  }
  
  public function testCapture() {
    $charge = OmiseCharge::retrieve(OmiseChargeTest::$chargeID);
    $charge->capture();

    // objectを持っており、そのオブジェクトの実態がchargeであり、captureがtrueである
  	$this->assertArrayHasKey('object', $charge);
  	$this->assertEquals('charge', $charge['object']);
    $this->assertTrue($charge['capture']);
  }

  public function tearDown() {
    /** Do Nothing **/
  }

  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
