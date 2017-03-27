<?php require_once dirname(__FILE__).'/TestConfig.php';

class EventTest extends TestConfig {
  /**
   * OmiseEvent class must be contain methods as below.
   *
   */
  public function testMethodExists() {
    $this->assertTrue(method_exists('OmiseEvent', 'retrieve'));
    $this->assertTrue(method_exists('OmiseEvent', 'reload'));
    $this->assertTrue(method_exists('OmiseEvent', 'getUrl'));
  }

  /**
   * Assert that a list of event object could be successfully retrieved.
   *
   */
  public function testRetrieveEventListObject() {
    $event = OmiseEvent::retrieve();

    $this->assertArrayHasKey('object', $event);
    $this->assertEquals('list', $event['object']);
  }

  /**
   * Assert that we can retrieve an event by id.
   *
   */
  public function testRetrieveEventObjectByEventId() {
    $event = OmiseEvent::retrieve('evnt_test_531zv1nto0a5pimuiza');

    $this->assertArrayHasKey('object', $event);
    $this->assertEquals('event', $event['object']);
    $this->assertEquals('evnt_test_531zv1nto0a5pimuiza', $event['id']);
  }

  /**
   * Assert that we can retrieve an event by id.
   *
   */
  public function testReloadEventObject() {
    $event = OmiseEvent::retrieve();
    $event->reload();

    $this->assertArrayHasKey('object', $event);
    $this->assertEquals('list', $event['object']);
  }

  /**
   * Assert that we can retrieve an event by id.
   *
   */
  public function testReloadEventObjectGivenByEvenId() {
    $event = OmiseEvent::retrieve('evnt_test_531zv1nto0a5pimuiza');
    $event->reload();

    $this->assertArrayHasKey('object', $event);
    $this->assertEquals('event', $event['object']);
    $this->assertEquals('evnt_test_531zv1nto0a5pimuiza', $event['id']);
  }
}
