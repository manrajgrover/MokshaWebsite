<?php
/**
 * @Author: Prabhakar Gupta
 * @Date:   2016-02-21 15:26:35
 * @Last Modified by:   Prabhakar Gupta
 * @Last Modified time: 2016-02-21 15:26:51
 */

 date_default_timezone_set("Asia/Kolkata");
 
/**
 * returns string which is safe for database and without any spaces
 * @param  string 	$str 	dirty string
 * @param  boolean 	$mode 	if mode is true, then remove white spaces else not
 * @return string 			clean string
 */
function clean_string($str, $mode=false){
	$temp_str = htmlspecialchars(strip_tags(strtolower(trim($str))));

	if($mode)
		return str_replace(" ", "", $temp_str);
	else
		return $temp_str;
}

function encryptText($text){
	return htmlspecialchars(strip_tags(addslashes(trim($text))));
}

function decryptText($text){
	return htmlspecialchars_decode(stripcslashes(trim($text)));
}


/**
 * function to put one way encrption over a string
 * @param  string 	$str 
 * @return string 			encrypted string
 */
function encrypt_data($str){
	return md5($str);
}

function timestamp_to_date($timestamp){
	return date("Y-m-d H:i:s", $timestamp);
}

