<?php
session_save_path("./session");	
session_start(); 
include_once("check_sesstion_timeout.php");

require_once("db_connect.php");

$sql="SELECT `sid`, `firstname`, `lastname` FROM `student` WHERE `sid`='" .$_POST["f_username"]. "' AND `password`='" .$_POST["f_password"]."';";
//echo $sql;


$rs = $db_conn->query($sql)
	or die ("Query failed: " . $sql . "<br><br>");

if($rs->num_rows == 1) {
	
	$row = $rs->fetch_assoc();
	$_SESSION["student_id"]=$_POST["f_username"];
	echo  $_SESSION["student_id"];
    $_SESSION["student_firstname"] = $row["firstname"];
	echo  $_SESSION["student_firstname"]." ";
	$_SESSION["student_lastname"] = $row["lastname"];
	echo  $_SESSION["student_lastname"];
    echo"<meta http-equiv='Refresh' content='0;url=student_main.php'>\n";

} else { 
	echo "<font color='red'>Invalid username or password.</font>";
}	

?>