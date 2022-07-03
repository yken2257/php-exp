<?php

$request = curl_init();
$url = "https://api.sendgrid.com/v3/suppression/bounces/test@example.com";

$header = [
    'Authorization: Bearer '.getenv("SENDGRID_API_KEY"),
    'Content-Type: application/json'
];

curl_setopt($request, CURLOPT_HTTPHEADER, $header);
curl_setopt($request, CURLOPT_URL, $url);
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($request, CURLOPT_CUSTOMREQUEST, "GET");

try {
    $result	= curl_exec($request);
    $http_status = curl_getinfo($request, CURLINFO_HTTP_CODE);

    if (false === $result) {
        $errno = curl_errno($request); // https://curl.se/libcurl/c/libcurl-errors.html
        $error = curl_error($request);
        throw new RuntimeException($message = $error, $code = $errno);
    };
    if ($http_status < 200 || $http_status >= 300) {
        throw new RuntimeException($message = $result, $code = $http_status);
    };
    //$body	= json_decode($result);
    echo $http_status, "\n";
    echo $result, "\n";
} catch (RuntimeException $ex) {
    echo $ex->getCode(), "\n";
    throw $ex;
} finally {
    curl_close($request);
}