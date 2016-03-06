<?php
	session_start();
	require_once '../api/inc/connection.inc.php';
	require_once '../api/inc/function.inc.php';
	if(!isset($_SESSION["hash"])){
		header('Location: login.php');
	}
	else if(isset($_SESSION["hash"]) && $_SESSION["hash"]!="d652f4e3f75d7946f38eac0dccc36356e755a908" ){
		header('Location: login.php');
	}
	if(!isset($_GET["event"])){
		$_SESSION['id'] = -1;
		header('Location: index.php?event=1');
	}
	$number = clean_string($_GET['event']);
	$_SESSION['id'] = $number;
	if(isset($_POST['submit']) && !($_SESSION['id'] == -1)){
		$name = mysqli_real_escape_string($connection,$_POST['event_name']);
		$prizes = mysqli_real_escape_string($connection,$_POST['event_prizes']);
		$descp = mysqli_real_escape_string($connection,$_POST['event_description']);
		$rules = mysqli_real_escape_string($connection,$_POST['event_rules']);
		$sql = "UPDATE `events` SET `event_name`='".$name."',`descp`='".$descp."',`rules`='".$rules."',`prizes`='".$prizes."' WHERE `event_id`=".$number.";";
		$result = mysqli_query($connection,$sql);
	}
	$query = "SELECT event_name, descp, rules, prizes FROM `events` WHERE event_id=".$number.";";
	$saveResult = mysqli_query($connection,$query);
	$details = $saveResult->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel | Moksha'16</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php">Admin Panel</a>
				</div>
				<ul class="nav navbar-nav navbar-right">
					<div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" id="dropDown">Select Event<span class="caret"></span></button>
						<ul class="dropdown-menu" aria-labelledby="dLabel">
							<?php
								$query = "SELECT event_name FROM `events`;";
								$result = mysqli_query($connection,$query);
								$i = 0;
								while($row = $result->fetch_assoc()){
									$i++;
									echo '<li><a href="index.php?event='.$i.'">'.$row["event_name"].'</a></li>';
								}
							?>
						</ul>
					</div>
				</ul>
			</div>
		</nav>
		<form action="" method="POST">
			<div class="form-group">
				<label for="event_name">Event Name</label>
				<input type="text" class="form-control" value="<?php echo htmlspecialchars($details["event_name"]); ?>" name="event_name" id="event_name" placeholder="Event Name">
			</div>
			<div class="form-group">
				<label for="">Description</label>
				<textarea class="form-control" rows="5" name="event_description" id="event_description"><?php echo htmlspecialchars($details["descp"]); ?></textarea>
			</div>
			<div class="form-group">
				<label for="">Rules</label>
				<textarea class="form-control" rows="5" name="event_rules" id="event_rules"><?php echo htmlspecialchars($details["rules"]); ?></textarea>
			</div>
			<div class="form-group">
				<label for="">Prizes</label>
				<input type="text" class="form-control" name="event_prizes" id="event_prizes" value="<?php echo htmlspecialchars($details["prizes"]); ?>" id="event_prizes" placeholder="Event Prizes">
			</div>
			<button type="submit" class="btn btn-default" name="submit" id="submit">Submit</button>
		</form>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/script.js"></script>
</body>
</html>