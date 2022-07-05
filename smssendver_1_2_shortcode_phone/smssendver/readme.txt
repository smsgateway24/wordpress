plugin For WORDPRESS SMS OTP for SmsGateWay24

Installation through file-manager:
1. Unpack archive smssendver.zip в wp-content/plugins/
2. In the section plugins find /SMS OTP for SmsGateWay24/ и Press /Activate/
3. In the section /Settigns/ find /SmsGateWay24 Plugin/ - This is the admin panel for the general settings of the plugin SmsGateWay24
4. Enter shorcode [smsgateway24/] or [smsgateway24country/] use
 
Installation through admin panel WORDPRESS:
1. Enter the section /plugins/
2. Press раздел /Add new/
3. Press button /Upload plugin/
4. Press button /Browse.../
5. Upload archive smssendver.zip
6. Press button /Activate/
7. In the section /Settigns/ find /SmsGateWay24 Plugin/ - This is the admin panel for the general settings of the plugin SmsGateWay24
8. Enter shorcode [smsgateway24/] or [smsgateway24country/] use

********************************
shorcode plugin for single country [smsgateway24/]
shorcode plugin with country list [smsgateway24country/]
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

$codesms = rand(1000,9999);


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
smssend.html - file Phone number input field
--------------------------------------------------------------------------------
What adjustments can be made to work

The script displays the phone number (you can replace or add a mask to the list depending on your country)


**********************************************************************************************************


smssend1.html - file Phone number input field
--------------------------------------------------------------------------------
What adjustments can be made to work

lines 22 - 25 и lines 69 - 80

example

enter  <option value="short alphabetic country code such as /case/">Country name + country code digits are the same as in /.mask/"</option>
enter case "short alphabetic country code"
enter mask("+xx(xx) xxxx-xxxxx" the mask of the phone number display type for the country
 
 <option value="ger">Germany +49</option>
    case "ger":
          $("#input-callback-phone").mask("+49(999) 999-99999");
          break;

**********************************************************************************************************


smsver.php - file verification of the code from the sms
--------------------------------------------------------------------------------
What adjustments can be made to work

line 86

header('Location: '.$url_new_pg_db_row);

If you uncomment it and insert your own php code, then after a successful code confirmation from the sms it will be possible to
execute your command

line 128

header('Location: '.$url_new_pg_db_row);

If you uncomment it and insert your own php code, then after a successful code confirmation from the sms it will be possible to
execute your command


**********************************************************************************************************

index.html - file to work without shorcode
index1.html - file to work without shorcode country list

smssend.html - Phone number entry
smssend1.html - Phone number entry country list

inputcode.html - file to enter the verification code

If you uncomment it and insert your own php code, then after a failed code confirmation from the sms it will be possible to

example Link

wp-content/plugins/smssendver/index.html

**********************************************************************************************************
