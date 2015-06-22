<?php require_once dirname(__FILE__).'/TestConfig.php';

class OmiseDisputeTest extends TestConfig {
  /**
   * OmiseDispute class must be contain some method below.
   *
   */
  public function testMethodExists() {
    $this->assertTrue(method_exists('OmiseDispute', 'retrieve'));
    $this->assertTrue(method_exists('OmiseDispute', 'update'));
    $this->assertTrue(method_exists('OmiseDispute', 'getUrl'));
  }

  /**
   * Assert that a dispute object is returned after a successful retrieve.
   *
   */
  public function testRetrieveOmiseDisputeObject() {
    $dispute = OmiseDispute::retrieve();

    $this->assertArrayHasKey('object', $dispute);
    $this->assertEquals('list', $dispute['object']);
    $this->assertEquals('dispute', $dispute['data'][0]['object']);
  }

  /**
   * Assert that a dispute object is returned after a successful retrieve.
   *
   */
  public function testRetrieveOmiseDisputeObjectWithKey() {
    $dispute = OmiseDispute::retrieve('dspt_test_4zgf15h89w8t775kcm8');

    $this->assertArrayHasKey('object', $dispute);
    $this->assertEquals('dispute', $dispute['object']);
  }

  /**
   * Assert that a dispute object is returned after a successful retrieve.
   *
   */
  public function testRetrieveOmiseDisputeObjectThatOpen() {
    $dispute = OmiseDispute::retrieve('open');

    $this->assertArrayHasKey('object', $dispute);
  }

  /**
   * Assert that a dispute object is returned after a successful retrieve.
   *
   */
  public function testRetrieveOmiseDisputeObjectThatPending() {
    $dispute = OmiseDispute::retrieve('pending');

    $this->assertArrayHasKey('object', $dispute);
  }

  /**
   * Assert that a dispute object is returned after a successful retrieve.
   *
   */
  public function testRetrieveOmiseDisputeObjectThatClosed() {
    $dispute = OmiseDispute::retrieve('closed');

    $this->assertArrayHasKey('object', $dispute);
  }

  /**
   * Assert that a dispute is successfully updated with the given parameters set.
   *
   */
  public function testUpdate() {
    $dispute = OmiseDispute::retrieve('dspt_test_4zgf15h89w8t775kcm8');
    $dispute->update(array(
      'message' => 'New Message...'
    ));

    $this->assertArrayHasKey('object', $dispute);
    $this->assertEquals('dispute', $dispute['object']);
  }
}