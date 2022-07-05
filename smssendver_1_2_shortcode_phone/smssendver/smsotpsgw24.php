<?php

/**
 * Plugin Name: SMS OTP for SmsGateWay24
 * Description: Confirming the OTP code by text message via SmsGateWay24 - shorcode [smsgateway24/]
 * Author:      SmsGateWay24
 * Version:     1.0
 */


add_option("smsgateway24plugin_version", "1.0"); // версия plugin

// shorcode plugin [smsgateway24/]


function smsgateway24_func($atts)
{

//header('Location: /wp-content/plugins/smssendver/index.html')

    echo <<<HTML
   </head>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<center>
<h3>Verifying your phone by SMS</h3>
<center>
<center>
    <iframe src="/wp-content/plugins/smssendver/smssend.html" frameborder="0" ></iframe>
<br>
    <iframe src="/wp-content/plugins/smssendver/inputcode.html" frameborder="0" ></iframe>
<center>
<iframe name="ifr" frameborder="0" height="0" width="0" style="visibility:hidden"></iframe>
</body>
</html>
HTML;
//}

}

add_shortcode('smsgateway24', 'smsgateway24_func');


// shorcode plugin [smsgateway24country/]

function smsgateway24country_func($atts)
{

//header('Location: /wp-content/plugins/smssendver/index1.html');

    echo <<<HTML
   </head>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<center>
<h3>Verifying your phone by SMS</h3>
<center>
<center>
    <iframe src="/wp-content/plugins/smssendver/smssend1.html" frameborder="0" ></iframe>
<br>
    <iframe src="/wp-content/plugins/smssendver/inputcode.html" frameborder="0" ></iframe>
<center>
<iframe name="ifr" frameborder="0" height="0" width="0" style="visibility:hidden"></iframe>
</body>
</html>
HTML;
//}

}

add_shortcode('smsgateway24country', 'smsgateway24country_func');


add_action('admin_menu', 'smsgateway24plugin_menu');

function smsgateway24plugin_menu()
{
    add_options_page('SmsGateWay24 Options', 'SmsGateWay24 Plugin', 8, 'smsgateway24', 'smsgateway24plugin_options');
}

function smsgateway24plugin_options()
{
    if (!current_user_can('manage_options')) {
        wp_die(__('Access deny'));
    }
    echo '<div class="wrap">';

    echo "<h3>Settings plugin SmsGateWay24</h3>";
    smsgateway24plugin_change_shop();
}

function smsgateway24plugin_change_shop()
{

    if (isset($_POST['smsgateway24plugin_base_setup_btn'])) {
        if (function_exists('current_user_can') &&
            !current_user_can('manage_options'))
            die (_e('Hacker?', 'smsgateway24plugin'));

        if (function_exists('check_admin_referer')) {
            check_admin_referer('smsgateway24plugin_base_setup_form');
        }


        $smsgateway24plugin_device_id = $_POST['device_id_db'];
        $smsgateway24plugin_db_sim = $_POST['db_sim'];
        $smsgateway24plugin_db_token = $_POST['db_token'];
        $smsgateway24plugin_body_text = $_POST['body_text'];
        $smsgateway24plugin_body_text_1 = $_POST['body_text_1'];
        $smsgateway24plugin_url = $_POST['url_new_pg_db'];
        $smsgateway24plugin_url_kill = $_POST['url_newkill_pg_db'];

        global $wpdb;
        $wpdb->replace('table_smsgateway24_admin', // specify the table

            array('ID' => 1,
                'device_id_db' => $smsgateway24plugin_device_id,
                'db_sim' => $smsgateway24plugin_db_sim,
                'db_token' => $smsgateway24plugin_db_token,
                'body_text' => $smsgateway24plugin_body_text,
                'body_text_1' => $smsgateway24plugin_body_text_1,
                'url_new_pg_db' => $smsgateway24plugin_url,
                'url_newkill_pg_db' => $smsgateway24plugin_url_kill,
                'table_smsgateway24' => 'base_smsgateway24'
            )
        );

        update_option('device_id_db', $smsgateway24plugin_device_id);
        update_option('db_sim', $smsgateway24plugin_db_sim);
        update_option('db_token', $smsgateway24plugin_db_token);
        update_option('body_text', $smsgateway24plugin_body_text);
        update_option('body_text_1', $smsgateway24plugin_body_text_1);
        update_option('url_new_pg_db', $smsgateway24plugin_url);
        update_option('url_newkill_pg_db', $smsgateway24plugin_url_kill);
    }
    echo
        "
		<form name='smsgateway24plugin_base_setup' method='post' action='" . $_SERVER['PHP_SELF'] . "?page=smsgateway24&amp;updated=true'>
	";


    if (function_exists('wp_nonce_field')) {
        wp_nonce_field('smsgateway24plugin_base_setup_form');
    }
    echo
        "
	<table>
	<tr>&nbsp;</tr>

			<tr>
				<td style='text-align:left;'>Device_id:</td>
				<tr>&nbsp;</tr>
				<td><input type='text' name='device_id_db' size='30' value='" . get_option('device_id_db') . "'/></td>
				<td style='color:#666666;'><i>The device ID can be found in your personal cabinet SmsGateWay24.</i></td>
			</tr>
			<tr>
		</table>
		&nbsp;
		<table>
			<tr>
				<td style='text-align:left;'>SIM card number:</td>
				<tr>&nbsp;</tr>
				<td><input type='text' name='db_sim' size='10' value='" . get_option('db_sim') . "'/></td>
				<td style='color:#666666;'><i>Specified in  SmsGateWay24.</i></td>
			</tr>

		</table>
		&nbsp;
		<table>
			<tr>
				<td style='text-align:left;'>Token</td>
				<tr>&nbsp;</tr>
				<td><input type='text' name='db_token' size='90' value='" . get_option('db_token') . "'/></td>
				<td style='color:#666666;'><i>You can find out the token in your personal account of SmsGateWay24.</i></td>
			</tr>

		</table>
		&nbsp;
		<table>
		<tr>
				<td style='text-align:left;'>Body:</td>
				<tr>&nbsp;</tr>
				<td><input type='text' name='body_text' size='180' value='" . get_option('body_text') . " ' /></td>
				<td style='color:#666666;'><i>Enter the text of SMS  before the code.</i></td>
				<tr>&nbsp;</tr>
				<td style='color:#666666;'><i>(example: YOUR SITE - YOUR CODE:  [OTP code])</i></td>
				
			</tr>
		</table>
		&nbsp;
		<table>
		<tr>
				<td style='text-align:left;'>Body:</td>
				<tr>&nbsp;</tr>
				<td><input type='text' name='body_text_1' size='180' value='" . get_option('body_text_1') . " ' /></td>
				<td style='color:#666666;'><i>Enter the text of the SMS For text after the code.</i></td>
				<tr>&nbsp;</tr>
				<td style='color:#666666;'><i>(example: [OTP code] Thank you for choosing us!)</i></td>
				
			</tr>
		</table>
		&nbsp;
		<table>
		<tr>
				<td style='text-align:left;'>Link For going to the page if the code from the SMS matched:</td>
				<tr>&nbsp;</tr>
				<td><input type='text' name='url_new_pg_db' size='180' value='" . get_option('url_new_pg_db') . " ' /></td>
				<td style='color:#666666;'><i>Enter URL.</i></td>
				<tr>&nbsp;</tr>
								
			</tr>
		</table>
		&nbsp;
		<table>
		<tr>
				<td style='text-align:left;'>Link to the page if the code from the SMS did not match:</td>
				<tr>&nbsp;</tr>
				<td><input type='text' name='url_newkill_pg_db' size='180' value='" . get_option('url_newkill_pg_db') . " ' /></td>
				<td style='color:#666666;'><i>Enter URL.</i></td>
				<tr>&nbsp;</tr>
								
			</tr>
		</table>
		&nbsp;
		&nbsp;
		&nbsp;
		<table>
				<tr>
				<td style='text-align:center'>
					<input type='submit' name='smsgateway24plugin_base_setup_btn' value='Save' style='width:140px; height:35px'/>
				</td>
				
			</tr>
			</table>
		
	</form>
	";


    echo "
	<table>
	<td style='text-align:left;'>Your shorcode For adding a plugin: [smsgateway24/]</td>
	<tr>&nbsp;</tr>
	<td style='text-align:left;'>Your shorcode For adding a plugin with country selection: [smsgateway24country/]</td> 
	<td </td>
	<tr>&nbsp;</tr>
	</table>
	";

    echo "<a href='/wp-content/plugins/smssendver/readme.html' >Инструкция</a><br>";

    echo "You can get information about additional settings plugin:</a><br>";
    echo "- SMS code length (4 digits by default)</a><br>";
    echo "- Installation of the telephone number mask For your country (by default the mask (+9 (999) 999-99-99))</a><br>";
    echo "- SIM card selection (random selection between 0 and 1 by default)</a><br>";
    echo "- Replacing the Link redirect with a PHP code after SMS confirmation</a><br>";
    echo "";
    echo "<table>
	<td style='text-align:left; font-style: italic;'>Author plugin: SmsGateWay24</td>
	<td </td>
	<tr>&nbsp;</tr>
	</table>
	";

}

function smsgateway24plugin_install()
{
    global $wpdb;

    $sql1 =
        "
		CREATE TABLE IF NOT EXISTS `table_smsgateway24_admin` (
		  `id` int(10) NOT NULL AUTO_INCREMENT,
		  `db_sim` varchar(10) NOT NULL,
		  `db_token` varchar(250) NOT NULL,
		  `device_id_db` varchar(250) NOT NULL,
		  `body_text` varchar(250) NOT NULL,
		  `body_text_1` varchar(250) NOT NULL,
		  `url_new_pg_db` varchar(250) NOT NULL,
		  `url_newkill_pg_db` varchar(250) NOT NULL,
		  `table_smsgateway24` varchar(250) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;
	";

    $sql2 =
        "
		CREATE TABLE IF NOT EXISTS `base_smsgateway24` (
		  `id` int(10) NOT NULL AUTO_INCREMENT,
		  `phone` varchar(250) NOT NULL,
		  `codesms` varchar(250) NOT NULL,
		  `datetime` varchar(250) NOT NULL,
		   PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;
	";


    $wpdb->query($sql1);
    $wpdb->query($sql2);


    add_option('device_id_db', 'Not set');
    add_option('db_sim', '0');
    add_option('db_token', 'Not set');
    add_option('body_text', 'Not set');
    add_option('body_text_1', '');
    add_option('url_new_pg_db', '');
    add_option('url_newkill_pg_db', '');
    add_option('table_smsgateway24', 'base_smsgateway24');

    $wpdb->insert('table_smsgateway24_admin', // specify the table

        array('ID' => 1,
            'device_id_db' => 'Not set',
            'db_sim' => '0',
            'db_token' => 'Not set',
            'body_text' => 'Not set',
            'body_text_1' => '',
            'url_new_pg_db' => '/',
            'url_newkill_pg_db' => '/',
            'table_smsgateway24' => 'base_smsgateway24'
        )
    );

}

// removing

function smsgateway24plugin_uninstall()
{
    global $wpdb;


    $sql1 = "DROP TABLE `table_smsgateway24_admin`;";
    $sql2 = "DROP TABLE `base_smsgateway24`";

    $wpdb->query($sql1);
    $wpdb->query($sql2);

    delete_option('device_id_db');
    delete_option('db_sim');
    delete_option('db_token');
    delete_option('body_text');
    delete_option('body_text_1');
    delete_option('url_new_pg_db');
    delete_option('url_newkill_pg_db');
    delete_option('table_smsgateway24');
}

register_activation_hook(__FILE__, 'smsgateway24plugin_install');
register_deactivation_hook(__FILE__, 'smsgateway24plugin_uninstall');



