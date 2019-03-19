<?php
$access_token = 'GiNpQREh2fTTtwyJ8MX0QFqqRCpzSGJo5AwK1Fr5XiTI0WZ7LytpX6lZIem0DwRPNExfe2mQ7AVzQ0Li4WoptkKMNrIdRFE37qYVqBPyrOk6PBd3yjl1DnJV5P8JOVxZ7jPrBJVSEYM8rfqTh0h7GQdB04t89/1O/w1cDnyilFU=';


$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
