<?php
//  SMS OTP for SmsGateWay24
//  Confirming the OTP code by text message via SmsGateWay24 - shorcode [smsgateway24/]
//  SmsGateWay24


define('SHORTINIT', true);
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');


$db_host = DB_HOST;
$db_user = DB_USER;
$db_password = DB_PASSWORD;
$db_base = DB_NAME;
$db_table = "base_smsgateway24";

$phone = 'phone';
$codesms = 'codesms';
$datetime = 'datetime';

$conn = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_base);
$code = htmlspecialchars($_POST['code']);

if (empty($code)) {
    $code = '0000';
}

$sql = "SELECT * FROM $db_table where codesms = $code";

$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc())

    if ($codesms = $code) {

        $phonedel = $row['phone'];
        $resultdel = $mysqli->query("DELETE FROM $db_table WHERE phone = '$phonedel'");
        $db_tablex = "table_smsgateway24_admin";
        $db = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
        $db->exec("set names utf8");
        $smsgateway24_db = $db->query('SELECT device_id_db, db_token, body_text, body_text_1, url_new_pg_db FROM table_smsgateway24_admin WHERE id=1');
        while ($rowdb = $smsgateway24_db->fetch())
            $url_new_pg_db_row = $rowdb['url_new_pg_db'];
        header('Location: ' . $url_new_pg_db_row);

    }


if ($codesms != $code) {
    $sqldel = "SELECT * FROM $db_table where codesms <> $code";
    $resultdel = $mysqli->query($sqldel);
    while ($rowdel = $resultdel->fetch_assoc())
        if ($codesms != '0000') {
            $phonedel = $rowdel['phone'];
            $resultbaddel = $mysqli->query("DELETE FROM $db_table WHERE phone = '$phonedel' and codesms = '$code'");
        }
    $db_tablex = "table_smsgateway24_admin";
    $db = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
    $db->exec("set names utf8");
    $smsgateway24_db = $db->query('SELECT device_id_db, db_token, body_text, body_text_1, url_new_pg_db, url_newkill_pg_db FROM table_smsgateway24_admin WHERE id=1');
    while ($rowdb = $smsgateway24_db->fetch())

        $url_newkill_pg_db_row = $rowdb['url_newkill_pg_db'];

    header('Location: ' . $url_newkill_pg_db_row);

}


?>

