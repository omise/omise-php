<?php
require_once dirname(__FILE__).'/TestConfig.php';

class ScheduleTest extends TestConfig
{
    /**
     * @test
     */
    public function existing_methods()
    {
        $this->assertTrue(method_exists('OmiseSchedule', 'retrieve'));
        $this->assertTrue(method_exists('OmiseSchedule', 'reload'));
        $this->assertTrue(method_exists('OmiseSchedule', 'create'));
        $this->assertTrue(method_exists('OmiseSchedule', 'destroy'));
        $this->assertTrue(method_exists('OmiseSchedule', 'isDestroyed'));
        $this->assertTrue(method_exists('OmiseSchedule', 'getUrl'));
    }

    /**
     * @test
     */
    public function create()
    {
        $customer = array(
            'customer'    => 'cust_test_585t0gn3yxe6aeq9wq7',
            'amount'      => 100000,
            'description' => 'Membership Fee',
        );
        $endDate = '2020-12-01';

        $schedule = OmiseSchedule::create(array(
            'charge'   => $customer,
            'every'    => 7,
            'period'   => 'day',
            'end_date' => $endDate
        ));

        $this->assertArrayHasKey('object', $schedule);
        $this->assertEquals('schedule', $schedule['object']);
        $this->assertEquals($schedule['every'], 7);
        $this->assertEquals($schedule['period'], 'day');
        $this->assertEquals($schedule['end_date'], $endDate);
    }

    /**
     * @test
     */
    public function retrieve_list()
    {
        $schedules = OmiseSchedule::retrieve();

        $this->assertArrayHasKey('object', $schedules);
        $this->assertEquals('list', $schedules['object']);
        $this->assertEquals('schedule', $schedules['data'][0]['object']);
    }

    /**
     * @test
     */
    public function reload_list()
    {
        $schedules = OmiseSchedule::retrieve();
        $schedules->reload();

        $this->assertArrayHasKey('object', $schedules);
        $this->assertEquals('list', $schedules['object']);
        $this->assertEquals('schedule', $schedules['data'][0]['object']);
    }

    /**
     * @test
     */
    public function retrieve_by_a_given_id()
    {
        $id = 'schd_test_585t7iomh2dte3ejxh5';

        $schedule = OmiseSchedule::retrieve($id);

        $this->assertArrayHasKey('object', $schedule);
        $this->assertEquals('schedule', $schedule['object']);
        $this->assertEquals($id, $schedule['id']);
    }

    /**
     * @test
     */
    public function reload()
    {
        $id = 'schd_test_585t7iomh2dte3ejxh5';

        $schedule = OmiseSchedule::retrieve($id);
        $schedule->reload();

        $this->assertArrayHasKey('object', $schedule);
        $this->assertEquals('schedule', $schedule['object']);
        $this->assertEquals($id, $schedule['id']);
    }

    /**
     * @test
     */
    public function retrieve_occurrences_list()
    {
        $schedule    = OmiseSchedule::retrieve('schd_test_585t7iomh2dte3ejxh5');
        $occurrences = $schedule->occurrences();

        $this->assertArrayHasKey('object', $occurrences);
        $this->assertEquals('list', $occurrences['object']);
    }

    /**
     * @test
     */
    public function retrieve_occurrences_by_a_given_id()
    {
        $schedule   = OmiseSchedule::retrieve('schd_test_585t7iomh2dte3ejxh5');
        $occurrence = $schedule->occurrences()->retrieve('occu_test_58dt3strf4m1y7bqii8');

        $this->assertArrayHasKey('object', $occurrence);
        $this->assertEquals('occurrence', $occurrence['object']);
    }

    /**
     * @test
     */
    public function retrieve_null_occurrence()
    {
        $schedules = OmiseSchedule::retrieve();

        $this->assertNull($schedules->occurrences());
    }

    /**
     * @test
     */
    public function destroy()
    {
        $schedule = OmiseSchedule::retrieve('schd_test_585t7iomh2dte3ejxh5');
        $schedule->destroy();

        $this->assertArrayHasKey('object', $schedule);
        $this->assertTrue($schedule->isDestroyed());
    }
}
