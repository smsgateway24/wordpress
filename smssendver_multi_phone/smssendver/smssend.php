<?php

//  SMS OTP for SmsGateWay 24
//  Confirming the OTP code by text message via SmsGateWay 24 - shorcode [smsgateway24/]
//  SmsGateWay24

// Connecting to a SQL database and writing and sending OTP code to the phone //
//----------------------------------------------------------------------------------------------------//


// Setting the number of SIM cards, SMS code generator, SMS date

//$selsim = 0 // SIM card number: 0 or 1
$codesms = rand(1000, 9999);
$datetime = date("Y-m-d H:i:s"); //Date and time of SMS sending


try {

// Connecting to wp-load.php to read a table in the DB_NAME database

    define('SHORTINIT', true);
    require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');


    $db_host = DB_HOST;
    $db_user = DB_USER;
    $db_password = DB_PASSWORD;
    $db_base = DB_NAME;
    $db_table = "base_smsgateway24";


//Data SMSGATEWAY24.COM

    $baseUrl = "https://smsgateway24.com";
    $endpoint = "/getdata/addalotofsms";
    $url = $baseUrl . $endpoint;
    $paramsArr = [];
    $myphone = htmlspecialchars($_POST['myphone']); //номер телефона введенный пользователем в окне верификации

    if (empty($myphone)) {
        exit;
        exit();
        exit(0);
    }


    $db = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);


    $db->exec("set names utf8");

// Collecting data from the database for the query

    $data = array(
        'phone' => $myphone,
        'codesms' => $codesms,
        'datetime' => $datetime,
    );

// Preparing an SQL query

    $query = $db->prepare("INSERT INTO $db_table (phone, codesms, datetime) values (:phone, :codesms, :datetime)");

// Executing a query with data

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


//Test
//echo $device_id_row;
//echo $db_sim_row;
//echo $db_token_row;
//echo $body_text_row;
//echo $body_text_1_row;
//echo $url_new_pg_db_row;
}

$paramsArr['token'] = "$db_token_row"; // Token smsgateway24
$paramsArr['smsdata'] = [
    [
        "sendto" => $myphone, //target
        "body" => "$body_text_row $codesms $body_text_1_row", //SMS body
        "device_id" => $device_id_row, //номер устройства
        "sim" => $db_sim_row, ///SIM #
        //"sim" => $selsim, // SIM #
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

/* Example of good answer  */

/* {"error":0,"message":"Sms has been saved successfully"}% */

/* If you prefer an array: output the information about texting */

$responceArr = json_decode($server_output);
$json = json_decode($server_output);

//echo $server_output, $codesms;


//Conditions if the result is met

if ($result) {

// test
//echo "Success";

//Go to page link
//header('Location: inputcode.html');

}

?>