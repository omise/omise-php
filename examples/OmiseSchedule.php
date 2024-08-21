
<?php
require_once 'vendor/autoload.php';
require_once "lib/Omise.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// setting default keys
define('OMISE_PUBLIC_KEY', $_ENV['PUBLIC_KEY_SG']);
define('OMISE_SECRET_KEY', $_ENV['SECRET_KEY_SG']);

// test customer key
$customerSG = 'cust_test_60owl03ul8bzdk0h5ph';

$pkeyTH = $_ENV['PUBLIC_KEY_TH'];
$skeyTH = $_ENV['SECRET_KEY_TH'];
$customerTH = 'cust_test_60ilwqkl9khiex66p4s';

$pkeyMY = $_ENV['PUBLIC_KEY_MY'];
$skeyMY = $_ENV['SECRET_KEY_MY'];
$customerMY = 'cust_5u4m6n6tlhduy9savs8';

// Create schedule under TH PSP
$createResultTH = OmiseSchedule::create([
    'every' => 15,
    'period' => 'day',
    'start_date' => '2025-01-01',
    'end_date' => '2025-03-31',
    'charge[customer]' => $customerTH,
    'charge[amount]' => 100000,
    'charge[description]' => 'Testing schedule',
], $pkeyTH, $skeyTH);

echo sprintf("Created schedule ID (TH): %s", $createResultTH->toArray()['id']) . "\n";

$resultTH = OmiseSchedule::retrieve($createResultTH->toArray()['id'], $pkeyTH, $skeyTH);

echo sprintf("Fetched schedule ID (TH): %s", $resultTH->toArray()['id']) . "\n\n";

// Create schedule under MY PSP
$createResultMY = OmiseSchedule::create([
    'every' => 15,
    'period' => 'day',
    'start_date' => '2025-01-01',
    'end_date' => '2025-03-31',
    'charge[customer]' => $customerMY,
    'charge[amount]' => 100000,
    'charge[description]' => 'Testing schedule',
], $pkeyMY, $skeyMY);

echo sprintf("Created schedule ID (MY): %s", $createResultMY->toArray()['id']) . "\n";

$resultMY = OmiseSchedule::retrieve($createResultMY->toArray()['id'], $pkeyMY, $skeyMY);

echo sprintf("Fetched schedule ID (MY): %s", $resultMY->toArray()['id']) . "\n\n";

// Create schedule under SG PSP
$createResultSG = OmiseSchedule::create([
    'every' => 15,
    'period' => 'day',
    'start_date' => '2025-01-01',
    'end_date' => '2025-03-31',
    'charge[customer]' => $customerSG,
    'charge[amount]' => 100000,
    'charge[description]' => 'Testing schedule',
]);

echo sprintf("Created schedule ID (SG): %s", $createResultSG->toArray()['id']) . "\n";

$resultSG = OmiseSchedule::retrieve($createResultSG->toArray()['id']);

echo sprintf("Fetched schedule ID (SG): %s", $resultSG->toArray()['id']) . "\n\n";
