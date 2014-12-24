<?php
require_once dirname(__FILE__).'/../lib/Omise.php';

$tokens = OmiseTokens::create(
	array('card' => array(
		'name' => 'Somchai Prasert',
		'number' => '4242424242424242',
		'expiration_month' => 10,
		'expiration_year' => 2018,
		'city' => 'Bangkok',
		'postal_code' => '10320',
		'security_code' => 123
	))
);

$tokens = OmiseTokens::retrieve('tokn_test_4yhjzedpby2e0e75rbe');
var_dump($tokens);