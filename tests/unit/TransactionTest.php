<?php

use PHPUnit\Framework\TestCase;

class TransactionTest extends TestCase
{
    /**
     * @test
     * OmiseTransaction should contain some method like below.
     */
    public function omise_transaction_method_exists()
    {
        $this->assertTrue(method_exists('OmiseTransaction', 'retrieve'));
        $this->assertTrue(method_exists('OmiseTransaction', 'reload'));
        $this->assertTrue(method_exists('OmiseTransaction', 'getUrl'));
    }

    /**
     * @test
     * Assert that a list of transactions object could be successfully retrieved.
     */
    public function retrieve_all_transactions()
    {
        $transactions = OmiseTransaction::retrieve();

        $this->assertArrayHasKey('object', $transactions);
        $this->assertEquals('list', $transactions['object']);
    }

    /**
     * @test
     * Assert that a transaction object is returned after a successful retrieve with transaction id.
     */
    public function retrieve_with_specific_transaction()
    {
        $transactions = OmiseTransaction::retrieve();
        $transaction = OmiseTransaction::retrieve($transactions['data'][0]['id']);
        $this->assertArrayHasKey('object', $transaction);
        $this->assertEquals('transaction', $transaction['object']);
    }

    /**
     * @test
     * Assert that a transaction object is returned after a successful retrieve with transaction id.
     * And validate json structure that's return back.
     */
    public function validate_omise_transaction_object_retrieved_structure()
    {
        $transactions = OmiseTransaction::retrieve();
        $transaction = OmiseTransaction::retrieve($transactions['data'][0]['id']);
        $this->assertArrayHasKey('object', $transaction);
        $this->assertArrayHasKey('id', $transaction);
        $this->assertArrayHasKey('amount', $transaction);
        $this->assertArrayHasKey('currency', $transaction);
        $this->assertArrayHasKey('direction', $transaction);
        $this->assertArrayHasKey('key', $transaction);
        $this->assertArrayHasKey('origin', $transaction);
        $this->assertArrayHasKey('created_at', $transaction);
    }

    /**
     * @test
     * Assert that a transaction can be reloaded when object is 'transaction'.
     */
    public function reload_when_object_is_transaction()
    {
        $transactions = OmiseTransaction::retrieve();
        if (isset($transactions['data'][0])) {
            $transaction = OmiseTransaction::retrieve($transactions['data'][0]['id']);
            $transaction->reload();
            $this->assertArrayHasKey('object', $transaction);
            $this->assertEquals('transaction', $transaction['object']);
        } else {
            $this->assertTrue(true);
        }
    }

    /**
     * @test
     * Assert that a transaction list can be reloaded when object is not 'transaction'.
     */
    public function reload_when_object_is_not_transaction()
    {
        $transactions = OmiseTransaction::retrieve();
        $transactions->reload();
        $this->assertArrayHasKey('object', $transactions);
        $this->assertEquals('list', $transactions['object']);
    }
}
