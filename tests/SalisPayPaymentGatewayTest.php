<?php
use PHPUnit\Framework\TestCase;
use SalisPay\SalisPayPaymentGateway;

class SalisPayPaymentGatewayTest extends TestCase {
    public function testHandleRequest() {
        $gateway = new SalisPayPaymentGateway('65a621098498347eeecfe0a0', 'g2dSScWNGQwd4DMWjy8rOFptP');
        $this->expectException(Exception::class);
        $gateway->handleRequest('GET', 'http://example.com');
    }
}
?>
