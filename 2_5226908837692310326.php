<?php 
/*
Guruhda kimdur sizni eslasa bu haqida shaxsiy Ucell raqamizga sms tarzida javob olasiz.
SMS yuborish uchun http://sms.uzero.ru saytidan Token olishingiz va uni har kuni 
ertalab aktivlab turishingiz talab etiladi. 

Kod @idFox ga tegishli bo'lib telegramdagi @pcode kanali orqali tarqatildi!
Date: 2018.07.18 1:49
*/

// bot tokenini kiritasiz 
define('bot_token','5373823299:AAHibZT4Nh0jy9arcoLbRdtCiMOv8IiTk4o');

$secret_key = '2092489246';  // http://sms.uzero.ru saytidan olasiz uzizga tokenni
$number = '998930801765';  // uzizni telfon raqamingiz

// uzizni ID raqamingizni kiritasiz
$admin = "2092489246";
// ID ni https://t.me/UZeroBot ga #id suzini yuborgan holda bilishingiz mumkin


    function xabarYubor(array $content)
    {
        return endpoint('sendMessage', $content);
    }

    function buildKeyBoard(array $options, $onetime = false, $resize = true, $selective = true)
    {
        $replyMarkup = [
            'keyboard'          => $options,
            'one_time_keyboard' => $onetime,
            'resize_keyboard'   => $resize,
            'selective'         => $selective,
        ];
        $encodedMarkup = json_encode($replyMarkup, true);

        return $encodedMarkup;
    }

    function endpoint($api, array $content, $post = true)
    {
        $url = 'https://api.telegram.org/bot'.bot_token.'/'.$api;
        if ($post) {
            $reply = sendAPIRequest($url, $content);
        } else {
            $reply = sendAPIRequest($url, [], false);
        }

        return json_decode($reply, true);
    }

    function sendAPIRequest($url, array $content, $post = true)
    {
        if (isset($content['chat_id'])) {
            $url = $url.'?chat_id='.$content['chat_id'];

            //$url = $url.'?'.http_build_query($content);

            unset($content['chat_id']);
            //unset($content);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ($post) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        if ($result === false) {
            $result = json_encode(['ok'=>false, 'curl_error_code' => curl_errno($ch), 'curl_error' => curl_error($ch)]);
        }
        curl_close($ch);

        return $result;
    }

    function buildForceReply($selective = true)
    {
        $replyMarkup = [
            'force_reply' => true,
            'selective'   => $selective,
        ];
        $encodedMarkup = json_encode($replyMarkup, true);

        return $encodedMarkup;
    }

    function answerCallbackQuery(array $content)
    {
        return $this->endpoint('answerCallbackQuery', $content);
    }

    function buildInlineKeyboardButton($text, $url = '', $callback_data = '', $switch_inline_query = null, $switch_inline_query_current_chat = null, $callback_game = '', $pay = '')
    {
        $replyMarkup = [
            'text' => $text,
        ];
        if ($url != '') {
            $replyMarkup['url'] = $url;
        } elseif ($callback_data != '') {
            $replyMarkup['callback_data'] = $callback_data;
        } elseif (!is_null($switch_inline_query)) {
            $replyMarkup['switch_inline_query'] = $switch_inline_query;
        } elseif (!is_null($switch_inline_query_current_chat)) {
            $replyMarkup['switch_inline_query_current_chat'] = $switch_inline_query_current_chat;
        } elseif ($callback_game != '') {
            $replyMarkup['callback_game'] = $callback_game;
        } elseif ($pay != '') {
            $replyMarkup['pay'] = $pay;
        }

        return $replyMarkup;
    }

    function buildInlineKeyBoard(array $options)
    {
        $replyMarkup = [
            'inline_keyboard' => $options,
        ];
        $encodedMarkup = json_encode($replyMarkup, true);

        return $encodedMarkup;
    }


$efede = json_decode(file_get_contents('php://input'), true);

//basic
$text = $efede["message"]["text"];
$photo = $efede["message"]["photo"];
$sana = $efede["message"]["date"];
$chat_id = $efede["message"]["chat"]["id"];
$msg_id = $efede["message"]["message_id"];

// chat
$cfname = $efede['message']['chat']['first_name'];
$cid = $efede["message"]["chat"]["id"];
$clast_name = $efede['message']['chat']['last_name'];
$turi = $efede["message"]["chat"]["type"];
$ctitle = $efede['message']['chat']['title'];

//user info
$ufname = $efede['message']['from']['first_name'];
$uname = $efede['message']['from']['last_name'];
$ulogin = $efede['message']['from']['username'];
$uid = $efede['message']['from']['id'];
$user_id = $efede['message']['from']['id'];

//reply info
$sreply = $efede['message']['reply_to_message']['text'];


$baza = file_get_contents("shpionsms.dat");

if(mb_stripos($baza, $user_id) !== false){ 
}else{
    $baza = file_get_contents("shpionsms.dat");

    $textm="$user_id\n";
    $myfile = fopen("shpionsms.dat", "a");
    fwrite($myfile, $textm);
    fclose($myfile);
}

// shu yerda kalit suzlar guruhda ishlatilsa usha xabarni men sizga yetkazaman
$kalit_suz = [
  '#efede', 
  '#fde',
  'efede',
  'fd3',
  'admin',
  '#admin',
];

if (isset($text) && isset($chat_id)) {
    $text = strtolower($text);

    $suzlar = explode(' ', $text);
    foreach ($kalit_suz as $key => $value) {
        foreach ($suzlar as $key => $natija) {
            if($natija == $value) {

                //$message = "<b>$ctitle:</b> $ufname $uname (@$ulogin) = <i>$text</i>";
                //$content = ['chat_id' => $admin, 'text' => $message, 'parse_mode' => 'html'];
                //xabarYubor($content);

                $matn = "Yangi xabar: $ctitle guruhdagi $ufname $uname (@$ulogin) dan = $text";
                $matn = urlencode($matn);
                $send = json_decode(file_get_contents("http://sms.uzero.ru/api.php?secret_key=$secret_key&operator=ucell&number=$number&text=$matn"));
                
                $success = $send->success;
                $error = $send->error;

                if ($success == 'true') {
                    $message = "<b>Ushbu xabarni sms orqali yetkazib quydim </b>";
                    $content = ['chat_id' => $chat_id, 'reply_to_message_id' => $msg_id, 'text' => $message, 'parse_mode' => 'html'];
                    xabarYubor($content);
                } else {
                    $message = "<b>SMS tizim faol emas, iltimos http://sms.uzero.ru/ping.php kirib tizimni aktivlang</b>";
                    $content = ['chat_id' => $admin, 'text' => $message, 'parse_mode' => 'html'];
                    $sendd = xabarYubor($content);

                    $message = "Yangi xabar: <b>$ctitle:</b> $ufname $uname (@$ulogin) = <i>$text</i>";
                    $content = ['chat_id' => $admin, 'text' => $message, 'parse_mode' => 'html'];
                    $send = xabarYubor($content);

                    $sended = $send['ok'];
                    if($sended == 'true'){
                        $message = "<b>Ushbu xabarni sms orqali yetkaza olmadim shu sabab lichkasiga tashlab quydim </b>";
                        $content = ['chat_id' => $chat_id, 'reply_to_message_id' => $msg_id, 'text' => $message, 'parse_mode' => 'html'];
                        xabarYubor($content);
                    }
                }
                break;
            }
        }
    }
}

    // umumiy menu
    $menu = [["???my info"],["????bog'lanish"]];



    if ($text == '/start') {
        $keyfd = buildKeyBoard($menu, $onetime = false, $resize = true);
        $content = ['chat_id' => $chat_id, 'reply_markup' => $keyfd, 'text' => "Assalomu alaykum ??? $ufname $uname.", 'parse_mode' => 'html'];
        xabarYubor($content);
    }

    if ($text == '/ping' && $user_id == $admin) {

        $matn = "SMS tizimni tekshirish, http://sms.uzero.ru";
        $matn = urlencode($matn);
        $send = json_decode(file_get_contents("http://sms.uzero.ru/api.php?secret_key=$secret_key&operator=ucell&number=$number&text=$matn"));
                
        $success = $send->success;
        $error = $send->error;

        if ($success == 'true') {
            $message = "<b>SMS tizim faol </b>";
            $content = ['chat_id' => $chat_id, 'reply_to_message_id' => $msg_id, 'text' => $message, 'parse_mode' => 'html'];
            xabarYubor($content);
        } else {

            $message = "<b>SMS tizim faol emas, iltimos http://sms.uzero.ru/ping.php kirib tizimni aktivlang </b>";
            $content = ['chat_id' => $chat_id, 'reply_to_message_id' => $msg_id, 'text' => $message, 'parse_mode' => 'html'];
            xabarYubor($content);
        }
    }   

    if (mb_stripos($text,"/sms") !== false && $user_id == $admin){
        $loop = explode("=", $text);
        $number = $loop[1];
        $matn = $loop[2];
        $matn = urlencode($matn);

        $send = json_decode(file_get_contents("http://sms.uzero.ru/api.php?secret_key=$secret_key&operator=ucell&number=$number&text=$matn"));
                
        $success = $send->success;
        $error = $send->error;

        if ($success == 'true') {
            $message = "<b>$number ga sms yuborildi </b>";
            $content = ['chat_id' => $chat_id, 'reply_to_message_id' => $msg_id, 'text' => $message, 'parse_mode' => 'html'];
            xabarYubor($content);
        } else {

            $message = "<b>SMS tizim faol emas, shu sababli $number ga SMS yubora olmadim. 
            Iltimos http://sms.uzero.ru/ping.php kirib tizimni aktivlang </b>";
            $content = ['chat_id' => $chat_id, 'reply_to_message_id' => $msg_id, 'text' => $message, 'parse_mode' => 'html'];
            xabarYubor($content);
        }
    }
    
    if ($text == '???my info') {
        $keyfd = buildKeyBoard($menu, $onetime = false, $resize = true);
        $content = ['chat_id' => $chat_id, 'reply_markup' => $keyfd, 'text' => "Salom??? \n ????$ufname \n ????$uname \n ????$uid", 'parse_mode' => 'html'];
        xabarYubor($content);
    }


        if ($text == '/feedback' || $text == "????bog'lanish"){
            $keyfd = buildForceReply($selective=true);
            $content = ['chat_id' => $chat_id, 'reply_markup' => $keyfd, 'text' => "xabar matnini kiriting", 'parse_mode' => 'markdown'];
            xabarYubor($content);
        }

        if ($sreply == 'xabar matnini kiriting'){

            $option = $menu;
            $keyfd = buildKeyBoard($option, $onetime = false);
            $content = ['chat_id' => $chat_id, 'reply_markup' => $keyfd, 'text' => "*Xabaringiz yaqin fursatda kurib chiqiladi*", 'parse_mode' => 'markdown'];
            xabarYubor($content);

            $option = [["javob#$chat_id"]];
            $keyfd = buildKeyBoard($option, $onetime = false);
            $content = ['chat_id' => $admin, 'reply_markup' => $keyfd, 'text' => "Yangi Xabar \n Kimdan: $ufname $uname \n Login: @$ulogin \n ID: $uid \n\n Matn: $text", 'parse_mode' => 'markdown'];
            xabarYubor($content);
        }

        $inreg = explode("#",$text);
        $intype  = $inreg[0];
        $us_id  = $inreg[1];

        if ($intype == 'javob') {

            $keyfd = buildForceReply($selective=true);
            $content = ['chat_id' => $chat_id, 'reply_markup' => $keyfd, 'text' => "javob matnini kiriting#$us_id", 'parse_mode' => 'markdown'];
            xabarYubor($content);
        }

        $inreg = explode("#",$sreply);
        $intype  = $inreg[0];
        $us_id  = $inreg[1];

        if ($intype == 'javob matnini kiriting'){

            $option = $menu;
            $keyfd = buildKeyBoard($option, $onetime = false);
            $content = ['chat_id' => $us_id, 'reply_markup' => $keyfd, 'text' => $text, 'parse_mode' => 'markdown'];
            xabarYubor($content);

            $option = $menu;
            $keyfd = buildKeyBoard($option, $onetime = false);
            $content = ['chat_id' => $admin, 'reply_markup' => $keyfd, 'text' => "Xabar yetkazildi", 'parse_mode' => 'markdown'];
            xabarYubor($content);
        }
