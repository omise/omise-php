<?php

use PHPUnit\Framework\TestCase;

class SearchTest extends TestCase
{
    /**
     * @test
     * OmiseSearch class must be contain methods as below.
     */
    public function method_exists()
    {
        $this->assertTrue(method_exists('OmiseSearch', 'scope'));
        $this->assertTrue(method_exists('OmiseSearch', 'getUrl'));
    }

    /**
     * @test
     * Assert that a list of search object could be retrieved charge object by
     * specific scope.
     */
    public function retrieve_search_result_by_specific_scope()
    {
        $search = OmiseSearch::scope('charge');
        $this->assertArrayHasKey('object', $search);
        $this->assertEquals('search', $search['object']);
        $this->assertEquals('charge', $search['scope']);
    }

    /**
     * @test
     * Assert that a list of search object could be retrieved charge object by
     * specific scope.
     */
    public function retrieve_search_result_with_omise_keys()
    {
        $search = OmiseSearch::scope('charge', OMISE_PUBLIC_KEY, OMISE_SECRET_KEY);
        $this->assertArrayHasKey('object', $search);
        $this->assertEquals('search', $search['object']);
        $this->assertEquals('charge', $search['scope']);
    }

    /**
     * @test
     * Assert that a list of search object could be retrieved charge object by
     * specific scope and query.
     */
    public function retrieve_search_object_by_specific_scope_and_query()
    {
        $search = OmiseSearch::scope('charge')->query('demo');
        $this->assertArrayHasKey('object', $search);
        $this->assertEquals('search', $search['object']);
        $this->assertEquals('charge', $search['scope']);
        $this->assertEquals('demo', $search['query']);
    }

    /**
     * @test
     * Assert that a list of search object could be retrieved charge object by
     * specific scope and query and filters some keys.
     */
    public function retrieve_search_object_by_specific_scope_and_query_and_filter()
    {
        $search = OmiseSearch::scope('charge')
            ->query('demo')
            ->filter(['captured' => true]);

        $this->assertArrayHasKey('object', $search);
        $this->assertEquals('search', $search['object']);
        $this->assertEquals('charge', $search['scope']);
        $this->assertEquals('demo', $search['query']);
        $this->assertEquals(['captured' => 'true'], $search['filters']);
    }

    /**
     * @test
     * Assert that a list of search object could be retrieved charge object by
     * specific scope and query and filters some keys and page number
     */
    public function retrieve_search_object_by_specific_scope_and_query_and_filter_and_page()
    {
        $search = OmiseSearch::scope('charge')
            ->query('demo')
            ->filter(['captured' => true])
            ->page(2);

        $this->assertArrayHasKey('object', $search);
        $this->assertEquals('search', $search['object']);
        $this->assertEquals('charge', $search['scope']);
        $this->assertEquals('demo', $search['query']);
        $this->assertEquals(['captured' => 'true'], $search['filters']);
    }

    /**
     * @test
     * Assert that a list of search object could be retrieved charge object by
     * specific scope and query and filters some keys and page number and order
     */
    public function retrieve_search_object_by_specific_scope_and_query_and_filter_and_page_and_order()
    {
        $search = OmiseSearch::scope('charge')
            ->query('demo')
            ->filter(['captured' => true])
            ->page(2)
            ->order('reverse_chronological');

        $this->assertArrayHasKey('object', $search);
        $this->assertEquals('search', $search['object']);
        $this->assertEquals('charge', $search['scope']);
        $this->assertEquals('demo', $search['query']);
        $this->assertEquals(['captured' => 'true'], $search['filters']);
    }

    /**
     * @test
     * Assert that items of search object can be shown at a specific amount
     * given by 'per_page' number.
     */
    public function set_limit()
    {
        $search = OmiseSearch::scope('charge')
            ->query('demo')
            ->per_page(2)
            ->order('reverse_chronological');

        $this->assertArrayHasKey('object', $search);
        $this->assertEquals('search', $search['object']);
        $this->assertEquals('charge', $search['scope']);
        $this->assertEquals('demo', $search['query']);
        $this->assertEquals(2, $search['per_page']);
    }
}
