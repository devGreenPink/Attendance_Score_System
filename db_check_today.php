<?php
session_save_path("./session");	
session_start(); 
include_once("check_session_timeout.php"); 

if (!isset($_SESSION["techer_firstname"])&&!isset($_SESSION["teacher_lastname"])) {
	echo "<meta http-equiv='Refresh' content='0;url=index.html'>";
}


include_once("db_connect.php");

//format_date
date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d');
$timeStamp=date("Y-m-d H:i:s");

//sid
$hidden_std_id= $_POST["hidden_sid"];

//radio_value_of_sid
$hidden_check_sid=$_POST["hidden_sid"];

for($i=0;$i<count($hidden_std_id);$i++)
{
    //radio_value
    $std_id=$_POST[$hidden_check_sid[$i]];
    //
    $sql="INSERT INTO `c_check`(`cid`, `sid`, `check_status`, `date_check`, `date_save`) VALUES ('" .$_POST["hidden_s_id"]. "','$hidden_std_id[$i]','$std_id','$date','$timeStamp');";
    
    $db_conn->query($sql)or die ("Query failed: " . $sql. "<br><br>"); 

}
echo"<meta http-equiv='Refresh' content='0;url=form_check_main.php'>\n";
?>