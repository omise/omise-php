<?php
require_once dirname(__FILE__) . '/../../lib/Omise.php';

// Omise keys.
\Omise\Omise::setPublicKey('pkey');
\Omise\Omise::setSecretKey('skey');
\Omise\Omise::setApiVersion('2019-05-29');
\Omise\Omise::setClient('\Omise\Client\UnitTestClient');

abstract class TestConfig extends PHPUnit_Framework_TestCase
{
	// ...
}
