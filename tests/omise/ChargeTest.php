<?php

require_once dirname(__FILE__).'/TestConfig.php';
if(version_compare(phpversion(), '5.3.2') >= 0 && file_exists(dirname(__FILE__).'/../../vendor/autoload.php')) {
  require_once dirname(__FILE__).'/../../vendor/autoload.php';
} else {
  require_once dirname(__FILE__).'/../../lib/Omise.php';
}

class ChargeTest extends PHPUnit_Framework_TestCase {
  public static function setUpBeforeClass() {
    /** Do Nothing **/
  }

  public function setUp() {
    /** Do Nothing **/
  }

  /**
   * OmiseCharge class must be contain some method below.
   */
  public function testMethodExists() {
    $this->assertTrue(method_exists('OmiseCharge', 'reload'));
    $this->assertTrue(method_exists('OmiseCharge', 'create'));
    $this->assertTrue(method_exists('OmiseCharge', 'update'));
    $this->assertTrue(method_exists('OmiseCharge', 'capture'));
    $this->assertTrue(method_exists('OmiseCharge', 'refunds'));
    $this->assertTrue(method_exists('OmiseCharge', 'getUrl'));
  }

  /**
   * Assert that a list of charge object could be successfully retrieved.
   */
  public function testRetrieveChargeListObject() {
    $charge = OmiseCharge::retrieve();

    $this->assertArrayHasKey('object', $charge);
    $this->assertEquals('list', $charge['object']);
  }

  /**
   * Assert that a charge is successfully created with the given parameters set.
   */
  public function testCreate() {
    $charge = OmiseCharge::create(array('amount'      => 100000,
                                        'currency'    => 'thb',
                                        'description' => 'Order-384',
                                        'ip'          => '127.0.0.1',
                                        'card'        => 'tokn_test_4zmrjhuk2rndz24a6x0'));

    $this->assertArrayHasKey('object', $charge);
    $this->assertEquals('charge', $charge['object']);
  }

  /**
   * Assert that a charge object is returned after a successful retrieve.
   */
  public function testRetrieveSpecificChargeObject() {
    $charge = OmiseCharge::retrieve('chrg_test_4zmrjgxdh4ycj2qncoj');

    $this->assertArrayHasKey('object', $charge);
    $this->assertEquals('charge', $charge['object']);
  }

  /**
   * Assert that a charge is successfully updated with the given parameters set.
   */
  public function testUpdate() {
    $charge = OmiseCharge::retrieve('chrg_test_4zmrjgxdh4ycj2qncoj');
    $charge->update(array('description' => 'Another description'));

    $this->assertArrayHasKey('object', $charge);
    $this->assertEquals('charge', $charge['object']);
  }

  /**
   * Assert that a captured flag is set after charge is successfully captured.
   *
   * In our test environment, the charge will be auto-captured after create
   * and this test will raise OmiseFailedCaptureException.
   */
  public function testCapture() {
    $charge = OmiseCharge::retrieve('chrg_test_4zmrjgxdh4ycj2qncoj');
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
