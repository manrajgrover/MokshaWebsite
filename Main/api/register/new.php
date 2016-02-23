<?php
/**
 * @Author: Prabhakar Gupta
 * @Date:   2016-02-21 15:22:42
 * @Last Modified by:   Prabhakar Gupta
 * @Last Modified time: 2016-02-23 14:47:01
 */
session_start();
require_once '../inc/connection.inc.php';
require_once '../inc/function.inc.php';

//$user_id 	= (int)$_GET['user_id'];
if(!isset($_SESSION['user_id'])){
		echo json_encode(array(
			'errcode'   =>   1
		));
		die();
}

$user_id = $_SESSION['user_id'];
$event_id 	= (int)$_GET['event_id'];
$current_timestamp = time();

$success 	= false;
$already 	= 0;
$user 		= null;

if($user_id > 0){
	$query_check = "SELECT `timestamp` FROM `event_registration` WHERE `event_id`='$event_id' AND `user_id`='$user_id' LIMIT 1";
	$query_check_row = mysqli_fetch_assoc(mysqli_query($connection, $query_check));

	if(isset($query_check_row)){
		$already = true;
	} else {
		$query = "INSERT INTO `event_registration` (`event_id`,`user_id`,`timestamp`) VALUES ('$event_id', '$user_id','$current_timestamp')";
		$success = (bool)mysqli_query($connection, $query);
	}

}

if((bool)$success==false)
$already = 2;

$final_response = array(
	'errcode'	=> $already,
);
echo json_encode($final_response);
