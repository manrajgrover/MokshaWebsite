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
		$subject = "Registration and Entry Procedure | Moksha'16";
        $message ="<div style='color:black;'>
					<p>Dear $name,<br><br>
					You have successfully registered for Moksha '16, NSIT Delhi. Your Moksha ID is <b>$mok_id</b> and your password is <b>$send_password</b>.
					<br><br>You'll need to show this mail containing the QR code, your valid college ID & the app downloads below to the security personnel at Moksha for entry & for attending all events. <b>Please keep them with you at all times</b>.
					<br><br>For entry into the college premises, the following apps need to be downloaded & physically verified at the entry gates:
					<br>
					<br>1. <b><u>Loud Shout App</u></b><br><br>
					Download link (Android): <a href='http://bit.ly/1W5iHhg'>http://bit.ly/1W5iHhg</a>
					<br>Download link (iOS): <a href='http://goo.gl/Z1ASCu'>http://goo.gl/Z1ASCu</a>
					<br><br>
					<b>Note</b>: After registering on the Loudshout App, you have to choose '<b>NSIT, Delhi</b>' as your Basecamp.
					<br><br>
					2. <b><u>Follo App</u></b>
					<br>
					Download link (Android): <a href='http://bit.ly/1SyAeiO'>http://bit.ly/1SyAeiO</a>
					<br>Download link (iOS): <a href='https://goo.gl/Jo0h2G'>https://goo.gl/Jo0h2G</a>
					<br><br>
					<b>Note</b>: No need for any referral codes, only the app download needs to be displayed.
					<br><br>
					<b><u>Important</u></b>: Users of phones that do not support these apps would be required to show & verify this fact by displaying their phones at the entry gate.
					<br></div>
					<img src='https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=$mok_id'/>";
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
