<?php require_once dirname(__FILE__).'/TestConfig.php';

class OmiseBalanceTest extends TestConfig {
  /**
   * OmiseBalance class must be contain some method below.
   *
   */
  public function testMethodExists() {
    $this->assertTrue(method_exists('OmiseBalance', 'retrieve'));
    $this->assertTrue(method_exists('OmiseBalance', 'reload'));
    $this->assertTrue(method_exists('OmiseBalance', 'getUrl'));
  }

  /**
   * Assert that a balance object is returned after a successful retrieve.
   *
   */
  public function testRetrieveOmiseBalanceObject() {
    $balance = OmiseBalance::retrieve();

    $this->assertArrayHasKey('object', $balance);
    $this->assertEquals('balance', $balance['object']);
  }

  /**
   * Assert that a balance object is returned after a successful reload.
   *
   */
  public function testReload() {
    $balance = OmiseBalance::retrieve();
    $balance->reload();

    $this->assertArrayHasKey('object', $balance);
    $this->assertEquals('balance', $balance['object']);
  }
}
