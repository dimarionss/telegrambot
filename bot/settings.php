<?php
/********************************************************
*  Settings file
********************************************************/

$api = '993443177:AAFxrxwGUIitLrUI3tzvc-1uKHeMa8WWFfI';
define('MYSQL_SERVER', 'localhost');
define('MYSQL_USER', 'roihairstylist');
define('MYSQL_PASSWORD', 'DR13572468roi');
define('MYSQL_DB', 'telegrambot');


function db_connect(){
	$connect = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB)
		or die("Error: ".mysqli_error($connect));
	if(!mysqli_set_charset($connect, "utf8mb4")){
		print("Error: ".mysqli_error($connect));
	}
	return $connect;
}

$connect = db_connect();

?>
