<?php

use PHPUnit\Framework\TestCase;

class ReceiptTest extends TestCase
{
    public $receiptId;

    /**
     * @before
     */
    public function setupSharedResources()
    {
        $receipts = OmiseReceipt::retrieve();
        if (isset($receipts['data'][0])) {
            $this->receiptId = $receipts['data'][0]['id'];
        }
    }
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
        $this->assertEquals('receipt_list', $receipts['object']);
    }

    /**
     * @test
     * Assert that a receipt could be successfully retrieved.
     */
    public function retrieve_receipt_id()
    {
        if ($this->receiptId) {
            $receipt = OmiseReceipt::retrieve($this->receiptId);
            $this->assertArrayHasKey('object', $receipt);
            $this->assertEquals($this->receiptId, $receipt['id']);
        } else {
            $this->assertTrue(true);
        }
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
        $this->assertEquals('receipt_list', $receipts['object']);
    }

    /**
     * @test
     * Assert that a receipt could be successfully reloaded.
     */
    public function reload_receipt_id()
    {
        if ($this->receiptId) {
            $receipt = OmiseReceipt::retrieve($this->receiptId);
            $receipt->reload();
            $this->assertArrayHasKey('object', $receipt);
            $this->assertEquals($this->receiptId, $receipt['id']);
        } else {
            $this->assertTrue(true);
        }
    }
}
