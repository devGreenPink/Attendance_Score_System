<?php
session_save_path("./session");	
session_start(); 
include_once("check_sesstion_timeout.php");

if (!isset($_SESSION["student_firstname"])&&!isset($_SESSION["student_lastname"])) {
	echo "<meta http-equiv='Refresh' content='0;url=index.html'>";
}

include_once("db_connect.php");
//time_zone
date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d');

//html
echo "<html>\n";
echo "<title>สถิติคะแนน</title>\n";
echo "<link rel='icon' type='image/x-icon' href='./image/checked.png'>\n";
//head
echo "<head>\n";
echo "<style>\n";
echo "body{padding:0;margin:0;box-sizing:border-box;}\n";
echo "th,td{text-align:center;}\n";
//head data

//data
echo ".styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}\n";
echo ".styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}";
echo ".styled-table th,
.styled-table td {
    padding: 12px 15px;
}\n";
echo ".styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

}\n";
echo "</style>\n";
echo "</head>\n";
//head

echo "<table  class='styled-table' width='30%' style='margin-top:3rem; border: none;'>\n";

//table couse

echo "<tbody>\n";
echo "<tr><th  class='header' style=' width:100px; background-color: #009879;color: #ffffff; text-align:left;'>รหัสวิชา</th><th style='text-align:left;'>". $_GET["cid"]."</th></tr>\n";
echo "<tr><th style='width:100px; background-color: #009879;color: #ffffff; text-align:left;'>ชื่อวิชา</th><th style='text-align:left; '>วิชา". $_GET["cname"]."</th></tr>\n";
echo "<tr><th style='width:100px; background-color: #009879;color: #ffffff; text-align:left;'>ผู้สอน</th><th style='text-align:left;'>". $_GET["tfirstname"]." ".$_GET["tlastname"]."</th></tr>\n";
echo "<tr><th style='width:100px; background-color: #009879;color: #ffffff; text-align:left;'>ปีการศึกษา</th><th style='text-align:left;'>".$_GET["year"] ."</th></tr>\n";
echo "<tr><th style='width:100px; background-color: #009879;color: #ffffff; text-align:left;'>เทอม</th><th style='text-align:left;'>". $_GET["term"]."</th></tr>\n";
echo "<tr><th style='width:100px; background-color: #009879;color: #ffffff; text-align:left;'>กลุ่มเรียน</th><th style='text-align:left;'>". $_GET["sec"]."</th></tr>\n";
echo "<tr><th style='width:100px; background-color: #009879;color: #ffffff; text-align:left;'>รหัสนักศึกษา</th><th style='text-align:left;'>". $_GET["sid"]."</th></tr>\n";
echo "<tr><th style='width:100px; background-color: #009879;color: #ffffff; text-align:left;'>ชื่อ</th><th style='text-align:left;'>". $_GET["sfirstname"]."</th></tr>\n";
echo "<tr><th style='width:100px; background-color: #009879;color: #ffffff; text-align:left;'>สกุล</th><th style='text-align:left;'>". $_GET["slastname"]."</th></tr>\n";
echo "<tbody>\n";
echo "</table>\n";
echo "<hr class='glow'>\n";

$sql="SELECT * FROM `score` NATURAL JOIN full_score WHERE sid='".$_SESSION["student_id"]."' AND cid='".$_GET["cid"]."';";
//echo $sql;

$rs = $db_conn->query($sql)
	or die ("Query failed: " . $sql . "<br><br>");

//body
echo "<body>\n";
include_once("header.php");


//table
echo "<table  class='styled-table' width='100%' '>\n";

//head -table
echo "<thead>\n";
echo "<tr>\n";
echo "<th></th>\n";
echo "<th> คะแนนที่ได้ </th>\n";
echo "<th> คะแนนเต็ม </th>\n";

echo "<tr>\n";
echo "</thead>\n";

if($rs->num_rows>0)
{
    $keep_score=0;
    $midterm_score=0;
    $final_score=0;

    $row=$rs->fetch_assoc();
    if($row["k_status"]=='1')
    {
        echo "<tr><td>คะแนนเก็บ</td><td>".$row["keep"]."</td><td>".$row["f_keep"]."</td></tr>\n";
        $keep_score=$row["keep"];
    }else
    {
        echo "<tr><td>คะแนนเก็บ</td><td>"."ไม่เปิดเผย"."</td><td>".$row["f_keep"]."</td></tr>\n";
    }

    if($row["m_status"]=='1')
    {
        echo "<tr><td>กลางภาค</td><td>".$row["midterm"]."</td><td>".$row["f_midterm"]."</td></tr>\n";
        $midterm_score=$row["midterm"];
    }else
    {
        echo "<tr><td>กลางภาค</td><td>"."ไม่เปิดเผย"."</td><td>".$row["f_midterm"]."</td></tr>\n";
    }

    if($row["f_status"]=='1')
    {
        echo "<tr><td>ปลายภาค</td><td>".$row["final"]."</td><td>".$row["f_final"]."</td></tr>\n";
        $final_score=$row["final"];
    }else
    {
        echo "<tr><td>ปลายภาค</td><td>"."ไม่เปิดเผย"."</td><td>".$row["f_final"]."</td></tr>\n";
    }

    if($row["s_status"]=='1')
    {
        $score_rs=$keep_score+$midterm_score+$final_score;
        echo "<tr><td>รวมคะแนน</td><td>".$score_rs."</td><td>".$row["f_sum"]."</td></tr>\n";
    }else
    {
        echo "<tr><td>รวมคะแนน</td><td>"."ไม่เปิดเผย"."</td><td>".$row["f_sum"]."</td></tr>\n";
    }
   
    echo "</tbody>\n";
    echo "</table>\n";
    
    echo "&nbsp<a href='student_main.php'><img src='./image/left-arrow.png' width='50px' ></a>\n";
}else
{
    echo "<table>\n";
    echo "<tr><td style='color:red' >ไม่พบข้อมูล !!!.!!!</td></tr>\n";
    echo"<meta http-equiv='Refresh' content='3;url=student_main.php'>\n";
    echo "</table>\n";
}



echo "</body>\n";
//body
echo "</html>\n";
//html


?>