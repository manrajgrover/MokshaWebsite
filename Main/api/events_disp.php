<?php
include_once('inc/connection.php');

$result =mysql_query("SELECT * FROM events")
$output=array();
$exists = mysql_num_rows($result);
if($exists>0){
while($row = mysql_fetch_array($result, MYSQL_ASSOC))) 
{
	array_push($output,$row);
}
}
echo json_encode($output);  //display all events and its details from db
?>