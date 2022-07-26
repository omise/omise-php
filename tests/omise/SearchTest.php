<?php require_once dirname(__FILE__).'/TestConfig.php';

class SearchTest extends TestConfig
{
    /**
     * OmiseSearch class must be contain methods as below.
     *
     */
    public function testMethodExists()
    {
        $this->assertTrue(method_exists('OmiseSearch', 'scope'));
        $this->assertTrue(method_exists('OmiseSearch', 'getUrl'));
    }

    /**
     * Assert that a list of search object could be retrieved charge object by
     * specific scope.
     *
     */
    public function testRetrieveSearchResultBySpecificScope()
    {
        $search = OmiseSearch::scope('charge');

        $this->assertArrayHasKey('object', $search);
        $this->assertEquals('search', $search['object']);
        $this->assertEquals('charge', $search['scope']);
    }

    /**
     * Assert that a list of search object could be retrieved charge object by
     * specific scope.
     *
     */
    public function testRetrieveSearchResultWithOmiseKeys()
    {
        $search = OmiseSearch::scope('charge', OMISE_PUBLIC_KEY, OMISE_SECRET_KEY);

        $this->assertArrayHasKey('object', $search);
        $this->assertEquals('search', $search['object']);
        $this->assertEquals('charge', $search['scope']);
    }

    /**
     * Assert that a list of search object could be retrieved charge object by
     * specific scope and query.
     *
     */
    public function testRetrieveSearchObjectBySpecificScopeAndQuery()
    {
        $search = OmiseSearch::scope('charge')->query('demo');

        $this->assertArrayHasKey('object', $search);
        $this->assertEquals('search', $search['object']);
        $this->assertEquals('charge', $search['scope']);
        $this->assertEquals('demo', $search['query']);
    }

    /**
     * Assert that a list of search object could be retrieved charge object by
     * specific scope and query and filters some keys.
     *
     */
    public function testRetrieveSearchObjectBySpecificScopeAndQueryAndFilter()
    {
        $search = OmiseSearch::scope('charge')
            ->query('demo')
            ->filter(array('captured' => true));

        $this->assertArrayHasKey('object', $search);
        $this->assertEquals('search', $search['object']);
        $this->assertEquals('charge', $search['scope']);
        $this->assertEquals('demo', $search['query']);
        $this->assertEquals(array('captured' => 'true'), $search['filters']);
    }

    /**
     * Assert that a list of search object could be retrieved charge object by
     * specific scope and query and filters some keys and page number
     *
     */
    public function testRetrieveSearchObjectBySpecificScopeAndQueryAndFilterAndPage()
    {
        $search = OmiseSearch::scope('charge')
            ->query('demo')
            ->filter(array('captured' => true))
            ->page(2);

        $this->assertArrayHasKey('object', $search);
        $this->assertEquals('search', $search['object']);
        $this->assertEquals('charge', $search['scope']);
        $this->assertEquals('demo', $search['query']);
        $this->assertEquals(array('captured' => 'true'), $search['filters']);
    }

    /**
     * Assert that a list of search object could be retrieved charge object by
     * specific scope and query and filters some keys and page number and order
     *
     */
    public function testRetrieveSearchObjectBySpecificScopeAndQueryAndFilterAndPageAndOrder()
    {
        $search = OmiseSearch::scope('charge')
            ->query('demo')
            ->filter(array('captured' => true))
            ->page(2)
            ->order('reverse_chronological');

        $this->assertArrayHasKey('object', $search);
        $this->assertEquals('search', $search['object']);
        $this->assertEquals('charge', $search['scope']);
        $this->assertEquals('demo', $search['query']);
        $this->assertEquals(array('captured' => 'true'), $search['filters']);
    }

    /**
     * Assert that items of search object can be shown at a specific amount
     * given by 'per_page' number.
     */
    public function testSetLimit()
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
