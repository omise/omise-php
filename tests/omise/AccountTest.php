<?php require_once dirname(__FILE__).'/TestConfig.php';

class OmiseAccountTest extends TestConfig {
  /**
   * OmiseAccount class must be contain some method below.
   *
   */
  public function testMethodExists() {
    $this->assertTrue(method_exists('OmiseAccount', 'retrieve'));
    $this->assertTrue(method_exists('OmiseAccount', 'reload'));
    $this->assertTrue(method_exists('OmiseAccount', 'getUrl'));
  }

  /**
   * Assert that an account object is returned after a successful retrieve.
   *
   */
  public function testRetrieveOmiseAccountObject() {
    $account = OmiseAccount::retrieve();

    $this->assertArrayHasKey('object', $account);
    $this->assertEquals('account', $account['object']);
  }

  /**
   * Assert that an account object is returned after a successful reload.
   *
   */
  public function testReload() {
    $account = OmiseAccount::retrieve();
    $account->reload();

    $this->assertArrayHasKey('object', $account);
    $this->assertEquals('account', $account['object']);
  }
}
