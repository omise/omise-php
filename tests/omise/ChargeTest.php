<?php

require_once dirname(__FILE__).'/TestConfig.php';
if(version_compare(phpversion(), '5.3.2') >= 0 && file_exists(dirname(__FILE__).'/../../vendor/autoload.php')) {
  require_once dirname(__FILE__).'/../../vendor/autoload.php';
} else {
  require_once dirname(__FILE__).'/../../lib/Omise.php';
}

class ChargeTest extends PHPUnit_Framework_TestCase {
  static $_charge;

  /**
   * Setup the charge to be used in test cases (except in create).
   */
  public static function setUpBeforeClass() {
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

    self::$_charge = OmiseCharge::create(array(
      'return_uri' => $returnUrl,
      'amount' => $amount,
      'currency' => $currency,
      'description' => $description,
      'ip' => $ip,
      'capture' => false,
      'card' => $token['id']
    ));
  }

  public function setUp() {
    /** Do Nothing **/
  }

  /**
   * ----- Test list all -----
   * Assert that a list of charge object could be successfully retrieved.
   */
  public function testListAll() {
    $charge = OmiseCharge::retrieve();

    $this->assertArrayHasKey('object', $charge);
    $this->assertEquals('list', $charge['object']);
  }

  /**
   * ----- Test create -----
   * Assert that a charge is successfully created with the given parameters set.
   */
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

    $this->assertEquals($returnUrl, $charge['return_uri']);
    $this->assertEquals($amount, $charge['amount']);
    $this->assertEquals($currency, $charge['currency']);
    $this->assertEquals($description, $charge['description']);
    $this->assertEquals($ip, $charge['ip']);
  }

  /**
   * ----- Test retrieve -----
   * Assert that a charge object is returned after a successful retrieve.
   */
  public function testRetrieve() {
    $charge = OmiseCharge::retrieve(self::$_charge['id']);

    $this->assertArrayHasKey('object', $charge);
    $this->assertEquals('charge', $charge['object']);
  }

  /**
   * ----- Test update -----
   * Assert that a charge is successfully updated with the given parameters set.
   */
  public function testUpdate() {
    $description = 'Another description';

    $charge = OmiseCharge::retrieve(self::$_charge['id']);
    $charge->update(array(
      'description' => $description
    ));

    $this->assertEquals($charge['description'], $description);
  }

  /**
   * ----- Test capture -----
   * Assert that a captured flag is set after charge is successfully captured.
   *
   * In our test environment, the charge will be auto-captured after create
   * and this test will raise OmiseFailedCaptureException.
   */
  public function testCapture() {
    $charge = OmiseCharge::retrieve(self::$_charge['id']);
    $charge->capture();

    $this->assertArrayHasKey('object', $charge);
    $this->assertEquals('charge', $charge['object']);
    $this->assertTrue($charge['captured']);
  }

  public function tearDown() {
    /** Do Nothing **/
  }

  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
