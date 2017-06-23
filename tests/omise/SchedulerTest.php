<?php
require_once dirname(__FILE__).'/TestConfig.php';

class SchedulerTest extends TestConfig
{
    /**
     * @test
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
     */
    public function create_a_charge_scheduler()
    {
        $charge = array(
            'customer'    => 'cust_test_5234fzk37pi2mz0cen3',
            'amount'      => 99900,
            'description' => 'Membership Fee'
        );

        $scheduler = new OmiseScheduler('charge', $charge);

        $this->assertEquals($charge, $scheduler['charge']);
    }

    /**
     * @test
     */
    public function create_a_transfer_scheduler()
    {
        $transfer = array(
            'recipient' => 'recp_test_508a9dytz793gxv9m77',
            'amount'    => 100000
        );

        $scheduler = new OmiseScheduler('transfer', $transfer);

        $this->assertEquals($transfer, $scheduler['transfer']);
    }

    /**
     * @test
     */
    public function set_scheduler_to_perform_every_15_days()
    {
        $charge = array(
            'customer'    => 'cust_test_5234fzk37pi2mz0cen3',
            'amount'      => 99900,
            'description' => 'Membership Fee'
        );

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
     */
    public function set_scheduler_to_perform_every_2_weeks_on_monday()
    {
        $charge = array(
            'customer'    => 'cust_test_5234fzk37pi2mz0cen3',
            'amount'      => 99900,
            'description' => 'Membership Fee'
        );

        $scheduler = new OmiseScheduler('charge', $charge);
        $scheduler
            ->every(2)
            ->weeks('Monday');

        $this->assertEquals($charge, $scheduler['charge']);
        $this->assertEquals(2, $scheduler['every']);
        $this->assertEquals('week', $scheduler['period']);
        $this->assertEquals(array('weekdays' => array('Monday')), $scheduler['on']);
    }

    /**
     * @test
     */
    public function set_scheduler_to_perform_every_1_month_on_first_and_fifteenth()
    {
        $charge = array(
            'customer'    => 'cust_test_5234fzk37pi2mz0cen3',
            'amount'      => 99900,
            'description' => 'Membership Fee'
        );

        $scheduler = new OmiseScheduler('charge', $charge);
        $scheduler
            ->every(1)
            ->month(array(1, 15));

        $this->assertEquals($charge, $scheduler['charge']);
        $this->assertEquals(1, $scheduler['every']);
        $this->assertEquals('month', $scheduler['period']);
        $this->assertEquals(array('days_of_month' => array(1, 15)), $scheduler['on']);
    }

    /**
     * @test
     */
    public function set_scheduler_to_perform_every_3_months_on_twentyeighth()
    {
        $charge = array(
            'customer'    => 'cust_test_5234fzk37pi2mz0cen3',
            'amount'      => 99900,
            'description' => 'Membership Fee'
        );

        $scheduler = new OmiseScheduler('charge', $charge);
        $scheduler
            ->every(3)
            ->month(28);

        $this->assertEquals($charge, $scheduler['charge']);
        $this->assertEquals(3, $scheduler['every']);
        $this->assertEquals('month', $scheduler['period']);
        $this->assertEquals(array('days_of_month' => array(28)), $scheduler['on']);
    }

    /**
     * @test
     */
    public function set_scheduler_to_perform_every_1_month_on_last_friday_and_specify_end_date()
    {
        $charge = array(
            'customer'    => 'cust_test_5234fzk37pi2mz0cen3',
            'amount'      => 99900,
            'description' => 'Membership Fee'
        );

        $scheduler = new OmiseScheduler('charge', $charge);
        $scheduler
            ->every(1)
            ->month('last_friday')
            ->endDate('2020-01-01');

        $this->assertEquals($charge, $scheduler['charge']);
        $this->assertEquals(1, $scheduler['every']);
        $this->assertEquals('month', $scheduler['period']);
        $this->assertEquals(array('weekday_of_month' => 'last_friday'), $scheduler['on']);
        $this->assertEquals('2020-01-01', $scheduler['end_date']);
    }

    /**
     * @test
     */
    public function set_scheduler_to_perform_at_specific_date()
    {
        $charge = array(
            'customer'    => 'cust_test_5234fzk37pi2mz0cen3',
            'amount'      => 99900,
            'description' => 'Membership Fee'
        );

        $scheduler = new OmiseScheduler('charge', $charge);
        $scheduler
            ->every(1)
            ->month('last_friday')
            ->endDate('2020-01-01')
            ->startDate('2019-01-01');

        $this->assertEquals($charge, $scheduler['charge']);
        $this->assertEquals(1, $scheduler['every']);
        $this->assertEquals('month', $scheduler['period']);
        $this->assertEquals(array('weekday_of_month' => 'last_friday'), $scheduler['on']);
        $this->assertEquals('2020-01-01', $scheduler['end_date']);
        $this->assertEquals('2019-01-01', $scheduler['start_date']);
    }
}
