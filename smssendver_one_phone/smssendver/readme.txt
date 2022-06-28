
ПЛАГИН ДЛЯ WORDPRESS SMS OTP for SmsGateWay 24

Установка через файл-менеджер:

1. Распакуйте архив smssendver.zip в wp-content/plugins/
2. In the section Плагины find /SMS OTP for SmsGateWay 24/ и Press /Activate/
3. In the section /Settigns/ find /SmsGateWay24 Plugin/ - This is the admin panel for the general settings of the plugin SmsGateWay24
4. Enter shorcode [smsgateway24/] и пользуйтесь
 

Установка через панель администратора WORDPRESS:
 
1. Войдите в раздел /Плагины/
2. Press раздел /Добавить новый/
3. Press button /Загрузить плагин/
4. Press button /Обзор.../
5. Upload archive smssendver.zip
6. Press button /Activate/
7. In the section /Settigns/ find /SmsGateWay24 Plugin/ - This is the admin panel for the general settings of the plugin SmsGateWay24
8. Enter shorcode [smsgateway24/] и пользуйтесь



********************************
shorcode plugin [smsgateway24/]
********************************


smssend.php - файл с кодом отравки смс
--------------------------------------------------------------------------------
What adjustments can be made to work

line 14

$selsim = rand(0,1); //Генератор случайного кода для выбора симкарты (В ЭТОМ МЕСТЕ МОЖНО ЗАМЕНТЬ rand(0,1) НА ЦИФРУ 0 ИЛИ 1 ЗАВИСИТ КАКОЙ СИМКАРТОЙ БУДЕТЕ ПОЛЬЗОВАТЬСЯ )

example

$selsim = 0;
$selsim = 1;

или

line 128

"sim" => $selsim, //номер симкарты 0 или 1 зависит от количиства в смартфоне

example

"sim" => 0,
"sim" => 1,


line 15

$codesms = rand(1000,9999); //Генератор случайного кода для отправки СМС
(ЕСЛИ ДОБАВИТЬ КОЛИЧЕСТВО ЦИФР В $codesms = rand(1000,9999); В 1000 ДОБАВИТЬ 0, А 9 К 9999, ТО ДЛИНА КОДА В СМС СТАНЕТ БОЛЬШЕ)

example

$codesms = rand(10000,99999);


**********************************************************************************************************


smssend.html - файл поле ввода номера телефона
--------------------------------------------------------------------------------
What adjustments can be made to work

line 46

<script>jQuery( function($){$("#input-callback-phone").mask("+9 (999) 999-99-99");});</script>

скрипт отображения номера телефона (можно заменить маску взависимости от вашей страны)

example

mask("+7 (999) 999-99-99")
mask("+99(999) 999-99-99")


**********************************************************************************************************


smsver.php - файл верификации кода из смс
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

index.html - файл для работы без shorcode
smssend.html - файл ввода номера телефона
inputcode.html - файл для ввода кода верификации

(установите на любой ссылку и они будут работать самостоятельно без shorcode, для корректной работы файлов нужно дописать свой код)

example ссылки

wp-content/plugins/smssendver/index.html

**********************************************************************************************************











