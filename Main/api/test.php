<?php
	require 'vendor/autoload.php';
	use \Mailjet\Resources;
	$apikey='0a153a3f3b56db3c769d725d7fa37d98';
	$apisecret='f035b40be80e4149c3b0e336cbbce6fc';
	$mj = new \Mailjet\Client(getenv($apikey), getenv($apisecret));
	$body = [
    	'FromEmail' => "spons.moksha@gmail.com",
    	'FromName' => "Mailjet Pilot",
    	'Subject' => "Your email flight plan!",
    	'Text-part' => "Dear passenger, welcome to Mailjet! May the delivery force be with you!",
    	'Html-part' => "<h3>Dear passenger, welcome to Mailjet!</h3><br />May the delivery force be with you!",
    	'Recipients' => [['Email' => "manrajsinghgrover@gmail.com"]]
	];
	$response = $mj->post(Resources::$Email, ['body' => $body])
	/*
	$to = "spons.moksha@gmail.com";
	$subject = "[Entry Procedure] Moksha'16, NSIT";
	$mok_id="MOK-1001";
	$name ="Manraj Singh";
	$message ="<div style='color:black;'>
					<p>Dear $name,<br><br>
					You have successfully registered for Moksha '16, NSIT Delhi. Your Moksha ID is <b>$mok_id</b>.
					<br><br>You'll need to show this mail containing the QR code, your valid college ID & the app downloads below to the security personnel at Moksha for entry & for attending all events. <b>Please keep them with you at all times</b>.
					<br><br>For entry into the college premises, the following apps need to be downloaded & physically verified at the entry gates:
					<br>
					<br>1. <b><u>Loud Shout App</u></b><br><br>
					Download link (Android): http://bit.ly/1W5iHhg
					<br>Download link (iOS): http://goo.gl/Z1ASCu
					<br><br>
					<b>Note</b>: After registering on the Loudshout App, you have to choose '<b>NSIT, Delhi</b>' as your Basecamp.
					<br><br>
					2. <b><u>Faagio</u></b>
					<br>
					Download link (Android): https://goo.gl/hJAoe7
					<br><br>
					<b>Note</b>: After signing up on the Faagio App, you have to enter the referral code <b>nsit2016</b>.
					<br>
					<br><br>
					<b><u>Important</u></b>: Users of phones that do not support these apps would be required to show & verify this fact by displaying their phones at the entry gate.
					<br></div>
					<img src='https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=$mok_id'/>";
	$from = "ca.moksha@gmail.com";
	$headers = "From: $from"."\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n";
	echo $message;
	mail($to,$subject,$message,$headers);*/
?>