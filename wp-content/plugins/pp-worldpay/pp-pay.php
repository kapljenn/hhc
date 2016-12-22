<?php
	namespace Worldpay;

	require(dirname(__FILE__) . '/lib/Connection.php');
	require(dirname(__FILE__) . '/lib/AbstractAddress.php');
	require(dirname(__FILE__) . '/lib/DeliveryAddress.php');
	require(dirname(__FILE__) . '/lib/BillingAddress.php');
	require(dirname(__FILE__) . '/lib/AbstractOrder.php');
	require(dirname(__FILE__) . '/lib/Order.php');
	require(dirname(__FILE__) . '/lib/APMOrder.php');
	require(dirname(__FILE__) . '/lib/Error.php');
	require(dirname(__FILE__) . '/lib/OrderService.php');
	require(dirname(__FILE__) . '/lib/TokenService.php');
	require(dirname(__FILE__) . '/lib/Utils.php');
	require(dirname(__FILE__) . '/lib/WorldpayException.php');
	require(dirname(__FILE__) . '/lib/Worldpay.php');


	if(get_option('pp_worldpay_api_mode') == 1)
	{
		$strServiceKey = get_option('pp_worldpay_service_key_test');
	}
	else
	{
		$strServiceKey = get_option('pp_worldpay_service_key_live');
	}

	$worldpay = new Worldpay($strServiceKey);
	if(get_option('pp_worldpay_api_mode') == 1)
	{
	 	$worldpay->disableSSLCheck(true);
 	}
 	
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
 	
 	
	$billing_address = array(
		"address1"=>$res16,
		"address2"=>$res17,
		"address3"=> $res18,
		"postalCode"=> $res7,
		"city"=> $res20,
		"state"=> '',
		"countryCode"=> 'GB',
	);

	$intAmount = abs(floor($_POST['pp_amount'])) * 100;



	try {
		$response = $worldpay->createOrder(array(
			'token' => $_POST['token'],
			'amount' => $intAmount,
			'currencyCode' => 'GBP',
			'name' => $res3.' '.$res4,
			'billingAddress' => $billing_address,
			'orderDescription' => 'Order description',
			'customerOrderCode' => 'Order code'
		));

		if ($response['paymentStatus'] === 'SUCCESS') {
			$worldpayOrderCode = $response['orderCode'];

			global $wpdb;

			$payments_table = $wpdb->prefix . 'worldpay_payments';

			$res11 = $response['token'] ? $response['token'] : '';
			$res12 = $response['orderCode'] ? $response['orderCode'] : '';
			$res13 = $response['orderDescription'] ? $response['orderDescription'] : '';
			$res14 = $response['paymentStatus'] ? $response['paymentStatus'] : '';
			$res15 = $response['environment'] ? $response['environment'] : '';


			$sql = $wpdb->prepare(
				"INSERT INTO `$payments_table`      
				   (`title`, `contact_number`, `firstname`, `lastname`, `email`, `postcode`, `informed_by`, `amount`, `gift_aid`, `token`, `orderCode`, `orderDescription`, `paymentStatus`, `environment`, `address_line_1`, `address_line_2`, `address_line_3`, `country`, `city`) 
			 values ('$res1','$res2','$res3','$res4','$res5','$res7','$res8','$res9','$res10','$res11','$res12','$res13','$res14','$res15','$res16','$res17','$res18','$res19','$res20')");
			$wpdb->query($sql);

			require_once( ABSPATH . 'wp-includes/pluggable.php' );

			if(get_option('pp_worldpay_send_mail') == 1)
			{
				$to = $res5;
				$subject = get_option('pp_worldpay_mail_subject');
				$body = get_option('pp_worldpay_mail_body');
				
				$body = str_replace('##FIRSTNAME##', $res3, $body);
				$body = str_replace('##LASTNAME##', $res4, $body);
				$body = str_replace('##AMOUNT##', $res9, $body);
				
				$headers = array('Content-Type: text/html; charset=UTF-8');
 
				wp_mail( $to, $subject, $body, $headers );
			}
			
			wp_redirect( get_option('pp_worldpay_redirect_thankyou') );
			exit;
			

		} else {
			if(get_option('pp_worldpay_debug') == 1)
			{
				throw new WorldpayException(print_r($response, true));
			}
			else
			{
				require_once( ABSPATH . 'wp-includes/pluggable.php' );
				wp_redirect( get_option('pp_worldpay_redirect_error') );
				exit;		
			}
		}
	} catch (WorldpayException $e) {
		if(get_option('pp_worldpay_debug') == 1)
		{
			echo 'Error code: ' .$e->getCustomCode() .'
			HTTP status code:' . $e->getHttpStatusCode() . '
			Error description: ' . $e->getDescription()  . '
			Error message: ' . $e->getMessage();
		}
		else
		{
			require_once( ABSPATH . 'wp-includes/pluggable.php' );
			wp_redirect( get_option('pp_worldpay_redirect_error') );
			exit;				
		}
	} catch (Exception $e) {
		if(get_option('pp_worldpay_debug') == 1)
		{
			echo 'Error message: '. $e->getMessage();
		}
		else
		{
			require_once( ABSPATH . 'wp-includes/pluggable.php' );
			wp_redirect( get_option('pp_worldpay_redirect_error') );
			exit;				
		}
	}