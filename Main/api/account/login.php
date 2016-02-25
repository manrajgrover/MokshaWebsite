<?php
/**
 * @Author: Prabhakar Gupta
 * @Date:   2016-02-21 15:22:42
 * @Last Modified by:   Prabhakar Gupta
 * @Last Modified time: 2016-02-21 15:36:51
 */
session_start();

require_once '../inc/connection.inc.php';
require_once '../inc/function.inc.php';

if(isset($_SESSION['user_id'])){
	echo json_encode(array(
		'success' => true
	));
	die();
}

$success = false;
$user 		= null;
/*$moksha_id = false;
$user_email = false;*/

if((bool)isValidEmail(clean_string($_GET['user_var']))){
	$moksha_id = false;
	$user_email = clean_string($_GET['user_var']);
} else {
	$moksha_id = $_GET['user_var'];
	$user_email = false;
}
$password 	= encrypt_data(clean_string($_GET['pass']));

/*if(!$user_email && type($moksha_id) <= 0){
	//
		echo json_encode(1);
		die();
} else {*/
	if($moksha_id == false){
		$query = "SELECT * FROM `users` WHERE `email`='$user_email' AND `password`='$password' LIMIT 1";
	} else {
		$query = "SELECT * FROM `users` WHERE `mok_id`='$moksha_id' AND `password`='$password' LIMIT 1";
	}
	$query_row = mysqli_fetch_assoc(mysqli_query($connection, $query));

	if(isset($query_row)){
		$_SESSION['user_id']=(int)$query_row['user_id'];

		$success = true;
		$user = array(
			'user_id'	=> (int)$query_row['user_id'],
			'name'		=> clean_string($query_row['name']),
			'college'	=> clean_string($query_row['college']),
		);
	}
//}

$final_response = array(
	'success' 	=> (bool)$success,
	'user'		=> $user,
);

echo json_encode($final_response);

?>
