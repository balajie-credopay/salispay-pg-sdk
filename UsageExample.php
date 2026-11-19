<?php
require_once 'vendor/autoload.php';
require_once 'src/Config.php';
require_once 'src/SalisPayPaymentGateway.php';
require_once 'src/resources/OrderAPI.php';
require_once 'src/resources/TransactionAPI.php';

use SalisPay\SalisPayPaymentGateway;

$gateway = new SalisPayPaymentGateway('65a621098498347eeecfe0a0', '1AhZX3SKzN3NdxuxrlQvgT8j3');

// Create an order
$orderData = [
    'receiptId' => 'RE_DVGSD24535SFGER01',
    'amount' => 1,
    'currency' => 'INR',
    'description' => 'Test Payment',
    'customerFields' => [
        'name' => 'Kishore',
        'email' => 'kishore.s@salispay.in',
        'phone' => '90036440'
    ],
    'uiMode' => 'checkout',
    'redirectType' => 'redirect'
];

try {
    $orderResponse = $gateway->order->createOrder($orderData);
    echo "Order Response: " . $orderResponse . "\n";

    // Check order status
    $orderId = 'order-id';
    $statusResponse = $gateway->order->checkStatus($orderId);
    echo "Order Status: " . $statusResponse . "\n";
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
