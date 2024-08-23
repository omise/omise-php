
<?php
require_once 'vendor/autoload.php';
require_once 'lib/Omise.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// setting default keys
define('OMISE_PUBLIC_KEY', $_ENV['PUBLIC_KEY_SG']);
define('OMISE_SECRET_KEY', $_ENV['SECRET_KEY_SG']);

// test customer key
$customerSG = 'cust_xxxx';

$pkeyTH = $_ENV['PUBLIC_KEY_TH'];
$skeyTH = $_ENV['SECRET_KEY_TH'];
$customerTH = 'cust_xxxx';

$pkeyMY = $_ENV['PUBLIC_KEY_MY'];
$skeyMY = $_ENV['SECRET_KEY_MY'];
$customerMY = 'cust_xxxx';

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

$chargeScheduleIdTH = $createResultTH->toArray()['id'];

echo sprintf('Created schedule ID (TH): %s', $chargeScheduleIdTH) . "\n";

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

$chargeScheduleIdMY = $createResultMY->toArray()['id'];

echo sprintf('Created schedule ID (MY): %s', $createResultMY->toArray()['id']) . "\n\n";

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

$chargeScheduleIdSG = $createResultSG->toArray()['id'];

echo sprintf('Created schedule ID (SG): %s', $createResultSG->toArray()['id']) . "\n";


// Fetching charge scedules

$resultTH = OmiseSchedule::retrieve($chargeScheduleIdTH, $pkeyTH, $skeyTH);

echo sprintf('Fetched schedule ID (TH): %s', $resultTH->toArray()['id']) . "\n\n";

$resultMY = OmiseSchedule::retrieve($chargeScheduleIdMY, $pkeyMY, $skeyMY);

echo sprintf('Fetched schedule ID (MY): %s', $resultMY->toArray()['id']) . "\n\n";

$resultSG = OmiseSchedule::retrieve($chargeScheduleIdSG);

echo sprintf('Fetched schedule ID (SG): %s', $resultSG->toArray()['id']) . "\n\n";
