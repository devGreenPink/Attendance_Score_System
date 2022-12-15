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

$sql_full_score="UPDATE `full_score` SET `f_keep`='".$_POST["score_keep"]."',`f_midterm`='".$_POST["score_midterm"]."',`f_final`='".$_POST["score_final"]."',`f_sum`='100' WHERE `cid`='$hidden_cid' ;";
//echo $sql_full_score;
$db_conn->query($sql_full_score)or die ("Query failed: " . $sql_full_score. "<br><br>"); 

//score
$s_keep=$_POST["f_keep"];
$s_midterm=$_POST["f_midterm"];
$s_final=$_POST["f_final"];
$s_sum=$_POST["f_summary"];

//array_student
$hidden_std_id= $_POST["hidden_sid"];


for($i=0;$i<count($hidden_std_id);$i++)
{
    $sql="UPDATE `score` SET `keep`='$s_keep[$i]',`k_status`='".$_POST["s_keep"]."',`midterm`='$s_midterm[$i]',`m_status`='".$_POST["s_midterm"]."',`final`='$s_final[$i]',`f_status`='".$_POST["s_final"]."',`sum`='$s_sum[$i]',`s_status`='".$_POST["s_summary"]."' WHERE `cid`='$hidden_cid' AND`sid`='$hidden_std_id[$i]' ;";
    //echo $sql."<br>";
    $db_conn->query($sql)or die ("Query failed: " . $sql. "<br><br>"); 
}
echo"<meta http-equiv='Refresh' content='0;url=form_score_main.php'>\n";
?>