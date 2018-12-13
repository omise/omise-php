<?php require_once dirname(__FILE__).'/TestConfig.php';

class CapabilitiesTest extends TestConfig {
  /**
   * OmiseCapabilities class must be contain some method below. 
   *
   */
  public function testMethodExists() {
    $this->assertTrue(method_exists('OmiseCapabilities', 'retrieve'));
    $this->assertTrue(method_exists('OmiseCapabilities', 'reload'));
  }

  /**
   * Assert that a capabilities object is returned after a successful retrieve.
   *
   */
  public function testRetrieveOmiseCapabilitiesObject() {
    $capabilities = OmiseCapabilities::retrieve();

    $this->assertArrayHasKey('payment_backends', $capabilities);
    $this->assertInternalType('array', $capabilities['payment_backends']);
  }

  
  /**
   * Assert that a capabilities object is returned after a successful reload.
   *
   */
  public function testReload() {
    $capabilities = OmiseCapabilities::retrieve();
    $capabilities->reload();

    $this->assertArrayHasKey('payment_backends', $capabilities);
    $this->assertInternalType('array', $capabilities['payment_backends']);
  }
}
