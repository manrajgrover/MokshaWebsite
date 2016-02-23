<?php
/**
 * @Author: Mayank Badola
 * @Date:   2016-02-23 16:57:00
 * @Last Modified by:   Mayank Badola
 * @Last Modified time: 2016-02-23 15:57:00
 */
session_start();

unset($_SESSION['user_id']);

echo json_encode(array(
  'success' => true
));

?>
