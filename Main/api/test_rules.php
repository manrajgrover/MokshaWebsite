<?php
/**
 * @Author: ManrajGrover
 * @Date:   2016-03-05 12:55:33
 * @Last Modified by:   ManrajGrover
 * @Last Modified time: 2016-03-05 13:04:29
 */
	require_once 'inc/connection.inc.php';
	require_once 'inc/function.inc.php';
	$getDataQuery = "SELECT event_name, rules FROM events WHERE event_id='8'";
	$getDataSuccess = mysqli_query($connection, $getDataQuery);
	$getData = $getDataSuccess->fetch_assoc();
	var_dump(nl2br(decryptText($getData["rules"])));
?>