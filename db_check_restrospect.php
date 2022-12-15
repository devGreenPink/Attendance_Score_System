<?php
session_save_path("./session");	
session_start(); 
include_once("check_session_timeout.php"); 


if (!isset($_SESSION["techer_firstname"])&&!isset($_SESSION["teacher_lastname"])) {
	echo "<meta http-equiv='Refresh' content='0;url=index.html'>";
}

include_once("db_connect.php");

//format_time_zone
date_default_timezone_set('Asia/Bangkok');
$date = $_POST["date"];
$timeStamp=date("Y-m-d H:i:s");

//sid
$hidden_std_id= $_POST["hidden_std_id"];

//radio_value_of_sid
$hidden_check_sid=$_POST["hidden_std_id"];

//dupicate_check
$sqlDupicate="SELECT * FROM `course`NATURAL JOIN register NATURAL JOIN student NATURAL JOIN c_check  WHERE tid='".$_SESSION["teacher_id"]."' AND cid='".$_POST["hidden_s_id"]."' AND date_check='$date';";

//query_dupicate_check
$rsDupicate=$db_conn->query($sqlDupicate)or die ("Query failed: " . $sqlDupicate . "<br><br>");

if($rsDupicate->num_rows>0)
{
    echo "<p style='color:red;'>คุณได้เช็คชื่อวันนี้ไปแล้ว ไม่สามารถเช็คช้ำได้ !!!</p>\n";
    echo"<meta http-equiv='Refresh' content='2;url=form_check_main.php'>\n";
}
else
{
    for($i=0;$i<count($hidden_std_id);$i++)
{
    //radio_value
    $std_id=$_POST[$hidden_check_sid[$i]];

    //insert_check_
    $sql="INSERT INTO `c_check`(`cid`, `sid`, `check_status`, `date_check`, `date_save`) VALUES ('" .$_POST["hidden_s_id"]. "','$hidden_std_id[$i]','$std_id','".$_POST["date"]."','$timeStamp');";
    
    $db_conn->query($sql)or die ("Query failed: " . $sql. "<br><br>");  
}

echo"<meta http-equiv='Refresh' content='0;url=form_check_main.php'>\n";
}


?>