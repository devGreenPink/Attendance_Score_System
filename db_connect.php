<?php

$db_host = "localhost";		
$db_user = "miniproject";		
$db_password = "123456";	
$db_name = "miniproject_webprgm";		

$db_conn = new mysqli($db_host,$db_user,$db_password,$db_name);

if ($db_conn->connect_error) {
	die("DB Connection Failed !! " . $db_conn->connect_error);
}
?>
