<?php require_once dirname(__FILE__).'/TestConfig.php';

class CapabilitiesTest extends TestConfig {
  /**
   * OmiseAccount class must be contain some method below.
   *
   */
  public function testMethodExists() {
    $this->assertTrue(method_exists('OmiseCapabilities', 'retrieve'));
  }

  /**
   * Assert that an account object is returned after a successful retrieve.
   *
   */
  public function testRetrieveOmiseCapabilitiesObject() {
    $capabilities = OmiseCapabilities::retrieve();

    $this->assertArrayHasKey('payment_backends', $capabilities);
    $this->assertInternalType('array', $capabilities['payment_backends']);
  }
}
