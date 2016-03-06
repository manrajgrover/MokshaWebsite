<?php
/**
 * @Author: Prabhakar Gupta
 * @Date:   2016-02-21 15:22:42
 * @Last Modified by:   Prabhakar Gupta
 * @Last Modified time: 2016-02-21 15:31:53
 */
require_once '../inc/connection.inc.php';
require_once '../inc/function.inc.php';
$name 		= clean_string($_GET['name']);
$email 		= clean_string($_GET['email']);
$send_password = clean_string($_GET['pass']);
$password 	= encrypt_data(clean_string($_GET['pass']));
$phone 		= clean_string($_GET['phone']);
$college 	= clean_string($_GET['college']);
$email_valid = (bool)isValidEmail($email);
$success = false;
$duplicate = false;
$moksha_id = 0;

if($email_valid && !empty($name) && !empty($password) && !empty($phone) && !empty($college)){
	$query = "INSERT INTO `users` (`name`,`email`,`password`,`phone`,`college`) VALUES ('$name','$email','$password','$phone','$college')";
	if(mysqli_query($connection, $query)){
		$success = true;
		$moksha_id = (int)mysqli_insert_id($connection);
		$mok_id = "MOK-" . $moksha_id . "";
		$name = ucwords($name);
		$sql="UPDATE `users` SET `mok_id`='$mok_id'WHERE `email`='$email'";
		mysqli_query($connection,$sql);
		$to = "$email";
        $subject = "Moksha 2016 Registration";
        $message ="<p>Dear $name,<br><br>
        You have successfully registered for Moksha 2016. Your Moksha ID is <b>$mok_id</b> and your password is <b>$send_password</b>.<br><br>You'll need to show the below QR code to the security personnel at Moksha. Please keep it with you at all times.</p>
				<br><img src='https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=$mok_id'/>";
        $from = "ca.moksha@gmail.com";
        $headers = "From: $from"."\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n";
        mail($to,$subject,$message,$headers);
	}
	else {
		$duplicate = true;
	}
}
$final_response = array(
	'success' 		=> (bool)$success,
	'duplicate' 	=> (bool)$duplicate,
	'email_valid' 	=> (bool)$email_valid,
	'moksha_id'		=> (int)$moksha_id,
);
echo json_encode($final_response);
?>
