<?php
require_once dirname(__FILE__).'/../lib/Omise.php';

$customer = OmiseCustomer::retrieve();

$customer = OmiseCustomer::create(array(
	'email' => 'john.doe@example.com',
	'description' => 'John Doe (id: 30)',
	'card' => 'tokn_test_4yhkav9xexs21xmtk72'
));

$customer = OmiseCustomer::retrieve('cust_test_4yhkb538v4u6zk0jtqh');

$customer = OmiseCustomer::retrieve('cust_test_4yhkb538v4u6zk0jtqh');
$customer->update(array(
	'email' => 'john.smith@example.com',
	'description' => 'Another description'
));

$customer = OmiseCustomer::retrieve('cust_test_4yhkb538v4u6zk0jtqh');
$customer->destroy();