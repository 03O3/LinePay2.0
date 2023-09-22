<?php

class LinePayRequest {
    private $merchantId;
    private $publicKey;
    private $apiUrl;

    public function __construct($merchantId, $publicKey, $apiUrl) {
        $this->merchantId = $merchantId;
        $this->publicKey = $publicKey;
        $this->apiUrl = $apiUrl;
    }

    public function sendPaymentRequest($amount, $phone, $email, $currency, $method) {
        $order_id = rand(1000, 20000);
        $data = [
            "order_id" => $order_id,
            "merchant_id" => $this->merchantId,
            "public_key" => $this->publicKey,
            "amount" => $amount,
            "phone" => $phone,
            "email" => $email,
            "currency" => $currency,
            "method" => $method
        ];

        $curl = curl_init($this->apiUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type: application/x-www-form-urlencoded"]);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        $resp = curl_exec($curl);
        $error = curl_error($curl);

        if ($error) {
            return "cURL Error: " . $error;
        } else {
            $responseData = json_decode($resp, true);

            if (isset($responseData["success"]) && $responseData["success"] === true && isset($responseData["link"])) {
                return "Payment link: <a href='" . $responseData["link"] . "' target='_blank'>Click here to pay</a>";
            } else {
                $errorMessage = isset($responseData["error"]) ? "Error: " . $responseData["error"] : "Payment request failed.";
                return $errorMessage;
            }
        }

        curl_close($curl);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $merchantId = 1;
    $publicKey = "Bozar";
    $apiUrl = "https://linepay.fun/api/v2/create";

    $linePayRequest = new LinePayRequest($merchantId, $publicKey, $apiUrl);

    $amount = $_POST["amount"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $currency = $_POST["currency"];
    $method = $_POST["method"];

    echo $linePayRequest->sendPaymentRequest($amount, $phone, $email, $currency, $method);
} else {
    echo "Invalid request.";
}
?>
