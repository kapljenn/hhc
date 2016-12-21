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
	postcode VARCHAR(100) NOT NULL,
	informed_by VARCHAR(100) NOT NULL,
	amount INT NOT NULL,
	gift_aid TINYINT(1),
	token VARCHAR(255) NOT NULL,
	orderCode VARCHAR(255) NOT NULL,
	orderDescription VARCHAR(255) NOT NULL,
	paymentStatus VARCHAR(255) NOT NULL,
	enviroment VARCHAR(255) NOT NULL,
	
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
	wp_register_script( 'pp-worldpay-script', 'https://cdn.worldpay.com/v1/worldpay.js', null, PLUGIN_VERSION );
	wp_enqueue_script( 'pp-worldpay-script' );	
	wp_register_script( 'pp-worldpay-settings', plugin_dir_url( __FILE__ ).'js/script.js', array('jquery'), PLUGIN_VERSION );
	wp_enqueue_script( 'pp-worldpay-settings' );	


}
 
add_action('admin_menu', 'pp_worldpay_menu');
function pp_worldpay_menu() {
   add_menu_page( 'PP WorldPay' , 'PP WorldPay' , 'manage_options' , 'pp-worldpay' , 'pp_payments');
   add_submenu_page( 'pp-worldpay' , 'PP WorldPay - Settings', 'Settings' , 'manage_options' , 'pp-worldpay-settings' , 'pp_init_settings');
}

if(!empty($_POST) && $_POST['pp_worldpay_send'] == true)
{
	include( dirname( __FILE__ ).'/pp-pay.php');
}


if($_GET['page'] == 'pp-worldpay')
{
	include( dirname( __FILE__ ).'/include/pp-worldpay-settings.php');
}
if($_GET['page'] == 'pp-worldpay-settings')
{
	include( dirname( __FILE__ ).'/include/pp-worldpay-settings.php');
}
