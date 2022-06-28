
ПЛАГИН FOR WORDPRESS SMS OTP for SmsGateWay 24

Installation via file manager:

1. Unzip the smssendver.zip archive to wp-content/plugins/
2. In the Plugins section, find /SMS OTP for SmsGateWay 24/ and press /Activate/
3. In the section /Settigns/ find /SmsGateWay24 Plugin/ - This is the admin panel for the general settings of the plugin SmsGateWay24
4. Enter shorcode [smsgateway24/] for usage
 

Installation via the admin panel  WORDPRESS:
 
1. Enter in the section /Плагины/
2. Press section /Добавить новый/
3. Press button /Загрузить плагин/
4. Press button /Обзор.../
5. Upload archive smssendver.zip
6. Press button /Activate/
7. In the section /Settigns/ find /SmsGateWay24 Plugin/ - This is the admin panel for the general settings of the plugin SmsGateWay24
8. Enter shorcode [smsgateway24/] and use it



********************************
shorcode plugin [smsgateway24/]
********************************


smssend.php - file with the code to send sms
--------------------------------------------------------------------------------
What adjustments can be made to work

line 14

$selsim = 0 // 0 or 1

example

$selsim = 0;
$selsim = 1;

или

line 128

"sim" => $selsim, //sim card number 0 or 1 depends on the number in the smartphone

example

"sim" => 0,
"sim" => 1,


line 15

$codesms = rand(1000,9999); //Random code generator to send SMS
(IF I ADD NUMBER OF DIGITS IN $codesms = rand(1000,9999); IN 1000 ADD 0, AND 9 TO 9999, THEN THE LONGER CODE IN THE SMS WILL BE LARGER)

example

$codesms = rand(10000,99999);


**********************************************************************************************************


smssend.html - Phone number input field
--------------------------------------------------------------------------------
What adjustments can be made to work

The script displays the phone number (you can replace or add a mask to the list depending on your country)


lines 22 - 25 и lines 69 - 80

example

enter  <option value="short alphabetic country code are the same as in /case/">The country name + country code digits are the same as in /.mask/"</option>
enter case "short alphabetic country code"
enter mask("+xx(xx) xxxx-xxxxx" the mask of the phone number display type for the country

 
 <option value="ger">Germany +49</option>
 
   case "ger":
          $("#input-callback-phone").mask("+49(999) 999-99999");
          break; 


**********************************************************************************************************


smsver.php - SMS code verification file
--------------------------------------------------------------------------------
What adjustments can be made to work

line 86

header('Location: '.$url_new_pg_db_row);

If you uncomment it and insert your own php code, then after a successful code confirmation from the sms it will be possible to
execute your command

line 128

header('Location: '.$url_new_pg_db_row);

If you uncomment it and insert your own php code, then after a failed code confirmation from the sms it will be possible to
execute your command


**********************************************************************************************************

index.html - file to work without shorcode
smssend.html - phone number input file
inputcode.html - verification code input file

(install on any link and they will work on their own without shorcode, you need to add your code to make the files work correctly)

example links

wp-content/plugins/smssendver/index.html

**********************************************************************************************************











