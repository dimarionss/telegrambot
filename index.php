<?
include "idiorm.php";
ORM::configure('mysql:host=localhost;dbname=telegrambot');
ORM::configure('username', 'roihairstylist');
ORM::configure('password', 'DR13572468roi');

//$r = ORM::forTable('textlog')
//    ->where('chat_id','579137769')
//    ->findOne()
//    ->set('instagram',3434343)
//    ->save();




?>
<!--SELECT * FROM `users` RIGHT JOIN uslugi ON uslugi.id_user = users.id-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Hello World</h1>
</body>
</html>
<?
var_dump($r);

?>