<?php
/**
 * Plugin Name: PP World Pay
 * Description: Worldpay integration
 * Version: 1.0.0
 * License: GPL2
 */
 
define( 'PLUGIN_VERSION', '1.0.0' );


global $worldpay_payments_db_version;
$worldpay_payments_db_version = '1.0';

function worldpay_payments_table() {
	global $wpdb;
	global $worldpay_payments_db_version;

	$table_name = $wpdb->prefix . 'worldpay_payments';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE " . $table_name . " (
	paymentID INT NOT NULL AUTO_INCREMENT,
	title VARCHAR(255) NOT NULL,
	contact_number VARCHAR(100) NOT NULL,
	firstname VARCHAR(255) NOT NULL,
	lastname VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	address_line_1 VARCHAR(255) NOT NULL,
	address_line_2 VARCHAR(255) NOT NULL,
	address_line_3 VARCHAR(255) NOT NULL,
	postcode VARCHAR(100) NOT NULL,
	city VARCHAR(100) NOT NULL,
	country VARCHAR(100) NOT NULL,
	informed_by VARCHAR(100) NOT NULL,
	amount INT NOT NULL,
	gift_aid TINYINT(1),
	token VARCHAR(255) NOT NULL,
	orderCode VARCHAR(255) NOT NULL,
	orderDescription VARCHAR(255) NOT NULL,
	paymentStatus VARCHAR(255) NOT NULL,
	environment VARCHAR(255) NOT NULL,
	
	UNIQUE KEY paymentID (paymentID)
	);";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'worldpay_payments_db_version', $worldpay_payments_db_version );
}

register_activation_hook( __FILE__, 'worldpay_payments_table' );




include( dirname( __FILE__ ).'/pp-shortcodes.php');


add_action( 'wp_enqueue_scripts', 'pp_worldpay_styles' );
function pp_worldpay_styles() 
{
	wp_enqueue_style( 'pp-worldpay-style', plugin_dir_url( __FILE__ ).'css/style.css', null, PLUGIN_VERSION );
	wp_register_script( 'pp-worldpay-settings', plugin_dir_url( __FILE__ ).'js/script.js', array('jquery'), true, PLUGIN_VERSION );
	wp_enqueue_script( 'pp-worldpay-settings' );	


}
 
add_action('admin_menu', 'pp_worldpay_menu');
function pp_worldpay_menu() {
   add_menu_page( 'PP WorldPay' , 'PP WorldPay' , 'manage_options' , 'pp-worldpay' , 'pp_worldpay_settings');
   add_submenu_page( 'pp-worldpay' , 'PP WorldPay - Payments', 'Payments' , 'manage_options' , 'pp-worldpay-payments' , 'pp_init_payments');
}

if(!empty($_POST) && $_POST['pp_worldpay_send'] == true)
{
	include( dirname( __FILE__ ).'/pp-pay.php');
}


function pp_worldpay_settings()
{
?>
<div class="wrap">
<h2>PP WorldPay - Settings</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'pp-worldpay-settings' ); ?>
    <?php do_settings_sections( 'pp-worldpay-settings' ); ?>
    <table class="form-table">
        <tr valign="top">
			<th scope="row" colspan="2">API MODE</em></th>
        </tr>

		<tr>
			<td width="150px">
				Enable TEST MODE
			</td>
			<td>
				<input type="checkbox" name="pp_worldpay_api_mode" value="1" <?php if( esc_attr( get_option('pp_worldpay_api_mode') ) == 1) { echo 'checked="checked"'; } ?> />
			</td>
		</tr>


        <tr valign="top">
			<th scope="row" colspan="2">TEST API KEYS</em></th>
        </tr>
			
		<tr>
			<td>
				Service key
			</td>
			<td>
				<input type="text" name="pp_worldpay_service_key_test" style="width: 400px;" value="<?php echo esc_attr( get_option('pp_worldpay_service_key_test') ); ?>" />
			</td>
		</tr>

		<tr>
			<td>
				Client key
			</td>
			<td>
				<input type="text" name="pp_worldpay_client_key_test" style="width: 400px;" value="<?php echo esc_attr( get_option('pp_worldpay_client_key_test') ); ?>" />
			</td>
		</tr>


        <tr valign="top">
			<th scope="row" colspan="2">LIVE API KEYS</em></th>
        </tr>
			
		<tr>
			<td>
				Service key
			</td>
			<td>
				<input type="text" name="pp_worldpay_service_key_live" value="<?php echo esc_attr( get_option('pp_worldpay_service_key_live') ); ?>" />
			</td>
		</tr>

		<tr>
			<td>
				Client key
			</td>
			<td>
				<input type="text" name="pp_worldpay_client_key_live" style="width: 400px;" value="<?php echo esc_attr( get_option('pp_worldpay_client_key_live') ); ?>" />
			</td>
		</tr>

        <tr valign="top">
			<th scope="row" colspan="2">MAIL SETTINGS</em></th>
        </tr>
		<tr>
			<td width="150px">
				Send mail confirmation?
			</td>
			<td>
				<label><input type="checkbox" name="pp_worldpay_send_mail" value="1" <?php if( esc_attr( get_option('pp_worldpay_send_mail') ) == 1) { echo 'checked="checked"'; } ?> /> YES</label>
			</td>
		</tr>
        
		<tr>
			<td>
				Mail subject
			</td>
			<td>
				<input type="text" name="pp_worldpay_mail_subject" style="width: 400px;" value="<?php echo esc_attr( get_option('pp_worldpay_mail_subject') ); ?>" />
			</td>
		</tr>

		<tr>
			<td>
				HTML Mail body<br />
				<em>Variables:</em><br />
				##FIRSTNAME##<br />
				##LASTNAME##<br />
				##AMOUNT##<br />
				<br />
				Example: <em>Hello ##FIRSTNAME## ...</em>
			</td>
			<td>
				<textarea name="pp_worldpay_mail_body" rows="10" cols="80"><?php echo esc_attr( get_option('pp_worldpay_mail_body') ); ?></textarea>
			</td>
		</tr>

        <tr valign="top">
			<th scope="row" colspan="2">REDIRECT SETTINGS</em></th>
        </tr>
		<tr>
			<td>
				Thank you page
			</td>
			<td>
				<input type="text" name="pp_worldpay_redirect_thankyou" style="width: 400px;" value="<?php echo esc_attr( get_option('pp_worldpay_redirect_thankyou') ); ?>" />
			</td>
		</tr>
		<tr>
			<td>
				Error page
			</td>
			<td>
				<input type="text" name="pp_worldpay_redirect_error" style="width: 400px;" value="<?php echo esc_attr( get_option('pp_worldpay_redirect_error') ); ?>" />
			</td>
		</tr>

        <tr valign="top">
			<th scope="row" colspan="2">OTHER SETTINGS</em></th>
        </tr>

			<td width="150px">
				Debug
			</td>
			<td>
				<label><input type="checkbox" name="pp_worldpay_debug" value="1" <?php if( esc_attr( get_option('pp_worldpay_debug') ) == 1) { echo 'checked="checked"'; } ?> /> YES</label>
			</td>

         
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php


}

add_action( 'admin_init', 'pp_worldpay_page_settings' );

function pp_worldpay_page_settings() {
	register_setting( 'pp-worldpay-settings', 'pp_worldpay_api_mode' );

	register_setting( 'pp-worldpay-settings', 'pp_worldpay_service_key_test' );
	register_setting( 'pp-worldpay-settings', 'pp_worldpay_client_key_test' );

	register_setting( 'pp-worldpay-settings', 'pp_worldpay_service_key_live' );
	register_setting( 'pp-worldpay-settings', 'pp_worldpay_client_key_live' );


	register_setting( 'pp-worldpay-settings', 'pp_worldpay_send_mail' );
	register_setting( 'pp-worldpay-settings', 'pp_worldpay_mail_subject' );
	register_setting( 'pp-worldpay-settings', 'pp_worldpay_mail_body' );


	register_setting( 'pp-worldpay-settings', 'pp_worldpay_redirect_thankyou' );
	register_setting( 'pp-worldpay-settings', 'pp_worldpay_redirect_error' );

	register_setting( 'pp-worldpay-settings', 'pp_worldpay_debug' );

}


if($_GET['page'] == 'pp-worldpay-payments')
{
	include( dirname( __FILE__ ).'/include/pp-worldpay-payments.php');
}
