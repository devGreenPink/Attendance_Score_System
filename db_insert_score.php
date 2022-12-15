<?php
session_save_path("./session");	
session_start(); 
include_once("check_session_timeout.php"); 

if (!isset($_SESSION["techer_firstname"])&&!isset($_SESSION["teacher_lastname"])) {
	echo "<meta http-equiv='Refresh' content='0;url=index.html'>";
}


include_once("db_connect.php");

//course
$hidden_cid=$_POST["hidden_cid"];

//score
$s_keep=$_POST["f_keep"];
$s_midterm=$_POST["f_midterm"];
$s_final=$_POST["f_final"];
$s_sum=$_POST["f_summary"];

//array_student
$hidden_std_id= $_POST["hidden_sid"];
$sql_full_score="INSERT INTO `full_score`(`cid`, `f_keep`, `f_midterm`, `f_final`, `f_sum`) VALUES ('$hidden_cid','".$_POST["score_keep"]."','".$_POST["score_midterm"]."','".$_POST["score_final"]."','100');";
//echo $sql_full_score."<br>";
$db_conn->query($sql_full_score)or die ("Query failed: " . $sql_full_score. "<br><br>"); 

for($i=0;$i<count($hidden_std_id);$i++)
{
    $sql="INSERT INTO `score`(`cid`, `sid`, `keep`, `k_status`, `midterm`, `m_status`, `final`, `f_status`, `sum`, `s_status`) VALUES ('$hidden_cid','$hidden_std_id[$i]','$s_keep[$i]','".$_POST["s_keep"]."','$s_midterm[$i]','".$_POST["s_midterm"]."','$s_final[$i]','".$_POST["s_final"]."','$s_sum[$i]','".$_POST["s_summary"]."');";
    //echo $sql."<br>";
    $db_conn->query($sql)or die ("Query failed: " . $sql. "<br><br>"); 
}
echo"<meta http-equiv='Refresh' content='0;url=form_score_main.php'>\n";
?>