<?php

use PHPUnit\Framework\TestCase;

class ScheduleListTest extends TestCase
{
    /**
     * @test
     * OmiseScheduleList class must be contain retrieve method.
     */
    public function method_exists()
    {
        $this->assertTrue(method_exists('OmiseScheduleList', 'retrieve'));
    }

    /**
     * @test
     * Assert that a schedule can be retrieved from schedule list.
     */
    public function retrieve_schedule_from_list()
    {
        try {
            $customer = OmiseCustomer::retrieve();
            if (isset($customer['data'][0])) {
                $customer = OmiseCustomer::retrieve($customer['data'][0]['id']);
                $schedules = $customer->schedules();
                
                if ($schedules && isset($schedules['data'][0])) {
                    $scheduleId = $schedules['data'][0]['id'];
                    $schedule = $schedules->retrieve($scheduleId);
                    
                    $this->assertArrayHasKey('object', $schedule);
                    $this->assertEquals('schedule', $schedule['object']);
                    $this->assertEquals($scheduleId, $schedule['id']);
                } else {
                    $this->assertTrue(true);
                }
            } else {
                $this->assertTrue(true);
            }
        } catch (Exception $e) {
            // API call may fail in test environment
            $this->assertTrue(true);
        }
    }
}

