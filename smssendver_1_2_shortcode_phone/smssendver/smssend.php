<?php

//  SMS OTP for SmsGateWay24
//  Confirming the OTP code by text message via SmsGateWay24 - shorcode [smsgateway24/]
//  SmsGateWay24

// Connecting to a SQL database and writing and sending OTP code to the phone //
//----------------------------------------------------------------------------------------------------//


// Setting the number of SIM cards, SMS code generator, SMS date

//$selsim = rand(0,1); // 0 or 1
$codesms = rand(1000, 9999); //Random code generator to send SMS (IF I ADD NUMBER OF DIGITS IN $codesms = rand(1000,9999); IN 1000 ADD 0, AND 9 TO 9999, THEN THE LONGER CODE IN THE SMS WILL BE LARGER)
$datetime = date("Y-m-d H:i:s"); //Date and time of SMS sending


try {


    define('SHORTINIT', true);
    require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');


    $db_host = DB_HOST;
    $db_user = DB_USER;
    $db_password = DB_PASSWORD;
    $db_base = DB_NAME;
    $db_table = "base_smsgateway24";


    $baseUrl = "https://smsgateway24.com";
    $endpoint = "/getdata/addalotofsms";
    $url = $baseUrl . $endpoint;
    $paramsArr = [];
    $myphone = htmlspecialchars($_POST['myphone']); //Phone number entered by the user in the verification window

    if (empty($myphone)) {
        exit;
        exit();
        exit(0);
    }


    $db = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);


    $db->exec("set names utf8");

    $data = array(
        'phone' => $myphone,
        'codesms' => $codesms,
        'datetime' => $datetime,
    );


    $query = $db->prepare("INSERT INTO $db_table (phone, codesms, datetime) values (:phone, :codesms, :datetime)");


    $query->execute($data);


    $result = true;

} catch (PDOException $e) {

    print "Error!: " . $e->getMessage() . "<br/>";
}

$db_tablex = "table_smsgateway24_admin";
$db = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
$db->exec("set names utf8");
$smsgateway24_db = $db->query('SELECT device_id_db, db_sim, db_token, body_text, body_text_1, url_new_pg_db FROM table_smsgateway24_admin WHERE id=1');

while ($rowdb = $smsgateway24_db->fetch()) {

    $device_id_row = $rowdb['device_id_db'];
    $db_sim_row = $rowdb['db_sim'];
    $db_token_row = $rowdb['db_token'];
    $body_text_row = $rowdb['body_text'];
    $body_text_1_row = $rowdb['body_text_1'];
    $url_new_pg_db_row = $rowdb['url_new_pg_db'];


// TESTING
//echo $device_id_row;
//echo $db_sim_row;
//echo $db_token_row;
//echo $body_text_row;
//echo $body_text_1_row;
//echo $url_new_pg_db_row;
}

// Отсылаем код в СМС

$paramsArr['token'] = "$db_token_row"; //Тоокен For подключения к smsgateway24
$paramsArr['smsdata'] = [
    [
        "sendto" => $myphone, //команда отправка на Phone number entered by the user in the verification window
        "body" => "$body_text_row $codesms $body_text_1_row", //текст смс 
        "device_id" => $device_id_row, //номер устройства
        "sim" => $db_sim_row, ///Получение номера симкарты из админ панели
        //"sim" => $selsim, //sim number 0 or 1  depends on the amount in the smartphone
        "urgent" => "1"
    ]
];

// Exchanging data with SMSGATEWAY24.COM 

$json = json_encode($paramsArr);
$arr['datajson'] = $json;
$ch = curl_init();

curl_setopt($ch, \CURLOPT_URL, $url);
curl_setopt($ch, \CURLOPT_POST, 1);
curl_setopt($ch, \CURLOPT_POSTFIELDS, $arr);
curl_setopt($ch, \CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close($ch);

/* Example of good answer / example хорошего ответа: */

/* {"error":0,"message":"Sms has been saved successfully"}% */

/* Если вы предпочитаете массив: вывод информации о смс отправке */

$responceArr = json_decode($server_output);
$json = json_decode($server_output);

// Тест - вывод данных на экран
//echo $server_output, $codesms; 


//Условия если результат выполнен 

if ($result) {

// Тест - вывод данных на экран
//echo "Успех. Информация занесена в базу данных";

//Ссылка For перехода на страницу

    //header('Location: inputcode.html');

}

?>