<?php

$request = curl_init();
$url = "https://api.sendgrid.com/v3/suppression/bounces/kento-yoshida@kke.co.jp";

$header = [
    'Authorization: Bearer '.$_ENV["SENDGRID_API_KEY"],
    'Content-Type: application/json'
];

curl_setopt($request, CURLOPT_HTTPHEADER, $header);
curl_setopt($request, CURLOPT_URL, $url);
curl_setopt($request, CURLOPT_CUSTOMREQUEST, "GET");
$result	= curl_exec($request);
$http_status = curl_getinfo($request, CURLINFO_HTTP_CODE);

if (false === $result) {
    $errno = curl_errno($request);
    $error = curl_error($request);
    throw new RuntimeException($error, $errno);
};
if ($http_status < 200 || $http_status >= 300) {
    throw new Exception($result);
}

$body	= json_decode($result);
echo $result;
