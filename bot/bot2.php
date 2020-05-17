<?php
include('vendor/autoload.php');
include('menu.php');
include('settings.php');
include('function.php');
include('bot_lib.php');

use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;

global $phone, $date, $instagram, $usluga;

$telegram = new Api($api);
$result = $telegram->getWebhookUpdates();
$answer = $result->answerCallbackQuery();
$result = json_decode($result, True);

$text = $result["message"]["text"];
$chat_id = $result["message"]["chat"]["id"];
$name = $result["message"]["from"]["username"];
$first_name = $result["message"]["from"]["first_name"];
$contact = $result["message"]["contact"]["phone_number"];
$last_name = $result["message"]["from"]["last_name"];


$callback = $result['callback_query'];
$callback_data = $result['callback_query']['data'];
$callback_id = $result['callback_query']['message']['chat']['id'];
$callback_message_id = $result['callback_query']['message']['message_id'];


$update = json_decode(file_get_contents('php://input'));
$data = $update->callback_query->data;
$ccid = $update->callback_query->message->chat->id;


$get_all = get_all($connect);
$get_user = get_user($connect, $chat_id);
$old_id = $get_user['chat_id'];
$username = $first_name . ' ' . $last_name;
$text = mb_strtolower($text);

$debug = json_encode($result, JSON_PRETTY_PRINT);

//api.telegram.org/bot993443177:AAFxrxwGUIitLrUI3tzvc-1uKHeMa8WWFfI/setWebHook?url=https://dimarionss.pp.ua/bot/bot.php
if ($text) {
    global $phone, $date, $instagram, $usluga;
    if ($text == "/start") {
        $reply = "Привет" . " " . "\xE2\x9C\x8B <b>" . $first_name . " " . $last_name . "</b> \xE2\x9C\x8B" . "\n" . "Выберите тип услуги \xE2\xA4\xB5";
        $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $menu, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
        $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);

    } elseif ($text == "\xE2\xAD\x90 запись на курсы \xE2\xAD\x90") {
        $reply = "Выберите курс \xE2\xA4\xB5";
        $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $kourse, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
        $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
    } elseif ($text == "свадебная прическа" or $text == "выпускная прическа" or $text == "вечерняя прическа" or $text == "плетение" or $text == "афрокудри" or $text == "стрижки" or $text == "полировка") {
        $reply = "<b>Напишите свой номер телефона для связи</b>";
        $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $menuback, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
        $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
        $usluga = $text;
    } else {
        if ($text == "базовый экспресс-курс по причёскам") {
            $reply = "<b>Напишите свой номер телефона для связи</b>";
            $reply2 = "<b>Программа курса</b>";
            $img = 'images/kurs_3.jpg';
            $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $menuback, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
            $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $img, 'caption' => $reply2, 'parse_mode' => 'HTML']);
            $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
            $usluga = $text;
        } elseif ($text == "свадебные прически") {
            $reply = "<b>Напишите свой номер телефона для связи</b>";
            $reply2 = "<b>Программа курса</b>";
            $img = 'images/kurs_1.jpg';
            $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $menuback, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
            $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $img, 'caption' => $reply2, 'parse_mode' => 'HTML']);
            $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
            $usluga = $text;
        } elseif ($text == "прически для себя") {
            $reply = "<b>Напишите свой номер телефона для связи</b>";
            $reply2 = "<b>Программа курса</b>";
            $img = 'images/kurs_2.jpg';
            $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $menuback, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
            $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $img, 'caption' => $reply2, 'parse_mode' => 'HTML']);
            $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
            $usluga = $text;
        } else {
            if ($text == "\xF0\x9F\x94\x99 вернуться назад") {
                $reply = "\xE2\x9C\x8B <b>" . $first_name . " " . $last_name . "</b>\xE2\x9C\x8B" . " " . "Выберите тип услуги \xE2\xA4\xB5";
                $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $menu, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
                $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);


            }
            if (is_numeric($text)) {
                $phone = $text;
                $reply = "<i>Напишите свой ник в Instagram</i>";
                $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $menuback, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
                $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
//            $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => $chat_id, 'text' => "Подтвердите запись"]);

            }

        }$instagram = $text;


    }
} else {
    $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => $chat_id, 'text' => "Отправьте текстовое сообщение."]);
}

if ($text == "\xF0\x9F\x91\x8C подтвердить запись") {

    $reply = "<b>" . $first_name . " " . $last_name . "</b>" . " " . "Спасибо! Ваша заявка на запись успешно отправлена \xF0\x9F\x91\x8D" . "\n" . "Ожидайте с Вами свяжутся в ближайшее время";
    $reply_markup = [ 'inline_keyboard' => $inline2];
    $inline_keyboard = json_encode($reply_markup);

    $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $inline_keyboard]);
    $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => 579137769, 'text' => "<b>Ник в Telegram: </b>" . $get_all['name'] . "\n" . "<b>ФИО: </b>" . $get_all['username'] . "\n" ."<b>Тип услуги: </b>" . $get_all['usluga'] . "\n" ."<b>Номер телефона: </b>". $get_all['phone'] . "\n" ."<b>Instagram Ник: </b>". $get_all['instagram']]);
}
textlog2($connect, $username, $chat_id, $name, $phone, $usluga, $instagram, $old_id);
add_user($connect, $username, $chat_id, $name, $old_id);

//        $phone = $text;
//        textlog2($connect, $username, $chat_id, $name, $text, $phone);
//        textlog($connect, $username, $chat_id, $name, $text);

//function send_answerCallbackQuery($api, $callback_query_id, $text, $show_alert){
//    file_get_contents("https://api.telegram.org/bot".$api."/answerCallbackQuery?callback_query_id=".$callback_query_id."&text=".$text."&show_alert=".$show_alert);
//}
//
//if (isset($data['callback_query'])) {
//    $api = '993443177:AAFxrxwGUIitLrUI3tzvc-1uKHeMa8WWFfI';
//    send_answerCallbackQuery($api, $data['callback_query']['id'], "проверка ", false);
//}

?>

