<?php

// Omise keys.
define('OMISE_PUBLIC_KEY', getenv('PUBLIC_KEY'));
define('OMISE_SECRET_KEY', getenv('SECRET_KEY'));
define('OMISE_API_VERSION', '2017-11-02');

include __DIR__ . '/traits/ChargeTrait.php';

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

define('OMISE_CUSTOMER_ID', $customer['id']);
define('OMISE_CARD_ID', $customer['cards']['data'][0]['id']);
