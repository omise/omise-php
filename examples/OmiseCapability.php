<?php

require_once 'vendor/autoload.php';
require_once 'lib/Omise.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Setting default keys
define('OMISE_PUBLIC_KEY', $_ENV['EXAMPLE_PUBLIC_KEY']);
define('OMISE_SECRET_KEY', $_ENV['EXAMPLE_SECRET_KEY']);

// Retrieve current account capability
$capability = OmiseCapability::retrieve();
echo sprintf('Country: %s', $capability['country']) . "\n";
echo sprintf('IsZeroInterestInstallments: %s', $capability['zero_interest_installments'] ? 'Yes' : 'No') . "\n\n";

// Get available payment methods
$paymentMethods = $capability->getPaymentMethods();

// Filter payment methods
$alipayPayments = $capability->getPaymentMethods(
    $capability->filterPaymentMethodName('alipay'),
    $capability->filterPaymentMethodChargeAmount(200000),
    $capability->filterPaymentMethodCurrency('thb')
);
// The above `filterPaymentMethodName` filters payment methods if name contains the given keyword
// For exact name match, use:
$alipayOnly = $capability->getPaymentMethods(
    $capability->filterPaymentMethodExactName('alipay'),
);

echo sprintf('Available payment methods: %s', json_encode($paymentMethods)) . "\n\n";
echo sprintf('Alipay2000THB: %s', json_encode($alipayPayments)) . "\n\n";
echo sprintf('AlipayOnly: %s', json_encode($alipayOnly)) . "\n\n";
