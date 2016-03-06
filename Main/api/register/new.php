<?php
/**
 * @Author: Prabhakar Gupta
 * @Date:   2016-02-21 15:22:42
 * @Last Modified by:   ManrajGrover
 * @Last Modified time: 2016-03-05 13:04:57
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
		$query = "INSERT INTO `event_registration` (`event_id`,`user_id`,`timestamp`) VALUES ('$event_id', '$user_id','$current_timestamp');";
		$getDataQuery = "SELECT event_name, rules FROM events WHERE event_id='$event_id'";
		$getUserDataQuery = "SELECT name, email FROM users WHERE user_id='$user_id'";
		$success = (bool)mysqli_query($connection, $query);
		$getDataSuccess = mysqli_query($connection, $getDataQuery);
		$getUserDataSuccess = mysqli_query($connection, $getUserDataQuery);
		$getData = $getDataSuccess->fetch_assoc();
		$getUserData = $getUserDataSuccess->fetch_assoc();
		$name = $getUserData["name"];
		$name = ucwords($name);
		$email = $getUserData["email"];
		$event_name = $getData["event_name"];
		$rules = $getData["rules"];
		$to = "$email";
        $subject = "Event Registration | Moksha 2016";
        if(empty($rules)){
        	$message ="<p>Dear $name,<br><br>You have successfully registered for the event <b>$event_name</b>. Please visit the event page on Facebook for more information.<br><br>";
        }
        else{
        	$message ="<p>Dear $name,<br><br>You have successfully registered for the event <b>$event_name</b>. Please read the rules carefully and also visit the event page on Facebook for more information.<br><br>";
        	$message = $message."Rules:<br><br>";
        	$rules = nl2br(decryptText($rules));
        	$message = $message.$rules;
        }
        $from = "ca.moksha@gmail.com";
        $headers = "From: $from"."\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n";
        mail($to,$subject,$message,$headers);
	}

}

if((bool)$success==false)
$already = 2;

$final_response = array(
	'errcode'	=> $already,
);
echo json_encode($final_response);

?>
