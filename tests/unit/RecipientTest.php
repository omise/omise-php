<?php

use PHPUnit\Framework\TestCase;

class OmiseRecipientTest extends TestCase
{
    public $recipientId;

    /**
     * @before
     */
    public function setupSharedResources()
    {
        $recipients = OmiseRecipient::retrieve();
        $this->recipientId = $recipients['data'][0]['id'];
    }

    /**
     * @test
     * OmiseRecipient class must be contain some method below.
     */
    public function method_exists()
    {
        $this->assertTrue(method_exists('OmiseRecipient', 'retrieve'));
        $this->assertTrue(method_exists('OmiseRecipient', 'getUrl'));
    }

    /**
     * @test
     * Assert that an recipient object is returned after a successful retrieve.
     */
    public function retrieve_omise_recipient_object()
    {
        $recipient = OmiseRecipient::retrieve();
        $this->assertArrayHasKey('object', $recipient);
        $this->assertEquals('list', $recipient['object']);
        $this->assertEquals('recipient', $recipient['data'][0]['object']);
    }

    /**
     * @test
     * Assert that an recipient object is returned after a successful retrieve.
     */
    public function retrieve_omise_recipient_object_with_key()
    {
        $recipient = OmiseRecipient::retrieve($this->recipientId);
        $this->assertArrayHasKey('object', $recipient);
        $this->assertEquals('recipient', $recipient['object']);
    }

    /**
     * @test
     * Assert that a recipient is successfully updated with the given parameters set.
     */
    public function update()
    {
        $recipient = OmiseRecipient::retrieve($this->recipientId);
        $recipient->update([
            'name' => 'Nuttanon Tra',
            'email' => 'nam@omise.co',
            'description' => 'Another description'
        ]);
        $this->assertArrayHasKey('object', $recipient);
        $this->assertEquals('recipient', $recipient['object']);
    }

    /**
    * @test
    * Assert that a destroyed flag is set after a recipient is successfully destroyed.
    */
    public function create_and_delete()
    {
        $recipient = OmiseRecipient::create([
            'name' => 'Nuttanon T',
            'description' => 'Nuttanon T\'s account',
            'email' => 'nam@omise.co',
            'type' => 'individual',
            'tax_id' => '',
            'bank_account' => [
                'brand' => 'scb',
                'number' => '1234567890',
                'name' => 'Nuttanon T'
            ]
        ]);
        $this->assertArrayHasKey('object', $recipient);
        $this->assertEquals('recipient', $recipient['object']);
        $recipient->destroy();
        $this->assertTrue($recipient->isDestroyed());
    }

    /**
     * @test
     * Assert that OmiseRecipient can search for recipients.
     */
    public function search()
    {
        $result = OmiseRecipient::search('demo')
            ->filter(['active' => true]);
        $this->assertArrayHasKey('object', $result);
        $this->assertEquals('search', $result['object']);
        foreach ($result['data'] as $item) {
            $this->assertArrayHasKey('object', $item);
            $this->assertEquals('recipient', $item['object']);
        }
    }

    /**
     * @test
     * Assert that OmiseRecipient can retrieve schedules.
     */
    public function retrieve_schedules()
    {
        $recipient = OmiseRecipient::retrieve($this->recipientId);
        $schedules = $recipient->schedules();
        $this->assertArrayHasKey('object', $schedules);
        $this->assertEquals('list', $schedules['object']);
        if (isset($schedules['data'][0])) {
            $this->assertEquals('schedule', $schedules['data'][0]['object']);
            $this->assertArrayHasKey('transfer', $schedules['data'][0]);
            $this->assertEquals($this->recipientId, $schedules['data'][0]['transfer']['recipient']);
        }
    }
}
