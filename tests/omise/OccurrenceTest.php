<?php
require_once dirname(__FILE__).'/TestConfig.php';

class OccurrenceTest extends TestConfig
{
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
        $id = 'occu_test_58dt3strf4m1y7bqii8';

        $occurrence = OmiseOccurrence::retrieve($id);

        $this->assertArrayHasKey('object', $occurrence);
        $this->assertEquals('occurrence', $occurrence['object']);
        $this->assertEquals($occurrence['id'], $id);
    }

    /**
     * @test
     */
    public function reload()
    {
        $occurrence = OmiseOccurrence::retrieve('occu_test_58dt3strf4m1y7bqii8');
        $occurrence->reload();

        $this->assertArrayHasKey('object', $occurrence);
        $this->assertEquals('occurrence', $occurrence['object']);
    }
}
