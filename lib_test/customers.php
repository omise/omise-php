<?php

require_once dirname(__FILE__).'/../lib/Omise.php';

define('OMISE_PUBLIC_KEY', 'pkey');
define('OMISE_SECRET_KEY', 'skey');

// list all
$customer = OmiseCustomer::retrieve();

// create
$customer = OmiseCustomer::create(array(
	'email' => 'john.doe@example.com',
	'description' => 'John Doe (id: 30)',
	'card' => 'tokn_test_4xs9408a642a1htto8z'
));

// retrieve
$customer = OmiseCustomer::retrieve('cust_test_4xtrb759599jsxlhkrb');

// update
$customer = OmiseCustomer::retrieve('cust_test_4xtrb759599jsxlhkrb');
$customer->update(array(
	'email' => 'john.smith@example.com',
	'description' => 'Another description'
));

// destroy
$customer = OmiseCustomer::retrieve('cust_test_4xtrb759599jsxlhkrb');
$customer->destroy();
$customer->isDestroyed();
