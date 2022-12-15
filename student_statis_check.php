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

//head
echo "<head>\n";
echo "<title>สถิติการเข้าเรียน</title>\n";
echo "<link rel='icon' type='image/x-icon' href='./image/checked.png'>\n";
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


$sql="SELECT check_status,CONCAT(DAY(`date_check`), '/', MONTH(`date_check`), '/', YEAR(`date_check`)+543) AS date FROM `c_check` WHERE sid='".$_SESSION["student_id"]."' AND cid='".$_GET["cid"]."' ORDER BY date_check ;";
//echo $sql;

$rs = $db_conn->query($sql)
	or die ("Query failed: " . $sql . "<br><br>");

//body
echo "<body>\n";
include_once("header.php");


//table
echo "<table  class='styled-table' width='100%' style='margin-top:3rem;'>\n";

//head -table
echo "<thead>\n";
echo "<tr>\n";
echo "<th> วัน/เดือน/ปี </th>\n";
echo "<th> เข้าเรียน </th>\n";
echo "<th> ขาดเรียน </th>\n";
echo "<th> มาสาย </th>\n";
echo "<tr>\n";
echo "</thead>\n";
echo "<hr >\n";
$count_1=0;
$count_0=0;
$count_2=0;
if($rs->num_rows>0)
{
    echo "<tbody>\n";
    while($row=$rs->fetch_assoc())
    {
        
            echo "<tr>\n";
            echo "<td>".$row["date"]."</td>\n";
            if($row["check_status"]=='1')
            {
                echo "<td>"."<img src='./image/check-mark.png' alt='เข้าเรียน' width='50' >"."</td>\n";
                echo "<td></td>\n";
                echo "<td></td>\n";
                $count_1+=1;
            }
            if($row["check_status"]=='0')
            {
                echo "<td></td>\n";
                echo "<td>"."<img src='./image/cross.png' alt='ขาดเรียน' width='50' >"."</td>\n";
                echo "<td></td>\n";
                $count_0+=1;
            }
            if($row["check_status"]=='2')
            {
               
                echo "<td></td>\n";
                echo "<td></td>\n";
                echo "<td>"."<img src='./image/late.png' alt='มาสาย' width='50' >"."</td>\n";
                $count_2+=1;
            }
            echo "</tr>\n";
        
        
       
    }
    echo "<tr>\n";
    echo "<th> รวม</th>\n";
    echo "<th> ".$count_1." </th>\n";
    echo "<th> ".$count_0." </th>\n";
    echo "<th> ".$count_2." </th>\n";
    echo "<tr>\n";
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