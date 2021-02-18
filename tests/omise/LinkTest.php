<?php
require_once dirname(__FILE__).'/TestConfig.php';

class LinkTest extends TestConfig
{
    /**
     * @test
     * OmiseLink class must be contain some method below.
     */
    public function method_exists()
    {
        $this->assertTrue(method_exists('OmiseLink', 'retrieve'));
        $this->assertTrue(method_exists('OmiseLink', 'create'));
        $this->assertTrue(method_exists('OmiseLink', 'destroy'));
        $this->assertTrue(method_exists('OmiseLink', 'isDestroyed'));
        $this->assertTrue(method_exists('OmiseLink', 'getUrl'));
    }

    /**
     * @test
     * Assert that a list of link object could be successfully retrieved.
     */
    public function retrieve_link_list_object()
    {
        $link = OmiseLink::retrieve();

        $this->assertArrayHasKey('object', $link);
        $this->assertEquals('list', $link['object']);
    }

    /**
     * @test
     * Assert that a link is successfully created with the given parameters set.
     */
    public function create()
    {
        $link = OmiseLink::create(array('amount'      => 100000,
                                        'title'       => 'Order-384',
                                        'description' => 'New Product'));

        $this->assertArrayHasKey('object', $link);
        $this->assertEquals('link', $link['object']);
    }

    /**
     * @test
     * Assert that a link object is returned after a successful retrieve.
     */
    public function retrieve_specific_link_object()
    {
        $link = OmiseLink::retrieve('link_test_56bsanpa365jnlbc7rt');

        $this->assertArrayHasKey('object', $link);
        $this->assertEquals('link', $link['object']);
    }

    /**
     * @test
     * Assert that the link is successfully destroyed.
     */
    public function destroy()
    {
        $link = OmiseLink::retrieve('link_test_56bsanpa365jnlbc7rt');
        $link->destroy();

        $this->assertTrue($link->isDestroyed());
    }

    /**
     * @test
     * Assert that OmiseLink  can search for links.
     */
    public function search()
    {
        $result = OmiseLink::search('demo')
                                ->filter(array('used' => true))
                                ->order('reverse_chronological');

        $this->assertArrayHasKey('object', $result);
        $this->assertEquals('search', $result['object']);

        foreach ($result['data'] as $item) {
            $this->assertArrayHasKey('object', $item);
            $this->assertEquals('link', $item['object']);
        }
    }
}
