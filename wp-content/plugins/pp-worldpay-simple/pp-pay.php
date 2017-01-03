<?php 	
	$res1 = sanitize_text_field($_POST['pp_title']) ? sanitize_text_field($_POST['pp_title']) : '';
	$res2 = sanitize_text_field($_POST['pp_contact_number']) ? sanitize_text_field($_POST['pp_contact_number']) : '';
	$res3 = sanitize_text_field($_POST['pp_firstname']) ? sanitize_text_field($_POST['pp_firstname']) : '';
	$res4 = sanitize_text_field($_POST['pp_lastname']) ? sanitize_text_field($_POST['pp_lastname']) : '';
	$res5 = sanitize_text_field($_POST['pp_email']) ? sanitize_text_field($_POST['pp_email']) : '';
	$res7 = sanitize_text_field($_POST['pp_postcode']) ? sanitize_text_field($_POST['pp_postcode']) : '';
	$res8 = sanitize_text_field($_POST['pp_informed_by']) ? sanitize_text_field($_POST['pp_informed_by']) : '';
	$res9 = abs((int)sanitize_text_field( $_POST['pp_amount'])) ? abs((int)sanitize_text_field( $_POST['pp_amount'])) : 0;
	$res10 = abs((int)sanitize_text_field( $_POST['pp_giftaid'])) ? abs((int)sanitize_text_field( $_POST['pp_giftaid'])) : 0;
	$res16 = sanitize_text_field($_POST['pp_address_line_1']) ? sanitize_text_field($_POST['pp_address_line_1']) : '';
	$res17 = sanitize_text_field($_POST['pp_address_line_2']) ? sanitize_text_field($_POST['pp_address_line_2']) : '';
	$res18 = sanitize_text_field($_POST['pp_address_line_3']) ? sanitize_text_field($_POST['pp_address_line_3']) : '';
	$res19 = sanitize_text_field($_POST['pp_country']) ? sanitize_text_field($_POST['pp_country']) : '';
	$res20 = sanitize_text_field($_POST['pp_city']) ? sanitize_text_field($_POST['pp_city']) : '';
 	$res21 = sanitize_text_field($_POST['payment_method']) ? sanitize_text_field($_POST['payment_method']) : '';
 	
	global $wpdb;

	$payments_table = $wpdb->prefix . 'worldpay_payments';

	$res11 = ''; //token
	$res12 = ''; // ordercode
	$res13 = ''; //order description
	$res14 = ''; //payment status
	$res15 = ''; // environment


	$sql = $wpdb->prepare(
		"INSERT INTO `$payments_table`      
		   (`title`, `contact_number`, `firstname`, `lastname`, `email`, `postcode`, `informed_by`, `amount`, `gift_aid`, `token`, `orderCode`, `orderDescription`, `paymentStatus`, `environment`, `address_line_1`, `address_line_2`, `address_line_3`, `country`, `city`) 
	 values ('$res1','$res2','$res3','$res4','$res5','$res7','$res8','$res9','$res10','$res11','$res12','$res13','$res14','$res15','$res16','$res17','$res18','$res19','$res20')", null);
	$wpdb->query($sql);
	$paymentId = $wpdb->insert_id;
	
	require_once( ABSPATH . 'wp-includes/pluggable.php' );

	
	wp_redirect( get_home_url().'/'.get_option('pp_worldpay_redirect_formsubmit').'?amount='.base64_encode($res9).'&pid='.base64_encode($paymentId).'&pid='.base64_encode($paymentId).'&firstname='.base64_encode($res3).'&lastname='.base64_encode($res4).'&address1='.base64_encode($res16).'&address2='.base64_encode($res17).'&address3='.base64_encode($res18).'&town='.base64_encode($res20).'&postcode='.base64_encode($res7).'&tel='.base64_encode($res2).'&email='.base64_encode($res5).'&paymenttype='.base64_encode($res21).'&country='.base64_encode($res19) );
	exit;
	
