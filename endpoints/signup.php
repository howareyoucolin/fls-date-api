<?php

if( isset($_POST['wechat']) ){
	
	global $wpdb;
	
	$data = json_encode( $_POST );
	
	$wpdb->query(
		$wpdb->prepare("
			INSERT INTO cz_signups (content)
			VALUES ('%s')
		", $data)
	);
	
	$wechat = $_POST['wechat'];

	//Email Notification:
	$message = "You got a new sign up : $data";

	// send email
	mail("howareyoucolin@gmail.com", "New Wechat SignUp : $wechat", $message);

	header('Location: https://www.flushingdating.com/thankyou?wechat=' . $wechat);
	exit(0);

}