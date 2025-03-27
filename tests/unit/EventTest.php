<?php

use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    public $eventId;

    /**
     * @before
     */
    public function setupSharedResources()
    {
        $event = OmiseEvent::retrieve();
        $this->eventId = $event['data'][0]['id'];
    }

    /**
     * @test
     * OmiseEvent class must be contain methods as below.
     */
    public function method_exists()
    {
        $this->assertTrue(method_exists('OmiseEvent', 'retrieve'));
        $this->assertTrue(method_exists('OmiseEvent', 'reload'));
        $this->assertTrue(method_exists('OmiseEvent', 'getUrl'));
    }

    /**
     * @test
     * Assert that a list of event object could be successfully retrieved.
     */
    public function retrieve_event_list_object()
    {
        $event = OmiseEvent::retrieve();
        $this->assertArrayHasKey('object', $event);
        $this->assertEquals('list', $event['object']);
    }

    /**
     * @test
     * Assert that we can retrieve an event by id.
     */
    public function retrieve_event_object_by_event_id()
    {
        $event = OmiseEvent::retrieve($this->eventId);

        $this->assertArrayHasKey('object', $event);
        $this->assertEquals('event', $event['object']);
        $this->assertEquals($this->eventId, $event['id']);
    }

    /**
     * @test
     * Assert that we can retrieve an event by id.
     */
    public function reload_event_object()
    {
        $event = OmiseEvent::retrieve();
        $event->reload();
        $this->assertArrayHasKey('object', $event);
        $this->assertEquals('list', $event['object']);
    }

    /**
     * @test
     * Assert that we can retrieve an event by id.
     */
    public function reload_event_object_given_by_event_id()
    {
        $event = OmiseEvent::retrieve($this->eventId);
        $event->reload();

        $this->assertArrayHasKey('object', $event);
        $this->assertEquals('event', $event['object']);
        $this->assertEquals($this->eventId, $event['id']);
    }
}
