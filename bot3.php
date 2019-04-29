<?php

// กรณีต้องการตรวจสอบการแจ้ง error ให้เปิด 3 บรรทัดล่างนี้ให้ทำงาน กรณีไม่ ให้ comment ปิดไป
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// include composer autoload
require_once 'vendor/autoload.php';

// การตั้งเกี่ยวกับ bot
require_once 'bot_settings.php';
//require_once 'connect.php';

// กรณีมีการเชื่อมต่อกับฐานข้อมูล
//require_once("dbconnect.php");

///////////// ส่วนของการเรียกใช้งาน class ผ่าน namespace
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
//use LINE\LINEBot\Event;
//use LINE\LINEBot\Event\BaseEvent;
//use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\MessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
use LINE\LINEBot\MessageBuilder\AudioMessageBuilder;
use LINE\LINEBot\MessageBuilder\VideoMessageBuilder;
use LINE\LINEBot\ImagemapActionBuilder;
use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder ;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapUriActionBuilder;
use LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder;
use LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\DatetimePickerTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;

// เชื่อมต่อกับ LINE Messaging API
$httpClient = new CurlHTTPClient('f3crseBLoP50ERU316xHsKzi3u/SemH9Xb4ShsVvVLnH2KSwYt5k9FIubzQqlDzMwy1kRdr4i8EzpEr5PPcsiP5tXBwlq/KXLgSGxSMod4WJSCAvaBPmunnTY/ge/Ujx9A03PDeVOtHo0PH5IalPYwdB04t89/1O/w1cDnyilFU=');
$bot = new LINEBot($httpClient, array('channelSecret' => '215c0a80f3166e6f48d0d39f67c61f74'));
// $httpClient = new CurlHTTPClient('OyWNyWj1Ezla0ayB/wFveFv1/OQad3ey8KauJtATk/aP4IMHI+wJX3ZHYIc70dVhmIabJ6QNBwhuRbGlhsqSHB3sD7ldz2WbfB9S8wsN4QuciDXwVJps8hBJdsEWQLCNFGQyMRv/xlsQCxEJC5G0gQdB04t89/1O/w1cDnyilFU=');
// $bot = new LINEBot($httpClient, array('channelSecret' => 'a090253c98ed2294e3f303838f8d70be'));


// คำสั่งรอรับการส่งค่ามาของ LINE Messaging API
$content = file_get_contents('php://input');

// แปลงข้อความรูปแบบ JSON  ให้อยู่ในโครงสร้างตัวแปร array
$replyToken = "";
$events = json_decode($content, true);
if(!is_null($events)){
    // ถ้ามีค่า สร้างตัวแปรเก็บ replyToken ไว้ใช้งาน
    $replyToken = $events['events'][0]['replyToken'];
    $txt_user_reply =  $events['events'][0]['message'];
    $user =  $events['events'][0]['source'];
}

$txt_hello = "KUSE Notification via Line \nยินดีต้อนรับสู่ช่องทางการรับข่าวสารของคณะวิทยาศาสตร์และวิศวกรรมศาสตร์ มก.ฉกส. ผ่านแอพพลิเคชั่นไลน์ \n>> พิมพ์ 1 เพื่อสมัครเป็นสมาชิก <<";
$txt_registered = "สมัครเป็นสมาชิกเรียบร้อย \nพิมพ์ 1.1 เพื่อรับข่าว -> ข่าวประชาสัมพันธ์\nพิมพ์ 1.2 เพื่อรับข่าว -> ข่าวการศึกษา/กิจการนิสิต\nพิมพ์ 1.3 เพื่อรับข่าว -> ข่าวงานวิจัยและบริการวิชาการ\nพิมพ์ 1.4 เพื่อรับข่าว -> ประกาศ";
$txt_user_duplicate = "คุณสมัครแล้ว";
?>