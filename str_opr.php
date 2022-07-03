<?php

echo $_ENV["SENDGRID_API_KEY"];
echo getenv("SENDGRID_API_KEY");

$http_status = "404\n";
$notify_info = array
(
    'a'=>'SendGrid WebAPI call failed.',
    'b'=>'HTTP status: '.$http_status,
    'c'=>'Request: ',
    'd'=>'Result: ',
);

$header = [
    'Authorization: Bearer ',
    'Content-Type: application/json',
];
$add_header = ['Prefer: code=400'];
$header = array_merge($header, $add_header);
print_r($header);
//print join("\n", $header);

$response_code = 403;
$add_header = ["Prefer: code=${response_code}, dynamic=true"];
print_r($add_header);

$json = <<<EOS
{
"type": "Blog",
"profile": {
"name": "My Blog","date": "2021-04-01"
}
}
EOS;

echo gettype($json), "\n";
$arr = json_decode($json);
echo gettype($arr), "\n";

echo $arr["type"];