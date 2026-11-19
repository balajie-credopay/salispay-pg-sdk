# SalisPay Payment Gateway

SalisPay Payment Gateway is a PHP library that provides an easy-to-use interface for interacting with the SalisPay payment gateway API. This library allows you to create checkout orders and check order statuses securely and efficiently.

## Installation

You can install the package via Composer. Run the following command:

```bash

composer require salisPay/paymentgateway

```v

## Features

* **Order Management**: Create and manage orders through SalisPay.
* **Transaction Management**: Transaction API support is planned for future enhancements.
* **Secure Authentication**: Uses secure basic authentication for API requests.
* **System Information**: Attaches system and server information to each request for better tracking and security.

## Requirements

&#x20;   - PHP 7.4 or higher
- Composer
- cURL extension enabled
- SalisPay API credentials (Client ID and Client Secret)



## Usage

## Initialization

```php
require_once __DIR__ . '/vendor/autoload.php';

use SalisPay\SalisPayPaymentGateway;

// Initialize the payment gateway
$clientId = 'your-client-id';
$clientSecret = 'your-client-secret';
$gateway = new SalisPayPaymentGateway($clientId, $clientSecret);

// Initialize the OrderAPI
$orderAPI = $gateway->order;

```

## Creating an Order

```php

$orderData = [
    'receiptId' => 'RE_YOURRECEIPT123',
    'amount' => 1,
    'currency' => 'OMR',
    'description' => 'Test Payment',
    'customerFields' => [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '90000000'
    ],
    'uiMode' => 'checkout',
    'redirectType' => 'redirect'
];

try {
    $orderResponse = $orderAPI->createOrder($orderData);
    echo "Order Response: " . $orderResponse;

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

```

## Checking Order Status

```php

try {
    $orderId = 'your-order-id'; // Replace with an actual order ID
    $statusResponse = $orderAPI->checkStatus($orderId);
    echo "Order Status: " . $statusResponse;
} catch (Exception $e) {
     echo "Error: " . $e->getMessage();
}

```
## API Endpoints

&#x20;   - Create Order: POST https://bnapi.salispay.om/nac/api/v1/pg/orders/create-checkout

&#x20;   - Check Order Status: GET https://bnapi.salispay.om/nac/api/v1/pg/orders/check-status


## Project Structure

```graphql

src/
├── Config.php            # Contains API endpoints and configurations
├── SalisPayPaymentGateway.php  # Handles HTTP requests
└── resources/
    ├── OrderAPI.php      # Methods for order operations
    └── TransactionAPI.php # Placeholder for future enhancements
```

## Contributing

Contributions are welcome! Feel free to submit issues or pull requests to enhance the library.



