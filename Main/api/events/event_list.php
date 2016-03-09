<?php
/**
 * @Author: Prabhakar Gupta
 * @Date:   2016-02-21 15:22:42
 * @Last Modified by:   Prabhakar Gupta
 * @Last Modified time: 2016-02-21 15:36:51
 */

require_once '../inc/connection.inc.php';
require_once '../inc/function.inc.php';

$final_response = null;

/*$category_id = (int)$_GET['category'];*/
//WHERE `event_category`='$category_id'  ORDER BY `event_name`
$event_id = $_GET['event_id'];

$query = "SELECT * FROM `events` WHERE `event_id`=$event_id";
$query_run = mysqli_query($connection, $query);

while($query_row = mysqli_fetch_assoc($query_run)){
	$image_url = ($query_row['image'] == '') ? null : decryptText($query_row['image']);

	$final_response = array(
		'id'			=> (int)$query_row['event_id'],
		'name'			=> decryptText($query_row['event_name']),
		'image_url'		=> $image_url,
		'description'	=> decryptText($query_row['descp']),
		'date'			=> timestamp_to_date($query_row['date']),
		'rules'     	=> decryptText($query_row['rules']),
		'prizes'		=> decryptText($query_row['prizes']),
		'over'			=> (bool)$query_row['registration_over'],
		//'team_size'		=> (int)$query_row['team_size'],
	);
	//array_push($final_response, $temp_array);
}

echo json_encode($final_response);

?>
