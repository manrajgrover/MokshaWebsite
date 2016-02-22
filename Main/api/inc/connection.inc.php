<?php
	$connect_error = 'Could not connect';
	$mysql_host = 'localhost';
	$mysql_user = 'csinseew_moksha6';
	$mysql_pass = 'heavyscene_2016';
	$mysql_data = 'csinseew_moksha';
	
	if(!$connection = mysqli_connect($mysql_host , $mysql_user , $mysql_pass, $mysql_data))
		die(mysqli_error($connection));
?>
