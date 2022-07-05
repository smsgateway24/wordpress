
plugin For WORDPRESS SMS OTP for SmsGateWay24

Installation through file-manager:

1. Unpack archive smssendver.zip в wp-content/plugins/
2. In the section plugins find /SMS OTP for SmsGateWay24/ и Press /Activate/
3. In the section /Settigns/ find /SmsGateWay24 Plugin/ - This is the admin panel for the general settings of the plugin SmsGateWay24
4. Enter shorcode [smsgateway24/] и use
 

Installation through admin panel WORDPRESS:
 
1. Enter the section /plugins/
2. Press раздел /Add new/
3. Press button /Upload plugin/
4. Press button /Browse.../
5. Upload archive smssendver.zip
6. Press button /Activate/
7. In the section /Settigns/ find /SmsGateWay24 Plugin/ - This is the admin panel for the general settings of the plugin SmsGateWay24
8. Enter shorcode [smsgateway24/] и use



********************************
shorcode plugin [smsgateway24/]
********************************


smssend.php - file with sms code
--------------------------------------------------------------------------------
What adjustments can be made to work

line 14

$selsim = rand(0,1); //Генератор случайного кода For выбора симкарты (В ЭТОМ МЕСТЕ МОЖНО ЗАМЕНТЬ rand(0,1) НА ЦИФРУ 0 or 1 ЗАВИСИТ КАКОЙ СИМКАРТОЙ БУДЕТЕ ПОЛЬЗОВАТЬСЯ )

example

$selsim = 0;
$selsim = 1;

или

line 128

"sim" => $selsim, //sim number 0 or 1  depends on the amount in the smartphone

example

"sim" => 0,
"sim" => 1,


line 15

$codesms = rand(1000,9999); //Генератор случайного кода For отправки СМС
(ЕСЛИ ДОБАВИТЬ КОЛИЧЕСТВО ЦИФР В $codesms = rand(1000,9999); В 1000 ДОБАВИТЬ 0, А 9 К 9999, ТО ДЛИНА КОДА В СМС СТАНЕТ БОЛЬШЕ)

example

$codesms = rand(10000,99999);


**********************************************************************************************************


smssend.html - file Phone number input field
--------------------------------------------------------------------------------
What adjustments can be made to work

line 46

<script>jQuery( function($){$("#input-callback-phone").mask("+9 (999) 999-99-99");});</script>

entered by the user in the verification window

example

mask("+7 (999) 999-99-99")
mask("+99(999) 999-99-99")


**********************************************************************************************************


smsver.php - file verification of the code from the sms
--------------------------------------------------------------------------------
What adjustments can be made to work

line 86

header('Location: '.$url_new_pg_db_row);

если ее закоментироать и вставить свой код php, то после успешного подтверждения кода из смс можно будет
execute your command

line 128

header('Location: '.$url_new_pg_db_row);

если ее закоментироать и вставить свой код php, то после неудачного подтверждения кода из смс можно будет
execute your command


**********************************************************************************************************

index.html - file to work without shorcode
smssend.html - Phone number entry
inputcode.html - file to enter the verification code

(установите на любой ссылку и они будут работать самостоятельно без shorcode, For корректной работы fileов нужно дописать свой код)

example Link

wp-content/plugins/smssendver/index.html

**********************************************************************************************************











