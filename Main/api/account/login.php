<?php
/**
 * @Author: Prabhakar Gupta
 * @Date:   2016-02-21 15:22:42
 * @Last Modified by:   Prabhakar Gupta
 * @Last Modified time: 2016-02-21 15:36:51
 */

require_once '../inc/connection.inc.php';
require_once '../inc/function.inc.php';

$phone 		= clean_string($_GET['phone']);
$password 	= encrypt_data(clean_string($_GET['pass']));

$query = "SELECT * FROM `users` WHERE `phone`='$phone' AND `password`='$password' LIMIT 1";
$query_row = mysqli_fetch_assoc(mysqli_query($connection, $query));

if(isset($query_row)){
	$success = true;
	$user = array(
		'user_id'	=> (int)$query_row['user_id'],
		'name'		=> clean_string($query_row['name']),
		'college'	=> clean_string($query_row['college']),
	);
} else {
	$success 	= false;
	$user 		= null;
}

$final_response = array(
	'success' 	=> (bool)$success,
	'user'		=> $user,
);

echo json_encode($final_response);
