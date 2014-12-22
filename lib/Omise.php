<?php
require_once dirname(__FILE__).'/omise/OmiseAccount.php';
require_once dirname(__FILE__).'/omise/OmiseBalance.php';
require_once dirname(__FILE__).'/omise/OmiseTokens.php';
require_once dirname(__FILE__).'/omise/OmiseCharges.php';
require_once dirname(__FILE__).'/omise/OmiseCustomers.php';
require_once dirname(__FILE__).'/omise/OmiseTransfers.php';


// $object = OmiseTokens::create(array(
// 		'card[name]' => 'Somchai Prasert',
// 		'card[number]' => '4242424242424242',
// 		'card[expiration_month]' => 10,
// 		'card[expiration_year]' => 2018,
// 		'card[city]' => 'Bangkok',
// 		'card[postal_code]' => '10320',
// 		'card[security_code]' => 123

// ));
// var_dump($object);
// $object = OmiseTokens::create(array('card' => array(
// 		'name' => 'Somchai Prasert',
// 		'number' => '4242424242424242',
// 		'expiration_month' => 10,
// 		'expiration_year' => 2018,
// 		'city' => 'Bangkok',
// 		'postal_code' => '10320',
// 		'security_code' => 123
// )));
// $object = OmiseTokens::retrive('tokn_test_4yfpjbu99utp0m6xpp0');

// $object = OmiseCharges::retrive();
// $object = OmiseCharges::create(array(
//   'return_uri' => 'https://example.co.th/orders/384/complete',
//   'amount' => 100000,
//   'currency' => 'thb',
//   'description' => 'Order-384',
//   'ip' => '127.0.0.1',
//   'card' => 'tokn_test_4yfpjbu99utp0m6xpp0'
// ));
// $object = OmiseCharges::retrive('chrg_test_4ygsixowmlneebvpssg');
// $object->update(array(
// 	'description' => 'Another description'
// ));
// $object->capture();

// $object = OmiseCustomers::retrive();
// $object = OmiseCustomers::create(array(
// 	'email' => 'john.doe@example.com',
// 	'description' => 'John Doe (id: 30)',
// 	'card' => 'tokn_test_4ygsume4qijdokmuvh0'
// ));
// $object = OmiseCustomers::retrive('cust_test_4ygsutsiv9v20oez95s');
// $object->update(array(
// 	'email' => 'john.smith@example.com',
// 	'description' => 'Another description2'
// ));
// var_dump($object);

// $object = OmiseCustomers::retrive('cust_test_4ygsutsiv9v20oez95s');
// $object->destroy();
// $object->isDestroyed();
// var_dump($object);
// var_dump($object->isDestroyed());

$object = OmiseTransfers::retrive('trsf_test_4ygtjzidyi8wb6w2sqa');
// $object = OmiseTransfers::create(array(
// 	'amount' => 100000
// ));
$object->destroy();
$object->isDestroyed();
var_dump($object);