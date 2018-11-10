<?php
require_once dirname(__FILE__).'/TestConfig.php';

class TransferTest extends TestConfig
{
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
        $transfer = OmiseTransfer::create(array('amount' => 100000));

        $this->assertArrayHasKey('object', $transfer);
        $this->assertEquals('transfer', $transfer['object']);
    }

    /**
     * @test
     * Assert that a transfer object is returned after a successful retrieve.
     */
    public function retrieve()
    {
        $transfer = OmiseTransfer::retrieve('trsf_test_4zmrjicrvw7j6uhv1l4');

        $this->assertArrayHasKey('object', $transfer);
        $this->assertEquals('transfer', $transfer['object']);
    }

    /**
     * @test
     * Assert that a transfer is successfully updated with the given parameters set.
     */
    public function update()
    {
        $transfer = OmiseTransfer::retrieve('trsf_test_4zmrjicrvw7j6uhv1l4');

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
        $transfer = OmiseTransfer::retrieve('trsf_test_4zmrjicrvw7j6uhv1l4');
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
                                    ->filter(array('currency' => 'thb'));

        $this->assertArrayHasKey('object', $result);
        $this->assertEquals('search', $result['object']);

        foreach ($result['data'] as $item) {
            $this->assertArrayHasKey('object', $item);
            $this->assertEquals('transfer', $item['object']);
        }
    }

    /**
     * @test
     */
    public function retrieve_schedules()
    {
        $schedules = OmiseTransfer::schedules();

        $this->assertArrayHasKey('object', $schedules);
        $this->assertEquals('list', $schedules['object']);
        $this->assertEquals('schedule', $schedules['data'][0]['object']);
        $this->assertArrayHasKey('transfer', $schedules['data'][0]);
    }

    /**
     * @test
     */
    public function create_scheduler()
    {
        $transfer = array(
            'recipient' => 'recp_test_508a9dytz793gxv9m77',
            'amount'    => 100000
        );

        $scheduler = OmiseTransfer::schedule($transfer);

        $this->assertEquals($transfer, $scheduler['transfer']);
    }
}
