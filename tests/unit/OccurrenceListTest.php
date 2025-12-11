<?php

use PHPUnit\Framework\TestCase;

class OccurrenceListTest extends TestCase
{
    /**
     * @test
     * OmiseOccurrenceList class must be contain retrieve method.
     */
    public function method_exists()
    {
        $this->assertTrue(method_exists('OmiseOccurrenceList', 'retrieve'));
    }

    /**
     * @test
     * Assert that an occurrence can be retrieved from occurrence list.
     */
    public function retrieve_occurrence_from_list()
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

        if (isset($schedule['occurrences']['data'][0])) {
            $occurrenceId = $schedule['occurrences']['data'][0]['id'];
            $occurrence = $schedule['occurrences']->retrieve($occurrenceId);
            
            $this->assertArrayHasKey('object', $occurrence);
            $this->assertEquals('occurrence', $occurrence['object']);
            $this->assertEquals($occurrenceId, $occurrence['id']);
        } else {
            $this->assertTrue(true);
        }
    }
}

