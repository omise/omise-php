<?php require_once dirname(__FILE__).'/TestConfig.php';

class OmiseRecipientTest extends TestConfig {
  /**
   * OmiseRecipient class must be contain some method below.
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

  /**
   * Assert that an recipient object is returned after a successful retrieve.
   *
   */
  public function testRetrieveOmiseRecipientObjectWithKey() {
    $recipient = OmiseRecipient::retrieve('recp_test_508a9dytz793gxv9m77');

    $this->assertArrayHasKey('object', $recipient);
    $this->assertEquals('recipient', $recipient['object']);
  }

  /**
   * Assert that a recipient is successfully created with the given parameters set.
   *
   */
  public function testCreate() {
    $recipient = OmiseRecipient::create(array('name'          => 'Nuttanon T',
                                              'description'   => 'Nuttanon T\'s account',
                                              'email'         => 'nam@omise.co',
                                              'type'          => 'individual',
                                              'tax_id'        => '',
                                              'bank_account'  => array( 'brand'   => 'scb',
                                                                        'number'  => '1234567890',
                                                                        'name'    => 'Nuttanon T')));

    $this->assertArrayHasKey('object', $recipient);
    $this->assertEquals('recipient', $recipient['object']);
  }

  /**
   * Assert that a recipient is successfully updated with the given parameters set.
   *
   */
  public function testUpdate() {
    $recipient = OmiseRecipient::retrieve('recp_test_508a9dytz793gxv9m77');
    $recipient->update(array( 'name'        => 'Nuttanon Tra',
                              'email'       => 'nam@omise.co',
                              'description' => 'Another description'));

    $this->assertArrayHasKey('object', $recipient);
    $this->assertEquals('recipient', $recipient['object']);
  }

  /**
   * Assert that a destroyed flag is set after a recipient is successfully destroyed.
   *
   */
  public function testDelete() {
    $recipient = OmiseRecipient::retrieve('recp_test_508a9dytz793gxv9m77');
    $recipient->destroy();

    $this->assertTrue($recipient->isDestroyed());
  }

  /**
   * Assert that OmiseRecipient can search for recipients.
   */
  public function testSearch() {
    $result = OmiseRecipient::search('demo')
      ->filter(array('active' => true));

    $this->assertArrayHasKey('object', $result);
    $this->assertEquals('search', $result['object']);

    foreach ($result['data'] as $item) {
      $this->assertArrayHasKey('object', $item);
      $this->assertEquals('recipient', $item['object']);
    }
  }

  /**
   * @test
   */
  public function retrieve_schedules()
  {
    $recipient  = OmiseRecipient::retrieve('recp_test_508a9dytz793gxv9m77');
    $schedules = $recipient->schedules();

    $this->assertArrayHasKey('object', $schedules);
    $this->assertEquals('list', $schedules['object']);
    $this->assertEquals('schedule', $schedules['data'][0]['object']);
    $this->assertArrayHasKey('transfer', $schedules['data'][0]);
    $this->assertEquals('recp_test_508a9dytz793gxv9m77', $schedules['data'][0]['transfer']['recipient']);
  }
}
