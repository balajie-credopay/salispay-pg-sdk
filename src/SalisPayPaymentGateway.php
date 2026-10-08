<?php
 
namespace SalisPay;
 
use SalisPay\Resources\OrderAPI;
 
class SalisPayPaymentGateway
{
    private $clientId;
    private $clientSecret;
 
    public $order;
 
    public function __construct($clientId, $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
 
        // Initialize Order API
        $this->order = new OrderAPI($this);
    }
 
    private function getBasicAuthHeader()
    {
        $credentials = base64_encode(
            "{$this->clientId}:{$this->clientSecret}"
        );
 
        return "Basic {$credentials}";
    }
 
    public function handleRequest($method, $url, $jsonInputString = null)
    {
        if (strpos($url, 'https://') !== 0) {
            throw new \Exception('Only HTTPS protocol is supported');
        }
 
        $ch = curl_init($url);
 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
 
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: ' . $this->getBasicAuthHeader(),
            'System-Name: ' . php_uname('s'),
            'Node-Name: ' . gethostname(),
            'Release: ' . php_uname('r'),
            'Version: ' . phpversion(),
            'Machine: ' . php_uname('m'),
            'Processor: ' . php_uname('p'),
            'Hostname: ' . gethostname(),
            'IP-Address: ' . gethostbyname(gethostname())
        ]);
 
        if ($jsonInputString) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonInputString);
        }
 
        $response = curl_exec($ch);
 
        if (curl_errno($ch)) {
            throw new \Exception('Curl error: ' . curl_error($ch));
        }
 
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
 
        curl_close($ch);
 
        if ($httpCode >= 400) {
            throw new \Exception(
                "Server returned HTTP response code: {$httpCode}",
                $httpCode
            );
        }
 
        return $response;
    }
}
?>