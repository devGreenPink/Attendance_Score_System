<?php
session_save_path("./session");	
session_start(); 
include_once("check_sesstion_timeout.php");

require_once("db_connect.php");

$sql="SELECT `tid`,`firstname`,`lastname` FROM `teacher` WHERE `tid`='" .$_POST["f_username"]. "' AND `password`='" .$_POST["f_password"]."';";
//echo $sql;


$rs = $db_conn->query($sql)
	or die ("Query failed: " . $sql . "<br><br>");

if($rs->num_rows == 1) {
	
	$row = $rs->fetch_assoc();
	$_SESSION["teacher_id"]=$_POST["f_username"];
	echo  $_SESSION["teacher_id"];
    $_SESSION["teacher_firstname"] = $row["firstname"];
	echo  $_SESSION["teacher_firstname"]." ";
	$_SESSION["teacher_lastname"] = $row["lastname"];
	echo  $_SESSION["techer_lastname"];
    echo"<meta http-equiv='Refresh' content='0;url=main.php'>\n";

} else { 
	echo "<font color='red'>Invalid username or password.</font>";
}	

?>