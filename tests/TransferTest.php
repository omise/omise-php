<?php

use PHPUnit\Framework\TestCase;

class TransferTest extends TestCase
{
    public $transferId;

    /**
     * @before
     */
    public function setupSharedResources()
    {
        $receipts = OmiseTransfer::retrieve();
        $this->transferId = $receipts['data'][0]['id'];
    }

    /**
     * @test
     * OmiseTransfer should contain some method like below.
     */
    public function method_exists()
    {
        $this->assertTrue(method_exists('OmiseTransfer', 'retrieve'));
        $this->assertTrue(method_exists('OmiseTransfer', 'create'));
        $this->assertTrue(method_exists('OmiseTransfer', 'reload'));
        $this->assertTrue(method_exists('OmiseTransfer', 'save'));
        $this->assertTrue(method_exists('OmiseTransfer', 'update'));
        $this->assertTrue(method_exists('OmiseTransfer', 'destroy'));
        $this->assertTrue(method_exists('OmiseTransfer', 'isDestroyed'));
        $this->assertTrue(method_exists('OmiseTransfer', 'getUrl'));
    }

    /**
     * @test
     * Assert that a list of transfer object could be successfully retrieved.
     */
    public function retrieve_transfer_list_object()
    {
        $transfers = OmiseTransfer::retrieve();

        $this->assertArrayHasKey('object', $transfers);
        $this->assertEquals('list', $transfers['object']);
    }

    /**
     * @test
     * Assert that a transfer is successfully created with the given parameters set.
     */
    public function create()
    {
        $transfer = OmiseTransfer::create(['amount' => 100000]);

        $this->assertArrayHasKey('object', $transfer);
        $this->assertEquals('transfer', $transfer['object']);
    }

    /**
     * @test
     * Assert that a transfer object is returned after a successful retrieve.
     */
    public function retrieve()
    {
        $transfer = OmiseTransfer::retrieve($this->transferId);

        $this->assertArrayHasKey('object', $transfer);
        $this->assertEquals('transfer', $transfer['object']);
    }

    /**
     * @test
     * Assert that a transfer is successfully updated with the given parameters set.
     */
    public function update()
    {
        $transfer = OmiseTransfer::retrieve($this->transferId);

        $transfer['amount'] = 5000;
        $transfer->save();

        $this->assertArrayHasKey('object', $transfer);
        $this->assertEquals('transfer', $transfer['object']);
    }

    /**
     * @test
     * Assert that a destroyed flag is set after a transfer is successfully destroyed.
     */
    public function destroy()
    {
        $transfer = OmiseTransfer::create(['amount' => 100000]);
        $transfer->destroy();
        $this->assertTrue($transfer->isDestroyed());
    }

    /**
     * @test
     * Assert that OmiseTransfer can search for transfers.
     */
    public function search()
    {
        $result = OmiseTransfer::search('demo@omise.co')
            ->filter(['currency' => 'thb']);

        $this->assertArrayHasKey('object', $result);
        $this->assertEquals('search', $result['object']);

        foreach ($result['data'] as $item) {
            $this->assertArrayHasKey('object', $item);
            $this->assertEquals('transfer', $item['object']);
        }
    }

    /**
     * @test
     * Assert that creating scheduler for transfer return successfully
     */
    public function create_scheduler()
    {
        $recipients = OmiseRecipient::retrieve();
        $transfer = [
            'recipient' => $recipients['data'][0]['id'],
            'amount' => 100000
        ];
        $scheduler = OmiseTransfer::schedule($transfer);
        $this->assertEquals($transfer, $scheduler['transfer']);
    }

    /**
     * @test
     * Assert that retrieving scheduler for transfer return successfully
     */
    public function retrieve_schedules()
    {
        $schedules = OmiseTransfer::schedules();
        $this->assertArrayHasKey('object', $schedules);
        $this->assertEquals('list', $schedules['object']);
        if (isset($schedules['data'][0])) {
            $this->assertEquals('schedule', $schedules['data'][0]['object']);
            $this->assertArrayHasKey('transfer', $schedules['data'][0]);
        }
    }
}
