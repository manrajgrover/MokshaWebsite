<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel | Moksha'16</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
	<div class="container">
		<div class="dropdown">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Event<span class="caret"></span></button>
			<ul class="dropdown-menu">
				<?php
					echo "Haha";
					$query = "SELECT * FROM `events`;";
					$result = mysqli_query($connection, $query));
					var_dump($result);
					$i=0;
					while($row = $result->fetch_assoc()){
						$i++;
						echo '<li><a href="index.php?event=$i">$row['event_name']</a></li>';
					}
				?>
			</ul>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</body>
</html>