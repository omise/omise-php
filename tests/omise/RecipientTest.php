<?php require_once dirname(__FILE__).'/TestConfig.php';

class OmiseRecipientTest extends TestConfig {
  /**
   * OmiseAccount class must be contain some method below.
   *
   */
  public function testMethodExists() {
    $this->assertTrue(method_exists('OmiseRecipient', 'retrieve'));
    $this->assertTrue(method_exists('OmiseRecipient', 'getUrl'));
  }

  /**
   * Assert that an recipient object is returned after a successful retrieve.
   *
   */
  public function testRetrieveOmiseRecipientObject() {
    $recipient = OmiseRecipient::retrieve();

    $this->assertArrayHasKey('object', $recipient);
    $this->assertEquals('list', $recipient['object']);
    $this->assertEquals('recipient', $recipient['data'][0]['object']);
  }
}
