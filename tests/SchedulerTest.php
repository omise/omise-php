<?php

use PHPUnit\Framework\TestCase;

class SchedulerTest extends TestCase
{
    /**
     * @test
     * OmiseScheduler class must be contain some method below.
     */
    public function existing_methods()
    {
        $this->assertTrue(method_exists('OmiseScheduler', 'every'));
        $this->assertTrue(method_exists('OmiseScheduler', 'days'));
        $this->assertTrue(method_exists('OmiseScheduler', 'day'));
        $this->assertTrue(method_exists('OmiseScheduler', 'weeks'));
        $this->assertTrue(method_exists('OmiseScheduler', 'week'));
        $this->assertTrue(method_exists('OmiseScheduler', 'months'));
        $this->assertTrue(method_exists('OmiseScheduler', 'month'));
        $this->assertTrue(method_exists('OmiseScheduler', 'endDate'));
        $this->assertTrue(method_exists('OmiseScheduler', 'startDate'));
        $this->assertTrue(method_exists('OmiseScheduler', 'start'));
    }

    /**
     * @test
     * Assert that creating scheduler for charge return successfully
     */
    public function create_a_charge_scheduler()
    {
        $charge = [
            'customer' => OMISE_CUSTOMER_ID,
            'amount' => 99900,
            'description' => 'Membership Fee'
        ];
        $scheduler = new OmiseScheduler('charge', $charge);
        $this->assertEquals($charge, $scheduler['charge']);
    }

    /**
     * @test
     *  Assert that creating scheduler for transfer return successfully
     */
    public function create_a_transfer_scheduler()
    {
        $recipients = OmiseRecipient::retrieve();
        $transfer = [
            'recipient' => $recipients['data'][0]['id'],
            'amount' => 100000
        ];
        $scheduler = new OmiseScheduler('transfer', $transfer);
        $this->assertEquals($transfer, $scheduler['transfer']);
    }

    /**
     * @test
     * Assert that creating scheduler for charge with every 15 days return successfully
     */
    public function set_scheduler_to_perform_every_15_days()
    {
        $charge = [
            'customer' => OMISE_CUSTOMER_ID,
            'amount' => 99900,
            'description' => 'Membership Fee'
        ];
        $scheduler = new OmiseScheduler('charge', $charge);
        $scheduler
            ->every(15)
            ->days();
        $this->assertEquals($charge, $scheduler['charge']);
        $this->assertEquals(15, $scheduler['every']);
        $this->assertEquals('day', $scheduler['period']);
    }

    /**
     * @test
     * Assert that creating scheduler for charge with every 2 weeks on monday return successfully
     */
    public function set_scheduler_to_perform_every_2_weeks_on_monday()
    {
        $charge = [
            'customer' => OMISE_CUSTOMER_ID,
            'amount' => 99900,
            'description' => 'Membership Fee'
        ];
        $scheduler = new OmiseScheduler('charge', $charge);
        $scheduler
            ->every(2)
            ->weeks('Monday');
        $this->assertEquals($charge, $scheduler['charge']);
        $this->assertEquals(2, $scheduler['every']);
        $this->assertEquals('week', $scheduler['period']);
        $this->assertEquals(['weekdays' => ['Monday']], $scheduler['on']);
    }

    /**
     * @test
     * Assert that creating scheduler for charge with every 1 month on first and fifteenth return successfully
     */
    public function set_scheduler_to_perform_every_1_month_on_first_and_fifteenth()
    {
        $charge = [
            'customer' => OMISE_CUSTOMER_ID,
            'amount' => 99900,
            'description' => 'Membership Fee'
        ];
        $scheduler = new OmiseScheduler('charge', $charge);
        $scheduler
            ->every(1)
            ->month([1, 15]);
        $this->assertEquals($charge, $scheduler['charge']);
        $this->assertEquals(1, $scheduler['every']);
        $this->assertEquals('month', $scheduler['period']);
        $this->assertEquals(['days_of_month' => [1, 15]], $scheduler['on']);
    }

    /**
     * @test
     * Assert that creating scheduler for charge with every 3 months on 28th return successfully
     */
    public function set_scheduler_to_perform_every_3_months_on_twentyeighth()
    {
        $charge = [
            'customer' => OMISE_CUSTOMER_ID,
            'amount' => 99900,
            'description' => 'Membership Fee'
        ];

        $scheduler = new OmiseScheduler('charge', $charge);
        $scheduler
            ->every(3)
            ->month(28);
        $this->assertEquals($charge, $scheduler['charge']);
        $this->assertEquals(3, $scheduler['every']);
        $this->assertEquals('month', $scheduler['period']);
        $this->assertEquals(['days_of_month' => [28]], $scheduler['on']);
    }

    /**
     * @test
     * Assert that creating scheduler for charge with every 1 month on last friday return successfully
     */
    public function set_scheduler_to_perform_every_1_month_on_last_friday_and_specify_end_date()
    {
        $endDate = date('Y-m-d', strtotime('+2 months'));
        $charge = [
            'customer' => OMISE_CUSTOMER_ID,
            'amount' => 99900,
            'description' => 'Membership Fee'
        ];
        $scheduler = new OmiseScheduler('charge', $charge);
        $scheduler
            ->every(1)
            ->month('last_friday')
            ->endDate($endDate);
        $this->assertEquals($charge, $scheduler['charge']);
        $this->assertEquals(1, $scheduler['every']);
        $this->assertEquals('month', $scheduler['period']);
        $this->assertEquals(['weekday_of_month' => 'last_friday'], $scheduler['on']);
        $this->assertEquals($endDate, $scheduler['end_date']);
    }

    /**
     * @test
     * Assert that creating scheduler for charge with
     * every 1 month on last friday with specific date return successfully
     */
    public function set_scheduler_to_perform_at_specific_date()
    {
        $endDate = date('Y-m-d', strtotime('+2 months'));
        $startDate = date('Y-m-d');
        $charge = [
            'customer' => OMISE_CUSTOMER_ID,
            'amount' => 99900,
            'description' => 'Membership Fee'
        ];

        $scheduler = new OmiseScheduler('charge', $charge);
        $scheduler
            ->every(1)
            ->month('last_friday')
            ->endDate($endDate)
            ->startDate($startDate);

        $this->assertEquals($charge, $scheduler['charge']);
        $this->assertEquals(1, $scheduler['every']);
        $this->assertEquals('month', $scheduler['period']);
        $this->assertEquals(['weekday_of_month' => 'last_friday'], $scheduler['on']);
        $this->assertEquals($endDate, $scheduler['end_date']);
        $this->assertEquals($startDate, $scheduler['start_date']);
    }
}
