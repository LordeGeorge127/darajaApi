<?php
header("Content-type: application");

$stkCallbackResponse = file_get_contents('php://input');
$logFile = "MpesaResonse.json";
$log = fopen($logFile,"a");
fwrite($log, $stkCallbackResponse);
fclose($log);

$data = json_decode($stkCallbackResponse);

$MerchantRequestID = $data->Body->stkCallback->MerchantRequestID;
$CheckoutRequestID = $data->Body->stkCallback->CheckoutRequestID;
$ResultCode = $data->Body->stkCallback->ResultCode;
$ResultDesc = $data->Body->stkCallback->ResultDesc;
$Amount =$data->Body->stkCallback->CallbackMetadata->item[0]->Amount;
$TransactionId =$data->Body->stkCallback->CallbackMetadata->item[1]->MpesaReceiptNumber;
$TransactionDate =$data->Body->stkCallback->CallbackMetadata->item[2]->TransactionDate;
$PhoneNumber =$data->Body->stkCallback->CallbackMetadata->item[3]->PhoneNumber;

