<?php
	session_start();
	require_once '../api/inc/connection.inc.php';
	require_once '../api/inc/function.inc.php';
	if(isset($_POST['submit'])){
		$_SESSION['hash'] = $_POST["hash"];
		header('Location: index.php');
	}
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
			</div>
		</nav>
		<form action="" method="POST">
			<div class="form-group">
				<label for="hash">How are you?</label>
				<input type="text" class="form-control" name="hash" id="hash" placeholder="Hmm, sup?">
			</div>
			<button type="submit" class="btn btn-default" name="submit" id="submit">Submit</button>
		</form>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/script.js"></script>
</body>
</html>