<?php
namespace SalisPay\Resources;

use SalisPay\SalisPayPaymentGateway;

class TransactionAPI {
    private $gateway;

    public function __construct(SalisPayPaymentGateway $gateway) {
        $this->gateway = $gateway;
    }

    // Define transaction-related methods here
}
?>
