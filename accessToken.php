<?php 
$consumerKey = "tFcGIzUsPd1nDCRTRhnCQO1OAUrzxt7Z";
$consumerSecret = "GuoIfKyZAnlB38ou";
$access_token_url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
$headers = ['Content-Type:application/json; charset=utf8'];
$curl = curl_init($access_token_url);

curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_HEADER, FALSE);
curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);

$result = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

if ($status === 200) {
    $response = json_decode($result);
    if ($response && isset($response->access_token)) {
        $access_token = $response->access_token;
        // Return the access token
        return $access_token;
    } else {
        echo "Error: Invalid response format";
    }
} else {
    echo "Error: Failed to obtain access token (HTTP Status: $status)";
}
?>
