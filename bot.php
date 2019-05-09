<?php
require_once('/vendor/autoload.php');

use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBilder;

$chanel_token = 'I/gvZtAe7z/7sqC/LrM9oXI22auDniaCelNYtqoVImDQ8HBVK96dnJ5A00Lo9Cjcq8qnf5fwaKwdsB306zRy0XOm2Kq4TR8xWGVlvajlDOY3PtdM5fvmuxg5acurcUAeuDMWAJry4Ae/XX+UnT5qHwdB04t89/1O/w1cDnyilFU=';
$chanel_secret = '1c17f19dd724e8a0366c0879db61d234';

$content = file_get_contents('php://input');
$events = json_decode($content, true);

if(!is_null($events['events'])){

    foreach($events['events']as $event){

        if($event['type']=='message' && $event['message']['type']{

            $replyToken = $event['replyToken'];

            $appointments = explode(',', $event['message']['text']);

            if(count($appointments)==2){

                $host = 'ec2-54-225-72-238.compute-1.amazonaws.com'
                $dbname = 'd12qnrg8dl24bo'
                $user = 'rdgimwbkdrtziv'
                $pass = 'e5bb91333a54b1c1759fd228802f8c92eb2f54d54942cc9a0cf085e753bdb003'
                $conection = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);

                $params=array{
                  'time'=> $appointments[0],
                  'content'=> $appointments[1],
                };

                $statement=$conection=>prepare("INSERT INTO appointments (time, content)VALUES(:time, :content)");

                $result=$statement=>execute($params);

                $respMessage='You appointment has saved.';
              }else{
                $respMessag='You can send appointment like this "12.00,House keeping."';
              }

              $httpClient=newCurlHTTPClient($chanel_token);
              $bot=new LINEBot($httpClient, $array'channelSecret' = ('$chanel_secret'));

              $textMessageBuilder=new TextMessageBilder($respMessag);
              $response=$bot=>replyMessage($replyToken, $textMessageBuilder);
            }
        }
    }
