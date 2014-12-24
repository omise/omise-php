<?php
require_once dirname(__FILE__).'/../lib/Omise.php';

$customer = OmiseCustomer::retrieve('cust_test_4ybb9ymhoi7ju6wuizb');
$cards = $customer->getCards();

$customer = OmiseCustomer::retrieve('cust_test_4ybb9ymhoi7ju6wuizb');
$card = $customer->getCards()->retrieve('card_test_4ybb9yic91yw7btqn40');
$card->reload();

$customer = OmiseCustomer::retrieve('cust_test_4ybb9ymhoi7ju6wuizb');
$card = $customer->getCards()->retrieve('card_test_4ybb9yic91yw7btqn40');
$card->update(array(
	'expiration_month' => 11,
	'expiration_year' => 2017,
	'name' => 'Somchai Praset',
	'postal_code' => '10310'
));

$customer = OmiseCustomer::retrieve('cust_test_4ybb9ymhoi7ju6wuizb');
$card = $customer->getCards()->retrieve('card_test_4ybb9yic91yw7btqn40');
$card->destroy();
$card->isDestroyed();