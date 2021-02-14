<?php
require_once dirname(__FILE__).'/TestConfig.php';

class ReceiptTest extends TestConfig
{
    /**
     * @test
     * Assert that OmiseReceipt class contains the methods below.
     */
    public function method_exists()
    {
        $this->assertTrue(method_exists('OmiseReceipt', 'retrieve'));
        $this->assertTrue(method_exists('OmiseReceipt', 'reload'));
        $this->assertTrue(method_exists('OmiseReceipt', 'getUrl'));
    }

    /**
     * @test
     * Assert that a list of receipts could be successfully retrieved.
     */
    public function retrieve_receipt_list()
    {
        $receipts = OmiseReceipt::retrieve();

        $this->assertArrayHasKey('object', $receipts);
        $this->assertEquals('list', $receipts['object']);
    }

    /**
     * @test
     * Assert that a receipt could be successfully retrieved.
     */
    public function retrieve_receipt_id()
    {
        $receipt = OmiseReceipt::retrieve('rcpt_5ls0b8zb53qmw3mlvfz');

        $this->assertArrayHasKey('object', $receipt);
        $this->assertEquals('rcpt_5ls0b8zb53qmw3mlvfz', $receipt['id']);
    }

    /**
     * @test
     * Assert that a list of receipts could be successfully reloaded.
     */
    public function reload_receipt_list()
    {
        $receipts = OmiseReceipt::retrieve();
        $receipts->reload();

        $this->assertArrayHasKey('object', $receipts);
        $this->assertEquals('list', $receipts['object']);
    }

    /**
     * @test
     * Assert that a receipt could be successfully reloaded.
     */
    public function reload_receipt_id()
    {
        $receipt = OmiseReceipt::retrieve('rcpt_5ls0b8zb53qmw3mlvfz');
        $receipt->reload();

        $this->assertArrayHasKey('object', $receipt);
        $this->assertEquals('rcpt_5ls0b8zb53qmw3mlvfz', $receipt['id']);
    }
}
