<?php require_once dirname(__FILE__).'/TestConfig.php';

class LinkTest extends TestConfig {
  /**
   * OmiseLink class must be contain some method below.
   *
   */
  public function testMethodExists() {
    $this->assertTrue(method_exists('OmiseLink', 'retrieve'));
    $this->assertTrue(method_exists('OmiseLink', 'create'));
    $this->assertTrue(method_exists('OmiseLink', 'getUrl'));
  }

  /**
   * Assert that a list of link object could be successfully retrieved.
   *
   */
  public function testRetrieveLinkListObject() {
    $link = OmiseLink::retrieve();

    $this->assertArrayHasKey('object', $link);
    $this->assertEquals('list', $link['object']);
  }

  /**
   * Assert that a link is successfully created with the given parameters set.
   *
   */
  public function testCreate() {
    $link = OmiseLink::create(array('amount'      => 100000,
                                    'title'       => 'Order-384',
                                    'description' => 'New Product'));

    $this->assertArrayHasKey('object', $link);
    $this->assertEquals('link', $link['object']);
  }

  /**
   * Assert that a link object is returned after a successful retrieve.
   *
   */
  public function testRetrieveSpecificLinkObject() {
    $link = OmiseLink::retrieve('link_test_56bsanpa365jnlbc7rt');

    $this->assertArrayHasKey('object', $link);
    $this->assertEquals('link', $link['object']);
  }
}
