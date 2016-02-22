<?php

session_start();
include_once('inc/connection.php');

if(isset($_POST['submit']))
{

$sq="INSERT INTO `moksha`.`team`(`event_id`,`user_id`,`email_id``team_name`)
VALUES('{$_SESSION['event_id']}','{$_SESSION['user_id']}','{$_SESSION['email_id']}',{$_POST['team_name']}')";

mysqli_query($conn,$sq);



foreach(array_combine($_POST['name'],$_POST['mok_id']) as $name=>$mokid)
{
  
$q ="SELECT moksha_id FROM users WHERE username='$name'";

$result=mysqli_query($conn,$q);
if(!$result)
{
	$output="wrong username";
}
else{
while($row = mysqli_fetch_array($result)) 
{
	
	if($row['moksha_id']=='$mokid');
	{
  $query="INSERT INTO `moksha`.`team-users`(`team_name`,`name`,`mok_id`)
    VALUES('{$_SESSION['team_name']}','$name','$mokid')";
    mysqli_query($conn,$query);	
}
else
{
	$output="mismatch username and user id";
}
}
}
}
echo json_encode($output);

}


?>
<!--
	example of form
<html>
<form method="POST">
	Team name:<input type="text" name="team_name" required></input>
	Memeber name:<input type="text" name="name[]"></input>
	Moksha id:<input type="text" name="mok_id[]"></input>
	Memeber name:<input type="text" name="name[]"></input>
	Moksha id:<input type="text" name="mok_id[]"></input>
	Memeber name:<input type="text" name="name[]"></input>
	Moksha id:<input type="text" name="mok_id[]"></input>
	<button type="submit" name="submit">submit</button>
	</form>
</html>
-->