<?php 
include 'keys.php';
        $ch = curl_init('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Basic ' . base64_encode($consumerKey . ':' . $consumerSecret)
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);

        $result = json_decode($response);
        $access_token = $result->access_token;
        curl_close($ch);
?>