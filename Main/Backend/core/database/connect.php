<?php
$conn_error = 'Sorry, could not connect to the database.';
mysql_connect('localhost','root','') or die($conn_error);
mysql_select_db('login-register') or die($conn_error);
?>
