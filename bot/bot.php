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


//$update = json_decode(file_get_contents('php://input'), JSON_OBJECT_AS_ARRAY);
//$data = $update->callback_query->data;
//$ccid = $update->callback_query->message->chat->id;


$get_all = get_all($connect, $chat_id);
$get_user = get_user($connect, $chat_id);
$old_id = $get_user['chat_id'];
$username = $first_name . ' ' . $last_name;
$text = mb_strtolower($text);

$debug = json_encode($result, JSON_PRETTY_PRINT);


//api.telegram.org/bot993443177:AAFxrxwGUIitLrUI3tzvc-1uKHeMa8WWFfI/setWebHook?url=https://dimarionss.pp.ua/bot/bot.php
if ($text) {
    global $phone, $date, $instagram, $usluga, $usluga_param;
    switch ($text) {
        case "/start":
            $reply = "Привет" . " " . "\xE2\x9C\x8B <b>" . $first_name . " " . $last_name . "</b> \xE2\x9C\x8B" . "\n" . "Выберите тип услуги \xE2\xA4\xB5";
            $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $menu, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
            $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
            break;
        case "\xE2\xAD\x90 запись на курсы \xE2\xAD\x90":
            $reply = "Выберите курс \xE2\xA4\xB5";
            $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $kourse, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
            $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
            break;
        case "свадебная прическа";
        case "выпускная прическа";
        case "вечерняя прическа";
        case "плетение";
        case "афрокудри";
            param_accept2();
            break;
        case "стрижки";
        case "полировка";
            param_accept();



        break;
    }

    switch ($text) {
        case "базовый экспресс-курс по причёскам":
            $reply2 = "<b>Программа курса</b>";
            $img = 'images/kurs_3.jpg';
            $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $img, 'caption' => $reply2, 'parse_mode' => 'HTML']);
            date_accept_zapis();
            update('usluga', $text);

            break;
        case "свадебные прически" :
            $reply2 = "<b>Программа курса</b>";
            $img = 'images/kurs_1.jpg';
            $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $img, 'caption' => $reply2, 'parse_mode' => 'HTML']);
            date_accept_zapis();
            update('usluga', $text);


            break;
        case "прически для себя":
            $reply2 = "<b>Программа курса</b>";
            $img = 'images/kurs_2.jpg';
            $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $img, 'caption' => $reply2, 'parse_mode' => 'HTML']);
            date_accept_zapis();
            update('usluga', $text);



            break;
    }

    switch ($text) {
        case stristr($text, 'первой') !== FALSE;
            $usluga_param = $text;
            update('dop_param', $usluga_param);
            date_accept_zapis();
            break;
        case stristr($text, 'второй') !== FALSE;
            $usluga_param = $text;
            update('dop_param', $usluga_param);
            date_accept_zapis();
            break;
        case stristr($text, 'готовой') !== FALSE;
            $usluga_param = $text;
            update('dop_param', $usluga_param);
            date_accept_zapis();
            break;
        case stristr($text, '.') !== FALSE;
            $date = $text;
            update('date_zapis', $date);
            mobile_accept();
            break;
    }
    switch ($text) {
        case "\xF0\x9F\x94\x99 вернуться назад":
            $reply = "\xE2\x9C\x8B <b>" . $first_name . " " . $last_name . "</b>\xE2\x9C\x8B" . " " . "Выберите тип услуги \xE2\xA4\xB5";
            $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $menu, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
            $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
            break;
        case "\xF0\x9F\x91\x8C подтвердить запись":
            $reply = "<b>" . $first_name . " " . $last_name . "</b>" . " " . "Спасибо! Ваша заявка на запись успешно отправлена \xF0\x9F\x91\x8D" . "\n" . "Ожидайте с Вами свяжутся в ближайшее время";
            $reply_markup = ['inline_keyboard' => $inline2, 'one_time_keyboard' => false];
            $inline_keyboard = json_encode($reply_markup);

            $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $inline_keyboard]);
            $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => 579137769, 'text' => "<i>НОВАЯ ЗАПИСЬ</i>" . "\n" ."<b>Ник в Telegram: </b>" . $name . "\n" . "<b>ФИО: </b>" . $username . "\n" . "<b>Тип услуги: </b>" . $get_all['usluga'] . "\n" . "<b>Номер телефона: </b>" . $get_all['phone'] . "\n" . "<b>Instagram Ник: </b>" . $get_all['instagram'] . "\n" . "<b>Желаемая дата записи: </b>" . $get_all['date_zapis']. "\n" . "<b>Дополнительные параметры: </b>" . $get_all['dop_param']]);

            break;



    }
switch ($text){
        case is_numeric($text);
            $phone = $text;
            update('phone', $phone);

            $reply = "<i>Напишите свой ник в Instagram</i>" ."\n" . "<b>НИК ДОЛЖЕН НАЧИНАТЬСЯ С "."@</b>";
            $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $menuback, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
            $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
            break;
        case stristr($text, '@') !== FALSE;
            $instagram = $text;
            update('instagram', $instagram);

            $reply = "Нажмите <b>'\xF0\x9F\x91\x8C	 Подтвердить запись \xE2\xAC\x87'</b>";
            $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $accept, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
            $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
            break;

}
} else {
    $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => $chat_id, 'text' => "Отправьте текстовое сообщение."]);
}

//vardump_to_file($instagram_for_bd);
//textlog2($connect, $username, $chat_id, $name, $phone, $usluga, $instagram_for_bd, $old_id);
add_user($connect, $username, $chat_id, $name, $old_id);


?>

