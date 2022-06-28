<?php
//  SMS OTP for SmsGateWay 24
//  Confirming the OTP code by text message via SmsGateWay 24 - shorcode [smsgateway24/]
//  SmsGateWay24


//----------------------------------------------------------------------------------------------------//

// Connecting to wp-load.php to read a table in the DB_NAME database

define('SHORTINIT', true);
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );

$db_host = DB_HOST;
$db_user = DB_USER; 
$db_password = DB_PASSWORD; // Пароль БД
$db_base = DB_NAME; // Имя БД
$db_table = "base_smsgateway24"; // Имя Таблицы БД
	
// Поиск записи в базе

$phone = 'phone';
$codesms  = 'codesms';
$datetime = 'datetime';

// Подготовим SQL-запрос:

$conn = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_base);

// Получаем запрос из ячейки с вводом кода СМС

$code = htmlspecialchars($_POST['code']);

// Сравниваеи если поле пустое то значени равно 0000

if (empty($code)){
	$code = '0000';
	} 

// Создаём SQL запрос	

$sql = "SELECT * FROM $db_table where codesms = $code"; 

// Отправляем SQL запрос

$result = $mysqli -> query($sql); 

// Извлечение ассоциативного массива

while ($row = $result->fetch_assoc())

// Условие действий после ввода кода код из смс совпал:

if ($codesms = $code){   
	
// Тест - вывод данных на монитор	
//echo "TEL: ", $row['phone']; 
//echo "CODE: ", $row['codesms'];
//echo "Дата и Время: ", $row['datetime'];
	
//Удалить из базы ячейки с телефоном
	
	$phonedel = $row['phone'];
	$resultdel = $mysqli->query ("DELETE FROM $db_table WHERE phone = '$phonedel'"); 
	

// Тест - вывод данных на монитор	
//echo "Верификация прошла успешно.";
	
//Ссылка для перехода на страницу

$db_tablex = "table_smsgateway24_admin";
$db = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
$db->exec("set names utf8");
$smsgateway24_db = $db->query('SELECT device_id_db, db_token, body_text, body_text_1, url_new_pg_db FROM table_smsgateway24_admin WHERE id=1');
while ($rowdb = $smsgateway24_db->fetch())
	
$url_new_pg_db_row = $rowdb['url_new_pg_db'];

header('Location: '.$url_new_pg_db_row);

	}



// Условие действий после ввода кода код из смс несовпал
	
if ($codesms != $code){
	
// Создаём SQL запрос
	
	$sqldel = "SELECT * FROM $db_table where codesms <> $code";
	
// Отправляем SQL запрос
	
	$resultdel = $mysqli -> query($sqldel);
	
// Извлечение ассоциативного массива	

	while ($rowdel = $resultdel->fetch_assoc()) 
	if ($codesms != '0000'){
	
//Удалить из базы ячейки с телефоном
	
	$phonedel = $rowdel['phone'];
	$resultbaddel = $mysqli->query ("DELETE FROM $db_table WHERE phone = '$phonedel' and codesms = '$code'");
	}
	
// Тест - вывод данных на монитор		
//echo  "Код введен неверно! Повторите верификацию. ";

//Ссылка для перехода на страницу

$db_tablex = "table_smsgateway24_admin";
$db = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
$db->exec("set names utf8");
$smsgateway24_db = $db->query('SELECT device_id_db, db_token, body_text, body_text_1, url_new_pg_db, url_newkill_pg_db FROM table_smsgateway24_admin WHERE id=1');
while ($rowdb = $smsgateway24_db->fetch())
	
$url_newkill_pg_db_row = $rowdb['url_newkill_pg_db'];

header('Location: '.$url_newkill_pg_db_row);

   }
   




?>

