<?php
require_once dirname(__FILE__).'/../../TestConfig.php';
require_once dirname(__FILE__).'/../../../../lib/omise/OmiseTest.php';

class OmiseObjectTest extends TestConfig
{
    public static $obj;

    /**
     * @test
     * Retrieve OmiseObject attributes.
     */
    public function create_object()
    {
        self::$obj = OmiseTest::resource();

        $this->assertInstanceOf('OmiseTest', self::$obj);
        $this->assertEmpty(self::$obj);
    }

    /**
     * @test
     * Try to merge some array into Object.
     *
     */
    public function merge_some_value_to_object()
    {
        self::$obj->refresh(array('user'  => 'nam',
                                  'email' => 'nam@omise.co'));

        $this->assertArrayHasKey('user', self::$obj);
        $this->assertEquals('nam', self::$obj['user']);

        $this->assertArrayHasKey('email', self::$obj);
        $this->assertEquals('nam@omise.co', self::$obj['email']);
    }

    /**
     * @test
     * Try to merge some array into object with the same key that object had,
     * It should be overwrite the old value with the new value.
     */
    public function merge_some_value_to_object_with_the_same_key()
    {
        self::$obj->refresh(array('user'  => 'Omise',
                                  'email' => 'no-reply@omise.co'));

        $this->assertArrayHasKey('user', self::$obj);
        $this->assertEquals('Omise', self::$obj['user']);

        $this->assertArrayHasKey('email', self::$obj);
        $this->assertEquals('no-reply@omise.co', self::$obj['email']);
    }

    /**
     * @test
     * Try to merge some array and set clear old data parameter to `true` in second param,
     * It should be reset all of Object value to empty array before merge.
     */
    public function merge_some_value_to_object_with_clear_data()
    {
        self::$obj->refresh(array('user'  => 'Omise-Team'), true);

        $this->assertArrayHasKey('user', self::$obj);
        $this->assertEquals('Omise-Team', self::$obj['user']);

        $this->assertArrayNotHasKey('email', self::$obj);
    }

    /**
     * @test
     * Test add new offset via `offetSet` method.
     */
    public function set_new_value_with_offset_set_method()
    {
        self::$obj->offsetSet('phone', '012-345-6789');

        $this->assertArrayHasKey('phone', self::$obj);
        $this->assertEquals('012-345-6789', self::$obj['phone']);
    }

    /**
     * @test
     * Test `offsetExists` method should return `true` if offset exists
     * and `false` if it not.
     */
    public function method_for_check_offset_exists()
    {
        $this->assertTrue(self::$obj->offsetExists('phone'));
        $this->assertNotTrue(self::$obj->offsetExists('phone_dump'));
    }

    /**
     * @test
     * Test unset offset.
     */
    public function unset_offset()
    {
        self::$obj->offsetUnset('phone');
        $this->assertNotTrue(self::$obj->offsetExists('phone'));
    }

    /**
     * @test
     * Test get offset value with offset that exists and not exists.
     */
    public function get_offset()
    {
        $this->assertEquals('Omise-Team', self::$obj->offsetGet('user'));
        $this->assertNull(self::$obj->offsetGet('phone'));
    }

    /**
     * @test
     * Test iteration control.
     */
    public function loop_iteration_control()
    {
        self::$obj->refresh(array('user'      => 'nam',
                                  'address'   => 'CDC'));

        // Count an array.
        $this->assertEquals(2, self::$obj->count());

        // Get current value.
        $this->assertEquals('nam', self::$obj->current());

        // Get current key.
        $this->assertEquals('user', self::$obj->key());

        // Move pointer to next place one.
        self::$obj->next();
        $this->assertEquals('CDC', self::$obj->current());

        self::$obj->next();
        $this->assertNotTrue(self::$obj->valid());

        // Reset pointer to first place.
        self::$obj->rewind();
        $this->assertTrue(self::$obj->valid());
        $this->assertEquals('nam', self::$obj->current());
    }
}
