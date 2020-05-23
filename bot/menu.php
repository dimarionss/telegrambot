<?php

$menu_main = [["\xE2\xAD\x90 Курсы" , "\xF0\x9F\x92\x87 Услуги"],
    ["\xF0\x9F\x92\xB2 Прайс", "\xF0\x9F\x99\x8B Обо мне"]];
$menu = [["СВАДЕБНАЯ ПРИЧЕСКА", "ВЫПУСКНАЯ ПРИЧЕСКА"],
         ["ВЕЧЕРНЯЯ ПРИЧЕСКА", "ПЛЕТЕНИЕ"],
         ["АФРОКУДРИ", "СТРИЖКИ"],
         ["ПОЛИРОВКА"]];
$keyboard_remove = [
    'remove_keyboard' => true
];
$menuback = [["\xF0\x9F\x94\x99 Вернуться назад"]];
$accept = [["\xF0\x9F\x91\x8C Подтвердить запись"]];
$contact_buttom = [["text" => "Отправить номер телефона", "request_contact" => true]];
//$inline[] = ["text" => "\xF0\x9F\x91\x8C Подтвердить запись", "callback_data" => "accept"];
$inline2 = [
    [["text" => "\xF0\x9F\x8C\x8F Посетите мой Сайт", "url" => "roihairstylist.top"]],
    [["text" => "\xF0\x9F\x93\xB2 Instagram профиль", "url" => "roihairstylist.top"]],
    [["text" => "\xF0\x9F\x8E\xA5 YouTube канал", "url" => "https://www.youtube.com/channel/UCGqUb8O0t_lg3x_0gE22TEg"]],
    [["text" => "\xE2\x9C\x89 Телеграм канал", "url" => "https://t.me/tanya_roi_hairstylist"]]
];
//$inline_back[] = ['text'=>"\xF0\x9F\x94\x99 Вернуться назад", 'callback_data'=>'back'];
$inline[] = ['text'=>'Полировка', 'callback_data'=>'polish'];
$inline[] = ['text'=>'Стрижки', 'callback_data'=>'cut'];
$inline[] = ['text'=>'Афрокудри', 'callback_data'=>'afro'];
$inline[] = ['text'=>'Плетение', 'callback_data'=>'braid'];
$inline[] = ['text'=>'Вечерняя прическа', 'callback_data'=>'evening'];
$inline[] = ['text'=>'Свадебная прическа', 'callback_data'=>'marrige'];
$inline[] = ['text'=>'Выпускная прическа', 'callback_data'=>'senior'];

$kourse = [["Базовый экспресс-курс по причёскам"],
           ["Свадебные прически"],
           ["Прически для себя"]];
$menuback2 = [["\xE2\x9D\x97 В первой половине дня \xE2\x9D\x97"],
    ["\xE2\x9D\x93 Во второй половине дня \xE2\x9D\x93"],
    ["\xF0\x9F\x94\x99 Вернуться назад"]];
//https://www.instagram.com/tanya_roi_hairstylist/?hl=ru
?>