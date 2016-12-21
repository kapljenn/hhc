<?php

	require(dirname(__FILE__) . '/lib/Connection.php');
	require(dirname(__FILE__) . '/lib/AbstractAddress.php');
	require(dirname(__FILE__) . '/lib/DeliveryAddress.php');
	require(dirname(__FILE__) . '/lib/BillingAddress.php');
	require(dirname(__FILE__) . '/lib/AbstractOrder.php');
	require(dirname(__FILE__) . '/lib/Order.php');
	require(dirname(__FILE__) . '/lib/APMOrder.php');
//	require(dirname(__FILE__) . '/lib/Error.php');
	require(dirname(__FILE__) . '/lib/OrderService.php');
	require(dirname(__FILE__) . '/lib/TokenService.php');
	require(dirname(__FILE__) . '/lib/Utils.php');
	require(dirname(__FILE__) . '/lib/WorldpayException.php');
	require(dirname(__FILE__) . '/lib/Worldpay.php');

	$worldpay = new Worldpay('T_S_225c11e4-18ea-4e76-8f5a-4efd3fbdb9b3');
 	$worldpay->disableSSLCheck(true);
 	
	$billing_address = array(
		"address1"=>'123 House Road',
		"address2"=> 'A village',
		"address3"=> '',
		"postalCode"=> 'EC1 1AA',
		"city"=> 'London',
		"state"=> '',
		"countryCode"=> 'GB',
	);

	$intAmount = abs(floor($_POST['pp_amount'])) * 100;

			$res1 = sanitize_text_field($_POST['pp_title']) ? sanitize_text_field($_POST['pp_title']) : '';
			$res2 = sanitize_text_field($_POST['pp_contact_number']) ? sanitize_text_field($_POST['pp_contact_number']) : '';
			$res3 = sanitize_text_field($_POST['pp_firstname']) ? sanitize_text_field($_POST['pp_firstname']) : '';
			$res4 = sanitize_text_field($_POST['pp_lastname']) ? sanitize_text_field($_POST['pp_lastname']) : '';
			$res5 = sanitize_text_field($_POST['pp_email']) ? sanitize_text_field($_POST['pp_email']) : '';
			$res6 = sanitize_text_field($_POST['pp_postcode']) ? sanitize_text_field($_POST['pp_postcode']) : '';
			$res7 = sanitize_text_field($_POST['pp_informed_by']) ? sanitize_text_field($_POST['pp_informed_by']) : '';
			$res8 = abs((int)sanitize_text_field( $_POST['pp_amount'])) ? abs((int)sanitize_text_field( $_POST['pp_amount'])) : 0;
			$res9 = abs((int)sanitize_text_field( $_POST['pp_giftaid'])) ? abs((int)sanitize_text_field( $_POST['pp_giftaid'])) : 0;
			$res10 = $response['token'] ? $response['token'] : '';
			$res11 = $response['orderCode'] ? $response['orderCode'] : '';
			$res12 = $response['orderDescription'] ? $response['orderDescription'] : '';
			$res13 = $response['paymentStatus'] ? $response['paymentStatus'] : '';
			$res14 = $response['enviroment'] ? $response['enviroment'] : '';

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



			$sql = $wpdb->prepare(
				"INSERT INTO `wp_worldpay_payments`      
				   (`title`, `contact_number`, `firstname`, `lastname`, `email`, `postcode`, `informed_by`, `amount`, `gift_aid`, `token`, `orderCode`, `orderDescription`, `paymentStatus`, `enviroment`) 
			 values ('$res1','$res2','$res3','$res4','$res5','$res6','$res7','$res8','$res9','$res10','$res11','$res12','$res13','$res14')");
			$wpdb->query($sql);
			
			require_once( ABSPATH . 'wp-includes/pluggable.php' );
			wp_redirect( '/donate-2/thankyou' );
			exit;
			

		} else {
			throw new WorldpayException(print_r($response, true));
		}
	} catch (WorldpayException $e) {
		echo 'Error code: ' .$e->getCustomCode() .'
		HTTP status code:' . $e->getHttpStatusCode() . '
		Error description: ' . $e->getDescription()  . '
		Error message: ' . $e->getMessage();
	} catch (Exception $e) {
		echo 'Error message: '. $e->getMessage();
	}