<?php

namespace Omise\Tests;

require_once dirname(__FILE__).'/../../vendor/autoload.php';

define('OMISE_PUBLIC_KEY', 'pkey_test_4y9cewl0s1osh44ouud');
define('OMISE_SECRET_KEY', 'skey_test_4y9cewl0rgwji2kbbcb');

class ChargeTest extends \PHPUnit_Framework_TestCase {
  static $_charge;
  
  /**
   * テストケースに使うchargeを生成する。
   * ただし、createのテストは別途行う
   */
  public static function setUpBeforeClass() {
    $returnUrl = 'https://example.co.th/orders/384/complete';
    $amount = 100000;
    $currency = 'thb';
    $description = 'Order-384';
    $ip = '127.0.0.1';
    $token = \Omise\Token::create(
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
    
    self::$_charge = \Omise\Charge::create(array(
      'return_uri' => $returnUrl,
      'amount' => $amount,
      'currency' => $currency,
      'description' => $description,
      'ip' => $ip,
      'card' => $token['id']
    ));
  }

  public function setUp() {
    /** Do Nothing **/
  }

  /**
   * ----- list allのテスト -----
   * retrieve()に成功し、objectの値がlistであれば正しいとみなす
   */
  public function testListAll() {
    $charge = \Omise\Charge::retrieve();

    $this->assertArrayHasKey('object', $charge);
    $this->assertEquals('list', $charge['object']);
  }

  /**
   * ----- createのテスト -----
   * createに成功し、createで渡したパラメータの値になっていれば正しいとみなす
   */
  public function testCreate() {
    $returnUrl = 'https://example.co.th/orders/384/complete';
    $amount = 100000;
    $currency = 'thb';
    $description = 'Order-384';
    $ip = '127.0.0.1';
    $token = \Omise\Token::create(
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

    $charge = \Omise\Charge::create(array(
      'return_uri' => $returnUrl,
      'amount' => $amount,
      'currency' => $currency,
      'description' => $description,
      'ip' => $ip,
      'card' => $token['id']
    ));

    $this->assertEquals($returnUrl, $charge['return_uri']);
    $this->assertEquals($amount, $charge['amount']);
    $this->assertEquals($currency, $charge['currency']);
    $this->assertEquals($description, $charge['description']);
    $this->assertEquals($ip, $charge['ip']);
  }

  /**
   * ----- ritrieveのテスト -----
   * ritrieve(chargeID)に成功し、objectの値がchargeであれば正しいとみなす
   */
  public function testRetrieve() {
    $charge = \Omise\Charge::retrieve(self::$_charge['id']);

    $this->assertArrayHasKey('object', $charge);
    $this->assertEquals('charge', $charge['object']);
  }

  /**
   * ----- updateのテスト -----
   * updateに成功し、update後の値が反映されていれば正しいとみなす
   */
  public function testUpdate() {
    $description = 'Another description';

    $charge = \Omise\Charge::retrieve(self::$_charge['id']);
    $charge->update(array(
      'description' => $description
    ));

    $this->assertEquals($charge['description'], $description);
  }

  /**
   * ----- captureのテスト -----
   * captureに成功し、update後の値が反映されていれば正しいとみなす
   * ただし、テスト環境ではcreate直後にcaptureされているため、OmiseFailedCaptureExceptionが発生する
   */
  public function testCapture() {
    $charge = \Omise\Charge::retrieve(self::$_charge['id']);
    $charge->capture();

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
