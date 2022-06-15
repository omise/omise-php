<?php
require_once dirname(__FILE__).'/../TestConfig.php';

class OmiseApiResourceTest extends TestConfig
{
    private $apiResource;

    private $mockHandler;

    protected function setUp()
    {
        $this->mockHandler = new \GuzzleHttp\Handler\MockHandler();

        $httpClient = new \GuzzleHttp\Client([
            'handler' => $this->mockHandler,
        ]);

        $this->apiResource = new OmiseApiResource();
        $this->apiResource->setHttpClient($httpClient);
    }

    /**
     * @test
     */
    public function create_a_charge()
    {
        $params = [
            'url' => 'https://api.omise.co/charges',
            'requestMethod' => 'POST',
            'key' => 'skey',
            'params' => [
                'amount' => 100000,
                'currency' => 'thb',
                'description' => 'Order-384',
                'ip' => '127.0.0.1',
                'card' => 'tokn_test_4zmrjhuk2rndz24a6x0'
            ]
        ];
        $this->mockHandler->append(new \GuzzleHttp\Psr7\Response(200, [], file_get_contents(__DIR__.'/../../fixtures/api.omise.co/charges/chrg_test_4zmrjgxdh4ycj2qncoj/capture-post.json')));

        $filteredResult = $this->invokePrivateMethod($this->apiResource, '_executeCurl', $params);
        $returnValue = json_decode($filteredResult, true);

        $this->assertArrayHasKey('object', $returnValue);
        $this->assertEquals('charge', $returnValue['object']);
        
    }
}