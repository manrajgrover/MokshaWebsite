<?php
/**
 * @Author: Prabhakar Gupta
 * @Date:   2016-02-21 15:22:42
 * @Last Modified by:   Prabhakar Gupta
 * @Last Modified time: 2016-02-21 15:36:51
 */

require_once '../inc/connection.inc.php';
require_once '../inc/function.inc.php';

$final_response = array();

$query = "SELECT * FROM `event_categories` ORDER BY `event_category_name`";
$query_run = mysqli_query($connection, $query);

while($query_row = mysqli_fetch_assoc($query_run)){
	$temp_array = array(
		'id'	=> (int)$query_row['event_category_id'],
		'name'	=> clean_string($query_row['event_category_name']),
	);
	array_push($final_response, $temp_array);
}

echo json_encode($final_response);
