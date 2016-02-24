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
