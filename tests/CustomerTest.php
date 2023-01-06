<?php

use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    public $customerId;

    /**
     * @before
     */
    public function setupSharedResources()
    {
        $customer = OmiseCustomer::create([
            'email' => 'john.doe@example.com',
            'description' => 'John Doe (id: 30)'
        ]);
        $this->customerId = $customer['id'];
        $this->assertArrayHasKey('object', $customer);
        $this->assertEquals('customer', $customer['object']);
    }

    /**
     * @test
     * OmiseCustomer class must be contain some method below.
     */
    public function method_exists()
    {
        $this->assertTrue(method_exists('OmiseCustomer', 'retrieve'));
        $this->assertTrue(method_exists('OmiseCustomer', 'create'));
        $this->assertTrue(method_exists('OmiseCustomer', 'reload'));
        $this->assertTrue(method_exists('OmiseCustomer', 'update'));
        $this->assertTrue(method_exists('OmiseCustomer', 'destroy'));
        $this->assertTrue(method_exists('OmiseCustomer', 'isDestroyed'));
        $this->assertTrue(method_exists('OmiseCustomer', 'cards'));
        $this->assertTrue(method_exists('OmiseCustomer', 'getCards'));
        $this->assertTrue(method_exists('OmiseCustomer', 'getUrl'));
    }

    /**
     * @test
     * Assert that a list of customer object could be successfully retrieved.
     */
    public function retrieve_customer_list_object()
    {
        $customer = OmiseCustomer::retrieve();

        $this->assertArrayHasKey('object', $customer);
        $this->assertEquals('list', $customer['object']);
    }

    /**
     * @test
     * Assert that a customer object is returned after a successful retrieve.
     */
    public function retrieve_specific_customer_object()
    {
        $customer = OmiseCustomer::retrieve($this->customerId);
        $this->assertArrayHasKey('object', $customer);
        $this->assertEquals('customer', $customer['object']);
    }

    /**
     * @test
     * Assert that a customer is successfully updated with the given parameters set.
     */
    public function update()
    {
        $customer = OmiseCustomer::retrieve($this->customerId);
        $customer->update([
            'email' => 'john.smith@example.com',
            'description' => 'Another description'
        ]);
        $this->assertArrayHasKey('object', $customer);
        $this->assertEquals('customer', $customer['object']);
    }

    /**
     * @test
     * Assert that OmiseCustomer can search for customers.
     */
    public function search()
    {
        $result = OmiseCustomer::search('john')
            ->filter(['created' => '2017-01-01..2022-12-21']);

        $this->assertArrayHasKey('object', $result);
        $this->assertEquals('search', $result['object']);

        foreach ($result['data'] as $item) {
            $this->assertArrayHasKey('object', $item);
            $this->assertEquals('customer', $item['object']);
        }
    }

    /**
     * @test
     * @todo need to ask how to create schedule
     */
    public function retrieve_schedules()
    {
        $customer = OmiseCustomer::retrieve($this->customerId);
        $schedules = $customer->schedules();

        $this->assertArrayHasKey('object', $schedules);
        $this->assertEquals('list', $schedules['object']);
        if (isset($schedules['data'][0])) {
            $this->assertEquals('schedule', $schedules['data'][0]['object']);
            $this->assertArrayHasKey('charge', $schedules['data'][0]);
            $this->assertEquals($this->customerId, $schedules['data'][0]['charge']['customer']);
        }
    }

    /**
     * @test
     * Assert that a destroyed flag is set after a customer is successfully destroyed.
     */
    public function destroy()
    {
        $customer = OmiseCustomer::retrieve($this->customerId);
        $customer->destroy();
        $this->assertTrue($customer->isDestroyed());
    }
}
