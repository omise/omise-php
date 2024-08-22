
<?php
require_once 'vendor/autoload.php';
require_once 'lib/Omise.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// setting default keys
define('OMISE_PUBLIC_KEY', $_ENV['PUBLIC_KEY_TH']);
define('OMISE_SECRET_KEY', $_ENV['SECRET_KEY_TH']);

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

$chargeCreated = OmiseCharge::create([
    'amount' => 100000,
    'currency' => 'thb',
    'return_uri' => 'http://www.example.com',
    'card' => $token->toArray()['id'],
    'capture' => false
]);

$chargeFetched = OmiseCharge::retrieve($chargeCreated->toArray()['id']);
echo print_r($chargeFetched, true);

// Capture the amount
$chargeFetched->capture(['capture_amount' => 100000 / 2]);

// Refund the amount
$chargeRefund = $chargeFetched->refunds()->create(['amount' => 100000]);

echo sprintf('New Charge ID (TH): %s', $chargeCreated->toArray()['id']) . '\n';
echo sprintf('Fetched Charge ID (TH): %s', $chargeFetched->toArray()['id']) . '\n';
echo print_r($chargeFetched, true);
echo sprintf('Refund ID (TH): %s', $chargeRefund->toArray()['id']) . '\n\n';
