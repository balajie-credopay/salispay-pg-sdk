<?php
 
require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/src/Config.php';

require_once __DIR__ . '/src/SalisPayPaymentGateway.php';

require_once __DIR__ . '/src/resources/OrderAPI.php';

require_once __DIR__ . '/src/resources/TransactionAPI.php';
 
use SalisPay\SalisPayPaymentGateway;
 
// Initialize SalisPay Gateway

$gateway = new SalisPayPaymentGateway(

    '69dc88dbab8dedf4b861bbcc',

    'Vs6NIyWCtGGsJcivxXs4OmlvZ'

);
 
// Create an order

$orderData = [

    'receiptId' => 'test',

    'amount' => 1,

    'currency' => 'OMR',

    'description' => 'testt',

    'customerFields' => [

        'name' => 'kishore',

        'email' => 'kishore.s@credopay.com',

        'phone' => '98776563'

    ],

    'uiMode' => 'checkout'

];
 
try {
 
    // Create Order

    $orderResponse = $gateway->order->createOrder($orderData);
 
    echo "Order Response:<br>";

    echo htmlspecialchars($orderResponse) . "<br><br>";
 
    // Decode response

    $orderResponseData = json_decode($orderResponse, true);
 
    if (json_last_error() !== JSON_ERROR_NONE) {

        throw new Exception(

            'Invalid JSON response: ' . json_last_error_msg()

        );

    }
 
    // Get order ID

    $orderId = $orderResponseData['orderId'] ?? null;
 
    if (!$orderId) {

        echo "Order ID not found in response.";

        exit;

    }
 
    echo "Order ID: " . htmlspecialchars($orderId) . "<br><br>";
 
    // Check Order Status

    $statusResponse = $gateway->order->checkStatus($orderId);
 
    echo "Order Status:<br>";

    echo htmlspecialchars($statusResponse);
 
} catch (Exception $e) {
 
    echo "Error: " . htmlspecialchars($e->getMessage());
 
}

?>
 