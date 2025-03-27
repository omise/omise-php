<?php

require_once 'vendor/autoload.php';
require_once 'lib/Omise.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Setting default keys
define('OMISE_PUBLIC_KEY', $_ENV['EXAMPLE_PUBLIC_KEY']);
define('OMISE_SECRET_KEY', $_ENV['EXAMPLE_SECRET_KEY']);

$token = OmiseToken::create([
    'card' => [
        'name' => 'Omise',
        'number' => '4242424242424242',
        'expiration_month' => 10,
        'expiration_year' => 2042,
        'city' => 'Bangkok',
        'postal_code' => '10320',
        'security_code' => 123
    ]
]);

// Create a charge
$chargeCreated = OmiseCharge::create([
    'amount' => 100000,
    'currency' => 'thb',
    'return_uri' => 'http://www.example.com',
    'card' => $token['id'],
    'capture' => false
]);

// Retrieve charge by ID
$chargeFetched = OmiseCharge::retrieve($chargeCreated['id']);

// Capture the amount
$chargeFetched->capture(['capture_amount' => 100000 / 2]);

// Refund the amount
$chargeRefund = $chargeFetched->refunds()->create(['amount' => 100000]);

echo sprintf('New Charge ID: %s', $chargeCreated['id']) . "\n";
echo sprintf('Fetched Charge ID: %s', $chargeFetched['id']) . "\n";
echo sprintf('Refund ID: %s', $chargeRefund['id']) . "\n\n";
