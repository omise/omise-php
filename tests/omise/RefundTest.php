<?php

require_once dirname(__FILE__).'/TestConfig.php';
if(version_compare(phpversion(), '5.3.2') >= 0 && file_exists(dirname(__FILE__).'/../../vendor/autoload.php')) {
  require_once dirname(__FILE__).'/../../vendor/autoload.php';
} else {
  require_once dirname(__FILE__).'/../../lib/Omise.php';
}

class RefundTest extends PHPUnit_Framework_TestCase {
  static $_charge;

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
      'card' => $token['id']
    ));
  }

  public function setUp() {
   /** Do Nothing **/
  }

  /**
   * ----- Test list all -----
   * Assert that a list of refunds object could be successfully retrieved.
   */
  public function testListAll() {
    $charge = OmiseCharge::retrieve(self::$_charge['id']);
    $refunds = $charge->refunds();

    $this->assertArrayHasKey('object', $refunds);
    $this->assertEquals('list', $refunds['object']);
  }

  /**
   * ----- Test create -----
   * Assert that a refund is successfully created with the given parameters set.
   */
  public function testCreate() {
    $charge = OmiseCharge::retrieve(self::$_charge['id']);
    $refunds = $charge->refunds();

  	$amount = 10000;
  	$refund = $refunds->create(array('amount' => $amount));

  	$this->assertEquals($amount, $refund['amount']);
  }

  /**
   * ----- Test retrieve -----
   */
  public function testRetrieve() {
    $charge = OmiseCharge::retrieve(self::$_charge['id']);
    $refunds = $charge->refunds();

  	$refund = $refunds->retrieve($refunds->create(array('amount' => 10000))['id']);

  	$this->assertArrayHasKey('object', $refund);
  	$this->assertEquals('refund', $refund['object']);
  }

  public function tearDown() {
  	/** Do Nothing **/
  }

  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
