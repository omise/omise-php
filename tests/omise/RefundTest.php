<?php require_once dirname(__FILE__).'/TestConfig.php';

class RefundTest extends TestConfig {
  /**
   * Assert that a list of refunds object could be successfully retrieved.
   *
   */
  public function testRetrieveChargeRefundListObject() {
    $charge = OmiseCharge::retrieve('chrg_test_4zmrjgxdh4ycj2qncoj');
    $refunds = $charge->refunds();

    $this->assertArrayHasKey('object', $refunds);
    $this->assertEquals('list', $refunds['object']);
  }

  /**
   * Assert that a refund is successfully created with the given parameters set.
   *
   */
  public function testCreate() {
    $charge = OmiseCharge::retrieve('chrg_test_4zmrjgxdh4ycj2qncoj');
    $refunds = $charge->refunds();

    $refund = $refunds->create(array('amount' => 10000));

    $this->assertArrayHasKey('object', $refund);
    $this->assertEquals('refund', $refund['object']);
  }

  /**
   *
   */
  public function testRetrieveSpecificChargeRefundObject() {
    $charge = OmiseCharge::retrieve('chrg_test_4zmrjgxdh4ycj2qncoj');
    $refunds = $charge->refunds();

    $create = $refunds->create(array('amount' => 10000));
    $refund = $refunds->retrieve($create['id']);

    $this->assertArrayHasKey('object', $refund);
    $this->assertEquals('refund', $refund['object']);
  }

  /**
   * Assert that OmiseRefund can search for refunds.
   */
  public function testSearch() {
    $result = OmiseRefund::search()
      ->filter(array('voided' => true));

    $this->assertArrayHasKey('object', $result);
    $this->assertEquals('search', $result['object']);

    foreach ($result['data'] as $item) {
      $this->assertArrayHasKey('object', $item);
      $this->assertEquals('refund', $item['object']);
    }
  }
}
