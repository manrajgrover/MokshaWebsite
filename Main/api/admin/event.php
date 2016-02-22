<?php

	require_once '../inc/connection.inc.php';
	require_once '../inc/function.inc.php';
	
	if(isset($_POST['submit'])){
		//echo json_encode($_POST);
		//die;
		
		$event_name 		= encryptText($_POST['name']);
		$event_descrption 	= encryptText($_POST['descrption']);
		$event_date 		= strtotime($_POST['date']);
		$event_category 	= intval($_POST['category']);
		$event_image 		= encryptText($_POST['image']);
		$event_team_size 	= intval($_POST['team_size']);
		
		if($event_image == ''){
			$query = "INSERT INTO `events` (`event_name`,`event_category`,`descp`,`date`,`team_size`) VALUES ('$event_name','$event_category','$event_descrption','$event_date','$event_team_size')";
		} else {
			$query = "INSERT INTO `events` (`event_name`,`event_category`,`image`,`descp`,`date`,`team_size`) VALUES ('$event_name','$event_category','$event_image','$event_descrption','$event_date','$event_team_size')";
		}
		
		
		mysqli_query($connection, $query);
	}

?>
<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<title>Moksha 2016 | Add event to backend</title>
</head>
<body>
<hr>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form method="POST">
				<div class="form-group">
					<label for="exampleInputEmail1">Event Name</label>
					<input type="text" name="name" class="form-control">
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Description</label>
					<textarea class="form-control" name="descrption"></textarea>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Date</label>
					<input type="date" name="date" class="form-control" value="2016-03-10">
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Event Category</label>
					<select class="form-control" name="category">
<?php

	$query = "SELECT * FROM `event_categories` ORDER BY `event_category_name`";
	$query_run = mysqli_query($connection, $query);
	
	while($query_row = mysqli_fetch_assoc($query_run)){
		echo '<option value=' . (int)$query_row['event_category_id'] . '>' . strtoupper($query_row['event_category_name']) . '</option>';
	}

?>
					</select>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Event image</label>
					<input type="text" name="image" class="form-control">
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Event Team Size</label>
					<input type="number" name="team_size" class="form-control" value="30">
				</div>
				<button type="submit" name="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
	</div>
</div>
</body>
</html>