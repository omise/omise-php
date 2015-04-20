<?php

require_once dirname(__FILE__).'/TestConfig.php';
if(version_compare(phpversion(), '5.3.2') >= 0 && file_exists(dirname(__FILE__).'/../../vendor/autoload.php')) {
  require_once dirname(__FILE__).'/../../vendor/autoload.php';
} else {
  require_once dirname(__FILE__).'/../../lib/Omise.php';
}

class RefundTest extends PHPUnit_Framework_TestCase {
  public static function setUpBeforeClass() {
    /** Do Nothing **/
  }

  public function setUp() {
    /** Do Nothing **/
  }

  /**
   * Assert that a list of refunds object could be successfully retrieved.
   */
  public function testRetrieveChargeRefundListObject() {
    $charge = OmiseCharge::retrieve('chrg_test_4zmrjgxdh4ycj2qncoj');
    $refunds = $charge->refunds();

    $this->assertArrayHasKey('object', $refunds);
    $this->assertEquals('list', $refunds['object']);
  }

  /**
   * Assert that a refund is successfully created with the given parameters set.
   */
  public function testCreate() {
    $charge = OmiseCharge::retrieve('chrg_test_4zmrjgxdh4ycj2qncoj');
    $refunds = $charge->refunds();

    $amount = 10000;
    $refund = $refunds->create(array('amount' => $amount));

    $this->assertEquals($amount, $refund['amount']);
  }

  /**
   */
  public function testRetrieveSpecificChargeRefundObject() {
    $charge = OmiseCharge::retrieve('chrg_test_4zmrjgxdh4ycj2qncoj');
    $refunds = $charge->refunds();

    $create = $refunds->create(array('amount' => 10000));
    $refund = $refunds->retrieve($create['id']);

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
