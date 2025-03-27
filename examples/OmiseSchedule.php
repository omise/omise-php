<?php

require_once 'vendor/autoload.php';
require_once 'lib/Omise.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Setting default keys
define('OMISE_PUBLIC_KEY', $_ENV['EXAMPLE_PUBLIC_KEY']);
define('OMISE_SECRET_KEY', $_ENV['EXAMPLE_SECRET_KEY']);

$pkey = $_ENV['EXAMPLE_PUBLIC_KEY'];
$skey = $_ENV['EXAMPLE_SECRET_KEY'];
// Test customer ID - `cust_xxxx`
$customer = $_ENV['EXAMPLE_CUSTOMER_ID'];

// Create schedule
// OMISE_PUBLIC_KEY and OMISE_SECRET_KEY can be omitted if constants are defined
$createResult = OmiseSchedule::create([
    'every' => 15,
    'period' => 'day',
    'start_date' => '2025-05-01',
    'end_date' => '2025-05-31',
    'charge[customer]' => $customer,
    'charge[amount]' => 100000,
    'charge[description]' => 'Testing schedule',
], OMISE_PUBLIC_KEY, OMISE_SECRET_KEY);

$chargeScheduleId = $createResult['id'];
echo sprintf('Created schedule ID: %s', $chargeScheduleId) . "\n";

$result = OmiseSchedule::retrieve($chargeScheduleId, OMISE_PUBLIC_KEY, OMISE_SECRET_KEY);
echo sprintf('Fetched schedule ID: %s', $result['id']) . "\n\n";
