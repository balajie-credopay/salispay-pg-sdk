# SalisPay Payment Gateway

SalisPay Payment Gateway is a PHP library that provides an easy-to-use interface for interacting with the SalisPay payment gateway API. This library allows you to create checkout orders and check order statuses securely and efficiently.

## Installation

You can install the package via Composer. Run the following command:

```bash

composer require salisPay/paymentgateway

```

## Sample Integration Setup

After installing the package using Composer, create a PHP file named UsageExample.php in your project root directory.

Your project structure should look like this:

```graphql

your-project/
├── vendor/
│   ├── autoload.php
│   └── salisPay/
│       └── paymentgateway/
├── composer.json
├── composer.lock
└── UsageExample.php

Include the Composer autoloader and required SDK classes:

```php

require_once __DIR__ . '/vendor/autoload.php';

use SalisPay\SalisPayPaymentGateway;
use SalisPay\Resources\OrderAPI;
```
You can now use the SDK to initialize the payment gateway, create orders, and check order statuses.

To execute your integration example, run:

php UsageExample.php

```


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
use SalisPay\Resources\OrderAPI;

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
     echo '<h3>Order Response</h3>';
    echo '<pre>';
    print_r($orderResponse);
    echo '</pre>';

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

```

## Checking Order Status

```php

try {
    $orderId = 'your-order-id'; // Replace with an actual order ID
    $statusResponse = $orderAPI->checkStatus($orderId);
 echo '<h3>Order Status</h3>';
    echo '<pre>';
    print_r($statusResponse);
    echo '</pre>';
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



