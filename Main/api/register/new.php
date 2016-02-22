<?php
/**
 * @Author: Prabhakar Gupta
 * @Date:   2016-02-21 15:22:42
 * @Last Modified by:   Prabhakar Gupta
 * @Last Modified time: 2016-02-21 15:36:51
 */

require_once '../inc/connection.inc.php';
require_once '../inc/function.inc.php';

$user_id 	= (int)$_GET['user_id'];
$event_id 	= (int)$_GET['event_id'];
$current_timestamp = time();

$success 	= false;
$user 		= null;

if($user_id > 0){
	$query = "INSERT INTO `event_registration` (`event_id`,`user_id`,`timestamp`) VALUES ('$event_id', '$user_id','$current_timestamp')";
	$success = (bool)mysqli_query($connection, $query);
}


$final_response = array(
	'success' 	=> (bool)$success,
);

echo json_encode($final_response);
