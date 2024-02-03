<?php
include 'keys.php';
include 'accessToken.php';

// Ensure $access_token is retrieved successfully
if (!$access_token) {
    echo "Error: Access token not available.";
    exit;
}

$processRequestUrl = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$callbackUrl = 'https://af90-197-232-104-39.ngrok-free.app/daraja/callback.php';
$passKey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$businessShortCode = '174379';
$timestamp = date('YmdHis');

$password = base64_encode($businessShortCode . $passKey . $timestamp);

// M-Pesa specific parameters
$phone = '254727449872';
$money = '1';
$partyA = $phone;
$partyB = '174379';
$accountReference = 'YII2Shop';
$transactionDesc = 'STK PUSH TEST';
$amount = $money;

// Set headers including the access token
$stkPushHeader = [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $access_token
];

$curl = curl_init();

// Set cURL options
curl_setopt($curl, CURLOPT_URL, $processRequestUrl);
curl_setopt($curl, CURLOPT_HTTPHEADER, $stkPushHeader);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);

// Set POST data
$curlPostData = [
    "BusinessShortCode" => $businessShortCode,
    "Password" => $password,
    "Timestamp" => $timestamp,
    "TransactionType" => 'CustomerPayBillOnline',
    "Amount" => $amount,
    "PartyA" => $partyA,
    "PartyB" => $businessShortCode,
    "PhoneNumber" => $partyA,
    "CallBackURL" => $callbackUrl,
    "AccountReference" => $accountReference,
    "TransactionDesc" => $transactionDesc,
];

$data_string = json_encode($curlPostData);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

// Execute cURL request
$curl_response = curl_exec($curl);

// Check for errors
if ($curl_response === false) {
    echo "Curl error: " . curl_error($curl);
} else {
    // Output response
    echo $curl_response;
}

// Close cURL resource
curl_close($curl);
?>
