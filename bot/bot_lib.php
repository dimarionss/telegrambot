<?php
/********************************************************
 *  Function library
 *
 *  https://coderlog.top
 *  https://youtube.com/CoderLog
 ********************************************************/




/*
 Function for add users to database
*/
function add_user($connect, $username, $chat_id, $name, $old_id){


    $username = trim($username);
    $chat_id = trim($chat_id);
    $name = trim($name);

    if($chat_id == $old_id)
        return false;
    $t = "INSERT INTO users (username, chat_id, name) VALUES ('%s', '%s', '%s')";
    $query = sprintf($t, mysqli_real_escape_string($connect, $username),
        mysqli_real_escape_string($connect, $chat_id),
        mysqli_real_escape_string($connect, $name));
    $result = mysqli_query($connect, $query);
    if(!$result)
        die(mysqli_error($connect));
    return true;
}

/*
 Function for get users from database
*/

function get_user($connect, $chat_id){
    $query = sprintf("SELECT * FROM users WHERE chat_id=%d", (int)$chat_id);
    $result = mysqli_query($connect, $query);
    if(!$result)
        die(mysqli_error($connect));
    $get_user = mysqli_fetch_assoc($result);
    return $get_user;

}
//получаю все данные в виде массива
function get_all($connect, $chat_id){
    $query = "SELECT * FROM textlog WHERE chat_id = $chat_id ";
    $result = mysqli_query($connect, $query);
    if(!$result)
        die(mysqli_error($connect));
    $get_all = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $get_all;



}
//выборка количества всего
function get_count($connect){
    $query = "SELECT COUNT(*) FROM users";
    $result = mysqli_query($connect, $query);
    if(!$result)
        die(mysqli_error($connect));
    $get_count = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $get_count;



}

function textlog2($connect, $username, $chat_id, $name, $phone, $usluga, $instagram, $old_id){
    $username = trim($username);
    $chat_id = trim($chat_id);
    $name = trim($name);

    if($chat_id == '')
        return false;

if($connect->query("SELECT COUNT(*) FROM textlog WHERE chat_id='$chat_id'")->fetch_row()[0]>0){
    $query = "UPDATE  textlog SET phone = '$phone',usluga = '$usluga', instagram = '$instagram' WHERE chat_id = '$chat_id'";
    $result = mysqli_query($connect, $query);

}else{
    $t = "INSERT INTO textlog (username, chat_id, name, phone, usluga, instagram) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')";
    $query = sprintf($t, mysqli_real_escape_string($connect, $username),
        mysqli_real_escape_string($connect, $chat_id),
        mysqli_real_escape_string($connect, $name),
        mysqli_real_escape_string($connect, $phone),
        mysqli_real_escape_string($connect, $usluga),
        mysqli_real_escape_string($connect, $instagram));
    $result = mysqli_query($connect, $query);
}



    if(!$result)
        die(mysqli_error($connect));
    return true;
}

function update($feild,$value){
    global $username,$chat_id,$name,$connect;
    $username = trim($username);
    $chat_id = trim($chat_id);
    $name = trim($name);

    if($chat_id == '')
        return false;

    if($connect->query("SELECT COUNT(*) FROM textlog WHERE chat_id='$chat_id'")->fetch_row()[0]<1){
        $t = "INSERT INTO textlog (username, chat_id, name, phone, usluga, instagram, dop_param, date_zapis) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')";
        $query = sprintf($t, mysqli_real_escape_string($connect, $username),
            mysqli_real_escape_string($connect, $chat_id),
            mysqli_real_escape_string($connect, $name),
            mysqli_real_escape_string($connect, ' '),
            mysqli_real_escape_string($connect, ' '),
            mysqli_real_escape_string($connect, ' '),
            mysqli_real_escape_string($connect, ' '),
            mysqli_real_escape_string($connect, ' '));
        $result = mysqli_query($connect, $query);
    }

    $query = "UPDATE  textlog SET $feild = '$value' WHERE chat_id = '$chat_id'";
    $result = mysqli_query($connect, $query);


    if(!$result)
        die(mysqli_error($connect));
    return true;





}

function users_all($connect){
    $query = "SELECT * FROM users";
    $result = mysqli_query($connect, $query);
    if(!$result)
        die(mysqli_error($connect));
    $n = mysqli_num_rows($result);
    $users_all = array();
    for ($i = 0; $i <$n; $i++){
        $row = mysqli_fetch_assoc($result);
        $users_all[] = $row;
    }
    return $users_all;
}



//=====================================================Main function===================================================================


function mobile_accept(){
    global $telegram, $menuback, $chat_id, $text;
    $reply = "<b>Напишите свой номер телефона для связи</b>";
    $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $menuback, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
    $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
}
function param_accept(){
    global $telegram, $menuback, $chat_id, $text, $menuback2;
    $reply = "\xF0\x9F\x95\x9C В какой половине дня Вам будет удобно? \xF0\x9F\x95\x9D" . "\n" . "Выберите вариант в меню \xE2\xAC\x87";
    $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $menuback2, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
    $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
    update('usluga', $text);
}
function param_accept2(){
    global $telegram, $menuback, $chat_id, $text;
    $reply = "\xF0\x9F\x95\x9C Во сколько Вам нужно быть готовой? \xF0\x9F\x95\x9D" . "\n" ."<b>Указать время и обязательно закончить словом 'готовой!':</b>" . "\n" . "<i>Пример:</i>" ."\n". "В <b>12-00</b> нужно быть <b>готовой</b>" . "\n" . "или К <b>13-00</b> нужно быть <b>готовой</b>";
    $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $menuback, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
    $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
    update('usluga', $text);

}
function date_accept_zapis(){
    global $telegram, $menuback, $chat_id, $text;
    $reply = "Введите желаемую дату". "\n" .  "В формате: <b>День.Месяц.Год</b>";
    $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $menuback, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
    $telegram->sendMessage(['parse_mode' => 'HTML', 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);

}



//=====================================================Main function===================================================================
//=====================================================CallBack function===================================================================
function inline_buttons(){
    global $telegram, $callback_data, $callback_id, $api, $callback_res_id, $callback_message_id, $chat_id, $inline_back;
    switch ($callback_data){
        case "polish" :
            $img = 'images/polishing.jpg';
            send_answerCallbackQuery($api, $callback_res_id, "Полировка", false);
            edit_MessageText($api, $callback_id, $callback_message_id, 'Полировка');
            $telegram->sendPhoto(['chat_id' => $callback_id, 'photo' => $img, 'parse_mode' => 'HTML']);
            break;
        case "cut" :
            $img = 'images/cut.jpg';
            send_answerCallbackQuery($api, $callback_res_id, "Стрижки", false);
            edit_MessageText($api, $callback_id, $callback_message_id, 'Стрижки');
            $telegram->sendPhoto(['chat_id' => $callback_id, 'photo' => $img, 'parse_mode' => 'HTML']);
            break;
        case "afro" :
            $img = 'images/afro.jpg';
            send_answerCallbackQuery($api, $callback_res_id, "Афрокудри", false);
            edit_MessageText($api, $callback_id, $callback_message_id, 'Афрокудри');
            $telegram->sendPhoto(['chat_id' => $callback_id, 'photo' => $img, 'parse_mode' => 'HTML']);
            break;
        case "braid" :
            $img = 'images/hair1.jpg';
            send_answerCallbackQuery($api, $callback_res_id, "Плетение", false);
            edit_MessageText($api, $callback_id, $callback_message_id, 'Плетение');
            $telegram->sendPhoto(['chat_id' => $callback_id, 'photo' => $img, 'parse_mode' => 'HTML']);
            break;
        case "evening" :
            $img = 'images/hair1.jpg';
            send_answerCallbackQuery($api, $callback_res_id, "Вечерняя прическа", false);
            edit_MessageText($api, $callback_id, $callback_message_id, 'Вечерняя прическа');
            $telegram->sendPhoto(['chat_id' => $callback_id, 'photo' => $img, 'parse_mode' => 'HTML']);
            break;
        case "marrige" :
            $img = 'images/wedding.jpg';
            send_answerCallbackQuery($api, $callback_res_id, "Свадебная прическа", false);
            edit_MessageText($api, $callback_id, $callback_message_id, 'Свадебная прическа');
            $telegram->sendPhoto(['chat_id' => $callback_id, 'photo' => $img, 'parse_mode' => 'HTML']);
            break;
        case "senior" :
            $img = 'images/hair1.jpg';
            send_answerCallbackQuery($api, $callback_res_id, "Выпускная прическа", false);
            edit_MessageText($api, $callback_id, $callback_message_id, 'Выпускная прическа');
            $telegram->sendPhoto(['chat_id' => $callback_id, 'photo' => $img, 'parse_mode' => 'HTML']);
            break;
    }
}

function send_answerCallbackQuery($api, $callback_id, $text, $show_alert){
    file_get_contents("https://api.telegram.org/bot".$api."/answerCallbackQuery?callback_query_id=".$callback_id."&text=".$text."&show_alert=".$show_alert);
}
function edit_MessageText($api, $callback_id, $callback_message_id, $text){
    file_get_contents("https://api.telegram.org/bot".$api."/editMessageText?chat_id=".$callback_id."&message_id=".$callback_message_id."&text=".urlencode($text));
}



//=====================================================CallBack function===================================================================
?>