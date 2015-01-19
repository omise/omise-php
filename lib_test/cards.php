<?php

require_once dirname(__FILE__).'/../lib/Omise.php';

define('OMISE_PUBLIC_KEY', 'pkey');
define('OMISE_SECRET_KEY', 'skey');

// list all
$customer = OmiseCustomer::retrieve('cust_test_4xsjvylia03ur542vn6');
$cards = $customer->getCards();

// retrieve
$customer = OmiseCustomer::retrieve('cust_test_4xsjvylia03ur542vn6');
$card = $customer->getCards()->retrieve('card_test_4xsjw0t21xaxnuzi9gs');
$card->reload();

// update
$customer = OmiseCustomer::retrieve('cust_test_4xsjvylia03ur542vn6');
$card = $customer->getCards()->retrieve('card_test_4xsjw0t21xaxnuzi9gs');
$card->update(array(
	'expiration_month' => 11,
	'expiration_year' => 2017,
	'name' => 'Somchai Praset',
	'postal_code' => '10310'
));

// destroy
$customer = OmiseCustomer::retrieve('cust_test_4xsjvylia03ur542vn6');
$card = $customer->getCards()->retrieve('card_test_4xsjw0t21xaxnuzi9gs');
$card->destroy();
$card->isDestroyed();
