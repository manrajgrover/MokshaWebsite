<?php
	require_once 'inc/connection.inc.php';
	require_once 'inc/function.inc.php';
	$query = "SELECT users.name, users.email FROM `users` INNER JOIN `event_registration` ON users.user_id = event_registration.user_id WHERE event_registration.event_id =7";
	$result = mysqli_query($connection, $query);
	while($row = $result->fetch_assoc()){
		$name = ucwords($row["name"]);
		$email = $row["email"];
		$to = "$email";
		$subject = "[URGENT] Moksha 2016 - Indian Solo";
		$message ="<p>Dear $name,<br><br>
					Rules for Prelims -<br><br>1. Send a 2-3 minute long audio/video clip with the below mentioned details on <b>dhwani.moksha@gmail.com</b>
					<br>- Name
					<br>- College
					<br>- Moksha ID
					<br>- Contact Number
					<br><br>SUBJECT OF THE MAIL SHOUD BE <b>'SAAZ'16 APPLICATION'</b>
					<br><br>2. The application should reach us max by <b>5th March, 18:00.</b>";
		$from = "ca.moksha@gmail.com";
		$headers = "From: $from"."\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n";
		echo $message;
		mail($to,$subject,$message,$headers);
		//var_dump($row);
	}

	//$json = mysqli_fetch_array($result, MYSQLI_ASSOC);
	//var_dump($json);
	//$msg = "Test message";
	//mail("manrajsinghgrover@gmail.com","My subject",$msg);
?>