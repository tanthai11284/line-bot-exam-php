<?php



require "vendor/autoload.php";

$access_token = 'GiNpQREh2fTTtwyJ8MX0QFqqRCpzSGJo5AwK1Fr5XiTI0WZ7LytpX6lZIem0DwRPNExfe2mQ7AVzQ0Li4WoptkKMNrIdRFE37qYVqBPyrOk6PBd3yjl1DnJV5P8JOVxZ7jPrBJVSEYM8rfqTh0h7GQdB04t89/1O/w1cDnyilFU=';

$channelSecret = 'e7018194bdde193343fd8689c8b2a53c';

$pushID = 'U2c43a1912cf3227c66089cdee107e5b7';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
if($message == "สวัสดี"){
      $arrayPostData['to'] = $id;
      $arrayPostData['messages'][0]['type'] = "text";
      $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";
      $arrayPostData['messages'][1]['type'] = "sticker";
      $arrayPostData['messages'][1]['packageId'] = "2";
      $arrayPostData['messages'][1]['stickerId'] = "34";
      pushMsg($arrayHeader,$arrayPostData);
}









