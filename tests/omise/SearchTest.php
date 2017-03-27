<?php require_once dirname(__FILE__).'/TestConfig.php';

class SearchTest extends TestConfig
{
    /**
     * OmiseSearch class must be contain methods as below.
     *
     */
    public function testMethodExists()
    {
        $this->assertTrue(method_exists('OmiseSearch', 'retrieve'));
        $this->assertTrue(method_exists('OmiseSearch', 'getUrl'));
    }

    /**
     * Assert that a list of search object could be retrieved charge object by
     * specific scope.
     *
     */
    public function testRetrieveSearchResultBySpecificScope()
    {
        $search = OmiseSearch::retrieve('charge');

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
        $search = OmiseSearch::retrieve('charge', 'thb');

        $this->assertArrayHasKey('object', $search);
        $this->assertEquals('search', $search['object']);
        $this->assertEquals('charge', $search['scope']);
        $this->assertEquals('thb', $search['query']);
    }

    /**
     * Assert that a list of search object could be retrieved charge object by
     * specific scope and query and filters some keys.
     *
     */
    public function testRetrieveSearchObjectBySpecificScopeAndQueryAndFilter()
    {
        $search = OmiseSearch::retrieve('charge', 'thb', array('captured' => true));

        $this->assertArrayHasKey('object', $search);
        $this->assertEquals('search', $search['object']);
        $this->assertEquals('charge', $search['scope']);
        $this->assertEquals('thb', $search['query']);
        $this->assertEquals(array('captured' => 'true'), $search['filters']);
    }

    /**
     * Assert that a list of search object could be retrieved charge object by
     * specific scope and query and filters some keys and page number
     *
     */
    public function testRetrieveSearchObjectBySpecificScopeAndQueryAndFilterAndPage()
    {
        $search = OmiseSearch::retrieve('charge', 'thb', array('captured' => true), 1);

        $this->assertArrayHasKey('object', $search);
        $this->assertEquals('search', $search['object']);
        $this->assertEquals('charge', $search['scope']);
        $this->assertEquals('thb', $search['query']);
        $this->assertEquals(array('captured' => 'true'), $search['filters']);
    }

    /**
     * Assert that a list of search object could be retrieved charge object by
     * specific scope and query and filters some keys and page number and order
     *
     */
    public function testRetrieveSearchObjectBySpecificScopeAndQueryAndFilterAndPageAndOrder()
    {
        $search = OmiseSearch::retrieve('charge', 'thb', array('captured' => true), 1, 'chronological');

        $this->assertArrayHasKey('object', $search);
        $this->assertEquals('search', $search['object']);
        $this->assertEquals('charge', $search['scope']);
        $this->assertEquals('thb', $search['query']);
        $this->assertEquals(array('captured' => 'true'), $search['filters']);
    }
}
