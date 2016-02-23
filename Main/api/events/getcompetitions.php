<?php
/**
 * @Author: Mayank Badola
 * @Date:   2016-02-23 19:25:42
 * @Last Modified by:   Mayank Badola
 * @Last Modified time: 2016-02-23 19:25:42
 */

 require_once '../inc/connection.inc.php';
 require_once '../inc/function.inc.php';

 $final_response = array(
   "Music"     => array(),
   "Theatre"   => array(),
   "Dance"     => array(),
   "Lifestyle" => array(),
   "Finearts"  => array(),
   "Online"    => array()
 );

 $query = "SELECT * FROM `event-id-category`";
 $query_run = mysqli_query($connection, $query);

 while($query_row = mysqli_fetch_assoc($query_run)){
   $temp_array = array(
 		'id'	=> (int)$query_row['event_id'],
 		'name'	=> $query_row['event_name'],
 	);
 	array_push($final_response[$query_row['event_category']],$temp_array);
 }

 echo json_encode($final_response);

?>
