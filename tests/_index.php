<?php

/**
 * This file is included in PHP unit test and this will run before triggering unit test.
 * The goal of this file is
 * 1. to set secret key and public key in one place
 * 2. to create customer and card and set in global keyword OMISE_CUSTOMER_ID & OMISE_CARD_ID
 * so that we can reuse in other test cases.
 */

/**
 * Omise Keys
 */
$publicKey = str_replace('::add-mask::', '', getenv('PUBLIC_KEY'));
$secretKey = str_replace('::add-mask::', '', getenv('SECRET_KEY'));

define('OMISE_PUBLIC_KEY', $publicKey);
define('OMISE_SECRET_KEY', $secretKey);
define('OMISE_API_VERSION', '2017-11-02');

include __DIR__ . '/traits/ChargeTrait.php';

/**
 * this function is created to debug easily
 */
function dd($value)
{
    print_r($value);

    die();
}

$token = OmiseToken::create([
    'card' => [
        'name' => 'Zin Kyaw Kyaw',
        'number' => '4242424242424242',
        'expiration_month' => 11,
        'expiration_year' => date('Y', strtotime('+2 years')),
        'city' => 'Bangkok',
        'postal_code' => '10320',
        'security_code' => 123
    ]
]);

$customer = OmiseCustomer::create([
    'email' => 'zinkyawkyaw@example.com',
    'description' => 'Zin Kyaw Kyaw',
    'card' => $token['id']
]);

// set in global keyword OMISE_CUSTOMER_ID & OMISE_CARD_ID to reuse in other test cases
define('OMISE_CUSTOMER_ID', $customer['id']);
define('OMISE_CARD_ID', $customer['cards']['data'][0]['id']);
