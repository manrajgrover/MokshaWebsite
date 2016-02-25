<?php

require_once '../../inc/connection.inc.php';
require_once '../../inc/function.inc.php';

$message = "Please enter an event ID in URL as ?event=xxx";

$event_id = @(int)$_GET['event'];

if($event_id > 0){
	$query = "SELECT `event_name` FROM `events` WHERE `event_id`='$event_id' LIMIT 1";
	$query_row = mysqli_fetch_assoc(mysqli_query($connection, $query));

	if(isset($query_row)){
		$error = false;
		$event_name = trim($query_row['event_name']);
	} else {
		$error = true;
		$event_name = $message;
	}
} else {
	$error = true;
	$event_name = $message;
}

?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Moksha 2016 | Admin Panel</title>
		<meta name="description" content="Sticky Table Headers Revisited: Creating functional and flexible sticky table headers" />
		<meta name="keywords" content="Sticky Table Headers Revisited" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
	</head>
	<body>
		<div class="container">
			<header>
				<h1><?php echo $event_name; ?></h1>
			</header>
			<div class="component">
<?php
	if(!$error){
?>
				<table>
					<thead>
						<tr>
							<th>#</th>
							<th>Moksha ID</th>
							<th>Name</th>
							<th>College</th>
						</tr>
					</thead>
					<tbody>
<?php
		$query_select = "SELECT R.user_id, U.name, U.college FROM event_registration R INNER JOIN users U ON R.user_id = U.user_id WHERE R.event_id='$event_id' ORDER BY R.timestamp DESC";
		$query_select_run = mysqli_query($connection, $query_select);

		$i = 1;
		while($query_select_row = mysqli_fetch_assoc($query_select_run)){
			echo '<tr>
				<td class="user-name">' . $i++ . '</td>
				<td class="user-email">MOK-' . (int)trim($query_select_row['user_id']) . '</td>
				<td class="user-phone">' . trim($query_select_row['name']) . '</td>
				<td class="user-mobile">' . trim($query_select_row['college']) . '</td>
			</tr>';
		}
?>
					</tbody>
				</table>
<?php
	} else {
		echo '<h2>Invalid Event ID, contact Sir Shwetank for correct event ID<br><br><u>+91 - 99537 85 202</u></h2>';
	}
?>
			</div>
		</div><!-- /container -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
		<script src="js/jquery.stickyheader.js"></script>
	</body>
</html>