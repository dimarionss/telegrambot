<?php

include('settings.php');
include('bot_lib.php');

if(isset($_POST['send'])){
    $text = $_POST['text'];
    $users_all = users_all($connect);

    foreach($users_all as $p){
        $url = file_get_contents("https://api.telegram.org/bot".$api."/sendMessage?chat_id=".$p['chat_id']."&text=".$text."&parse_mode=HTML");
    }
}

?>


<!doctype html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Required meta tags -->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Sending messages</title>
    <style>
        /* Demo Background */
        body{background: #333333}
        textarea.form-control {
            height: 500px;
        }
        h1{
            color: #fff;
            text-align: center;
        }
        label {
            color: #fff;
        }
        .btn {
            border-radius: 100px;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 1px;
            padding: 17px 39px;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.14);
            text-transform: uppercase;
            box-shadow: 0 4px 9px 0 rgba(0, 0, 0, 0.2);
        }
        .btn-primary {
            /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#5a7ce2+0,8283e8+50,5c5de8+51,565bd8+71,575cdb+100 */
            background: #5a7ce2;
            /* Old browsers */
            background: -moz-linear-gradient(-45deg, #5a7ce2 0%, #8283e8 50%, #5c5de8 51%, #565bd8 71%, #575cdb 100%);
            /* FF3.6-15 */
            background: -webkit-linear-gradient(-45deg, #5a7ce2 0%,#8283e8 50%,#5c5de8 51%,#565bd8 71%,#575cdb 100%);
            /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(135deg, #5a7ce2 0%,#8283e8 50%,#5c5de8 51%,#565bd8 71%,#575cdb 100%);
            /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#5a7ce2', endColorstr='#575cdb',GradientType=1 );
            /* IE6-9 fallback on horizontal gradient */
            background-size: 400% 400%;
            -webkit-animation: AnimationName 3s ease infinite;
            -moz-animation: AnimationName 3s ease infinite;
            animation: AnimationName 3s ease infinite;
            -webkit-animation: AnimationName 3s ease infinite;
            -moz-animation: AnimationName 3s ease infinite;
            animation: AnimationName 3s ease infinite;
            border: medium none;
        }


    </style>
</head>
<body>
<div class="container">
<form enctype="plain/text" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <div class="form-group">
        <h1>Спам форма!</h1>
        <label for="exampleFormControlTextarea1">Введите сообщение</label>
        <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <input type="submit" class="btn btn-primary" name="send" value="Send">
</form>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>