<?php
require_once dirname(__FILE__).'/TestConfig.php';

class OmiseDisputeTest extends TestConfig
{
    /**
     * @test
     * OmiseDispute class must be contain some method below.
     */
    public function method_exists()
    {
        $this->assertTrue(method_exists('OmiseDispute', 'retrieve'));
        $this->assertTrue(method_exists('OmiseDispute', 'reload'));
        $this->assertTrue(method_exists('OmiseDispute', 'update'));
        $this->assertTrue(method_exists('OmiseDispute', 'accept'));
        $this->assertTrue(method_exists('OmiseDispute', 'getUrl'));
    }

    /**
     * @test
     * Assert that a list of dispute object is returned after a successful retrieve.
     */
    public function retrieve_omise_dispute_object()
    {
        $dispute = OmiseDispute::retrieve();
        $dispute->reload();

        $this->assertArrayHasKey('object', $dispute);
        $this->assertEquals('list', $dispute['object']);
        $this->assertEquals('dispute', $dispute['data'][0]['object']);
    }

    /**
     * @test
     * Assert that a dispute object is returned after a successful retrieve.
     */
    public function retrieve_omise_dispute_object_with_key()
    {
        $dispute = OmiseDispute::retrieve('dspt_test_4zgf15h89w8t775kcm8');

        $this->assertArrayHasKey('object', $dispute);
        $this->assertEquals('dispute', $dispute['object']);
    }

    /**
     * @test
     * Assert that a dispute object is returned after a successful retrieve with 'open' status.
     */
    public function retrieve_omise_dispute_object_that_open()
    {
        $dispute = OmiseDispute::retrieve('open');

        $this->assertArrayHasKey('object', $dispute);
        $this->assertEquals('dispute', $dispute['data'][0]['object']);
        $this->assertEquals('open', $dispute['data'][0]['status']);
    }

    /**
     * @test
     * Assert that a dispute object is returned after a successful retrieve with 'pending' status.
     */
    public function retrieve_omise_dispute_object_that_pending()
    {
        $dispute = OmiseDispute::retrieve('pending');

        $this->assertArrayHasKey('object', $dispute);
        $this->assertEquals('dispute', $dispute['data'][0]['object']);
        $this->assertEquals('pending', $dispute['data'][0]['status']);
    }

    /**
     * @test
     * Assert that a dispute object is returned after a successful retrieve with 'closed' status.
     */
    public function retrieve_omise_dispute_object_that_closed()
    {
        $dispute = OmiseDispute::retrieve('closed');

        $this->assertArrayHasKey('object', $dispute);
        $this->assertEquals('dispute', $dispute['data'][0]['object']);
        $this->assertEquals('closed', $dispute['data'][0]['status']);
    }

    /**
     * @test
     * Assert that a dispute is successfully updated with the given parameters set.
     */
    public function update()
    {
        $dispute = OmiseDispute::retrieve('dspt_test_4zgf15h89w8t775kcm8');
        $dispute->update(array(
        'message' => 'New Message...'
        ));

        $this->assertArrayHasKey('object', $dispute);
        $this->assertEquals('dispute', $dispute['object']);
    }

    /**
     * @test
     * Assert that the dispute is successfully accepted.
     */
    public function accept()
    {
        $dispute = OmiseDispute::retrieve('dspt_test_4zgf15h89w8t775kcm8');
        $dispute->accept();

        $this->assertArrayHasKey('object', $dispute);
        $this->assertEquals('dispute', $dispute['object']);
        $this->assertEquals('lost', $dispute['status']);
    }

    /**
     * @test
     * Assert that OmiseDispute can search for disputes.
     */
    public function search()
    {
        $result = OmiseDispute::search('demo')
        ->filter(array('card_last_digits' => '5454'));

        $this->assertArrayHasKey('object', $result);
        $this->assertEquals('search', $result['object']);

        foreach ($result['data'] as $item) {
            $this->assertArrayHasKey('object', $item);
            $this->assertEquals('dispute', $item['object']);
        }
    }
}
