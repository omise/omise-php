<?php

// Omise keys.
define('OMISE_PUBLIC_KEY', 'pkey');
define('OMISE_SECRET_KEY', 'skey');

// Include necessary file.
if (version_compare(phpversion(), '5.3.2') >= 0 && file_exists(dirname(__FILE__).'/../../vendor/autoload.php')) {
    require_once dirname(__FILE__).'/../../vendor/autoload.php';
} else {
    require_once dirname(__FILE__).'/../../lib/Omise.php';
}

abstract class TestConfig extends PHPUnit_Framework_TestCase
{
    /**
     * Test private and protected methods.
     *
     * @param  object &$object
     * @param  string $methodName
     * @param  array  $parameters
     * @return
     */
    public function invokePrivateMethod(&$object, $methodName, array $parameters = [])
	{
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $parameters);
	}
}
