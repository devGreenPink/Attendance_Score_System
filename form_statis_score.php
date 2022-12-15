<?php
session_save_path("./session");	
session_start(); 
include_once("check_session_timeout.php"); 

if (!isset($_SESSION["teacher_firstname"])&&!isset($_SESSION["teacher_lastname"])) {
	echo "<meta http-equiv='Refresh' content='0;url=index.html'>";
}



include_once("db_connect.php");

//html
echo "<html>\n";
date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d');

//head
echo "<head>\n";
echo "<title>สรุปคะแนน</title>\n";
echo "<link rel='icon' type='image/x-icon' href='./image/checked.png'>\n";
echo "<style>\n";
echo "body{padding:0;margin:0;box-sizing:border-box;}\n";
echo "th,td{text-align:center; font-size:25px}\n";
echo ".label {
    color: white;
    padding: 8px;
    font-family: Arial;
  }
  .full_keep {background-color: #04AA6D;} 
  .full_midterm {background-color: #2196F3;} 
  .full_final {background-color: #ff9800;} 
  .full_sum {background-color: #f44336;} 
  \n";
echo "</style>\n";
//head



//body
echo "<body>\n";
include_once("header.php");

echo "<table width='40%' style='margin-top:1.1rem;'>\n";
echo "<tr><th style='text-align:left;'>รหัสวิชา</th><th style='text-align:left;'>". $_GET["cid"]."</th></tr>\n";
echo "<tr><th style='text-align:left;'>ชื่อวิชา</th><th style='text-align:left;'>วิชา". $_GET["cname"]."</th></tr>\n";
echo "<tr><th style='text-align:left;'>ปีการศึกษา</th><th style='text-align:left;'>".$_GET["cyear"] ."</th></tr>\n";
echo "<tr><th style='text-align:left;'>เทอม</th><th style='text-align:left;'>". $_GET["cterm"]."</th></tr>\n";
echo "<tr><th style='text-align:left;'>กลุ่มเรียน</th><th style='text-align:left;'>". $_GET["csec"]."</th></tr>\n";

$sql_full_score="SELECT f_keep,f_midterm,f_final FROM `full_score` WHERE cid='". $_GET["cid"]."';";
//echo $sql_full_score;

$fullScore=$db_conn->query($sql_full_score)
	or die ("Query failed: " . $sql_full_score . "<br><br>");
$fs_row=$fullScore->fetch_assoc();

$full_keep=$fs_row["f_keep"];
$full_midterm=$fs_row["f_midterm"];
$full_final=$fs_row["f_final"];
 
echo "<tr><th style='text-align:left;'>คะแนนเก็บ</th><th style='text-align:left;'>". "<p class='label full_keep' style='width:30px; '>$full_keep</p>"."</th></tr>\n";
echo "<tr><th style='text-align:left;'>คะแนนกลางภาค</th><th style='text-align:left;'>". "<p class='label full_midterm' style='width:30px; '>$full_midterm</p>"."</th></tr>\n";
echo "<tr><th style='text-align:left;'>คะแนนปลายภาค</th><th style='text-align:left;'>". "<p class='label full_final' style='width:30px; '>$full_final</p>"."</th></tr>\n";

echo "</table><hr>\n<br><br>";

//sql
$sql="SELECT sid,firstname,lastname,keep,k_status,midterm,m_status,final,f_status,sum,s_status FROM `course` NATURAL JOIN register NATURAL JOIN student NATURAL JOIN score WHERE cid='".$_GET["cid"]."';";
//echo $sql;

$rs = $db_conn->query($sql)
	or die ("Query failed: " . $sql . "<br><br>");

//count input number
$i=0;

if($rs->num_rows>0)
{
    //table
    echo "<table width='100%'>\n";

    //head -table
    echo "<tr>\n";
    
    echo "<th > รหัสนักศึกษา </th>\n";
    echo "<th > ชื่อ </th>\n";
    echo "<th > นามสกุล </th>\n";
    echo "<th> คะแนนเก็บ </th>\n";
    echo "<th> กลางภาค </th>\n";
    echo "<th> ปลายภาค </th>\n";
    echo "<th> รวมคะแนน </th>\n";
    echo "<tr>\n";

    echo "<tr>\n";
    echo "<th></th>\n";
    echo "<th></th>\n";
    echo "<th></th>\n";
    echo "<th> <label >$full_keep</label></th>\n";
    echo "<th> <label >$full_midterm</label></th>\n";
    echo "<th> <label >$full_final</label></th>\n";
    echo "<th> 100 </th>\n";
    
    echo "<tr>\n";

    while($row=$rs->fetch_assoc())
    {
        
       
            echo "<tr>\n";
            echo "<input type='hidden'  name='hidden_sid[]' value='".$row["sid"]."' >\n";
            echo "<td>".$row["sid"]."</td>\n";
            echo "<td style='text-align:left;'>".$row["firstname"]."</td>\n";
            echo "<td style='text-align:left;'>".$row["lastname"]."</td>\n";
            echo "<td align='center'>"."<p class='label full_keep'>".$row["keep"]."</p>"."</td>\n";
            echo "<td align='center'>"."<p class='label full_midterm'>".$row["midterm"]."</p>"."</td>\n";
            echo "<td align='center'>"."<p class='label full_final'>".$row["final"]."</p>"."</td>\n";
            echo "<td align='center'>"."<p class='label full_sum'>".$row["sum"]."</p>"."</td>\n";
            
            $i++;
            echo "</tr>\n";
            
    }
   
 

    
    echo "</table>\n";
    echo "<br>\n";
    echo "&nbsp<a href='form_statis_score_main.php'><img src='./image/left-arrow.png' width='50px' ></a>\n";
    
}else
{
    echo "<table>\n";
    echo "<tr><td style='color:red' >ไม่พบข้อมูล.!!!</td></tr>\n";
    echo "</table>\n";
    echo"<meta http-equiv='Refresh' content='2;url=form_statis_score_main.php'>\n";
}
echo "</body>\n";
//body
echo "</html>\n";
//html


?>