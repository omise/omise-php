<?php

require_once __DIR__ . '/../../UnitTestCase.php';
use Brain\Monkey\Functions;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class OmiseHttpExecutorTest extends UnitTestCase
{
    public function setUp(): void
    {
        define('OMISE_PHP_LIB_VERSION', '2.18.0');
        define('OMISE_API_VERSION', '2019-05-29');
    }

    /**
     * @dataProvider execute_http_request_provider
     */
    public function test_execute_http_request_returns_successful_response($requestMethod)
    {
        $key = 'pkey_xxx';
        $url = 'https://www.omise.co';
        $params = [
            'numbers' => [12345],
            'string' => 'value',
        ];

        $expectedUserAgent = sprintf('OmisePHP/2.18.0 PHP/%s OmiseAPI/2019-05-29', PHP_VERSION);
        $expectedCurlOpts = [
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $requestMethod,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLINFO_HEADER_OUT => true,
            CURLOPT_AUTOREFERER => true,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_USERPWD => $key . ':',
            CURLOPT_HTTPHEADER => ['Omise-Version: 2019-05-29'],
            CURLOPT_USERAGENT => $expectedUserAgent,
            CURLOPT_POSTFIELDS => 'numbers%5B%5D=12345&string=value',
        ];

        $this->mockCurl(
            $url,
            function () {
                return '{"success":1}';
            },
            function ($data) use ($expectedCurlOpts) {
                return json_encode($expectedCurlOpts) === json_encode($data);
            }
        );

        $result = (new OmiseHttpExecutor())->execute($url, $requestMethod, $key, $params);

        $this->assertEquals($result, '{"success":1}');
    }

    public function execute_http_request_provider()
    {
        return [
            ['GET'],
            ['POST'],
            ['PATCH'],
            ['DELETE'],
        ];
    }

    public function test_execute_http_request_with_custom_agent_suffix()
    {
        define('OMISE_USER_AGENT_SUFFIX', 'MyApp');
        $url = 'https://www.omise.co';

        $expectedUserAgent = sprintf('OmisePHP/2.18.0 PHP/%s OmiseAPI/2019-05-29 MyApp', PHP_VERSION);
        $this->mockCurl(
            $url,
            function () {
                return '{"success":1}';
            },
            function ($data) use ($expectedUserAgent) {
                return $data[CURLOPT_USERAGENT] === $expectedUserAgent;
            }
        );

        $result = (new OmiseHttpExecutor())->execute($url, 'GET', 'pkey_xxx');

        $this->assertEquals($result, '{"success":1}');
    }

    public function test_execute_http_request_returns_failed_response()
    {
        $url = 'https://www.omise.co';

        Functions\expect('curl_error')->once()->andReturn('Request Timeout');
        $this->mockCurl(
            $url,
            function () {
                return false;
            },
            function ($data) {
                return true;
            }
        );

        $this->expectExceptionMessage('Request Timeout');

        (new OmiseHttpExecutor())->execute($url, 'GET', 'pkey_xxx');
    }

    private function mockCurl($url, $curlFn, $assertCurlOptsFn)
    {
        Functions\expect('curl_init')->once()->with($url);
        Functions\expect('curl_setopt_array')
            ->once()
            ->with(Mockery::any(), Mockery::on($assertCurlOptsFn));
        Functions\expect('curl_exec')->andReturnUsing($curlFn);
        Functions\expect('curl_close')->once();
    }
}
