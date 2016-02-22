<?php
/**
 * @Author: Prabhakar Gupta
 * @Date:   2016-02-21 15:22:42
 * @Last Modified by:   Prabhakar Gupta
 * @Last Modified time: 2016-02-21 15:36:51
 */

require_once '../inc/connection.inc.php';
require_once '../inc/function.inc.php';

$user_id = intval($_GET['user']);

$success 	= false;
$user 		= null;

if($user_id > 0){
	$query = "SELECT * FROM `users` WHERE `user_id`='$user_id' LIMIT 1";
	$query_row = mysqli_fetch_assoc(mysqli_query($connection, $query));
	
	if(isset($query_row)){
		$success = true;
		$user = array(
			'user_id'	=> (int)$query_row['user_id'],
			'name'		=> clean_string($query_row['name']),
			'college'	=> clean_string($query_row['college']),
		);
	}
}


$final_response = array(
	'success' 	=> (bool)$success,
	'user'		=> $user,
);

echo json_encode($final_response);
