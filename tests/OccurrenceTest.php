<?php

use PHPUnit\Framework\TestCase;

class OccurrenceTest extends TestCase
{
    public function setUp(): void
    {
        $scheduler = OmiseCharge::schedule([
            'customer' => OMISE_CUSTOMER_ID,
            'card' => OMISE_CARD_ID,
            'amount' => 100000,
            'description' => 'Membership fee'
        ]);
        $schedule = $scheduler->every(2)
            ->days()
            ->startDate(date('Y-m-d'))
            ->endDate(date('Y-m-d', strtotime('+2 months')))
            ->start();

        $this->scheduleId = $schedule['occurrences']['data'][0]['id'];
    }

    /**
     * @test
     */
    public function existing_methods()
    {
        $this->assertTrue(method_exists('OmiseOccurrence', 'retrieve'));
        $this->assertTrue(method_exists('OmiseOccurrence', 'getUrl'));
    }

    /**
     * @test
     */
    public function retrieve_by_a_given_id()
    {
        $occurrence = OmiseOccurrence::retrieve($this->scheduleId);
        $this->assertArrayHasKey('object', $occurrence);
        $this->assertEquals('occurrence', $occurrence['object']);
        $this->assertEquals($occurrence['id'], $this->scheduleId);
    }

    /**
     * @test
     */
    public function reload()
    {
        $occurrence = OmiseOccurrence::retrieve($this->scheduleId);
        $occurrence->reload();
        $this->assertArrayHasKey('object', $occurrence);
        $this->assertEquals('occurrence', $occurrence['object']);
    }
}
