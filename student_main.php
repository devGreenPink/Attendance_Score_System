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
echo "<title>เมนูหลัก</title>\n";
echo "<link rel='icon' type='image/x-icon' href='./image/checked.png'>\n";
echo "<style>\n";
echo "body{padding:0;margin:0;box-sizing:border-box;}\n";
echo "th,td{text-align:center;}\n";
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



$sql="SELECT course.cid, register.year, register.term, register.sec, student.sid, student.firstname as sfirstname, student.lastname as slastname, course.cname, teacher.tid, teacher.firstname as tfirstname, teacher.lastname as tlastname
FROM (register NATURAL JOIN student) 
    INNER JOIN course ON register.cid = course.cid
    INNER JOIN teacher ON course.tid = teacher.tid
 WHERE sid='".$_SESSION["student_id"]."';";
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
echo "<th> <img src='./image/sort.png' width='40' > </th>\n";
echo "<th> ชื่อวิชา </th>\n";
echo "<th> ปีการศึกษา </th>\n";
echo "<th> เทอม </th>\n";
echo "<th> กลุ่มเรียน </th>\n";
echo "<th> ตรวจสอบการเข้าเรียน </th>\n";
echo "<th> สถิติคะแนน </th>\n";
echo "<tr>\n";
echo "</thead>\n";

if($rs->num_rows>0)
{
    echo "<tbody>\n";
    while($row=$rs->fetch_assoc())
    {
        
            echo "<tr>\n";
            echo "<td>".$row["cid"]."</td>\n";
            echo "<td style='text-align:left'>".$row["cname"]."</td>\n";
            echo "<td>".$row["year"]."</td>\n";
            echo "<td>".$row["term"]."</td>\n";
            echo "<td>".$row["sec"]."</td>\n";
            echo "<td>"."<a href='student_statis_check.php?cid=".$row["cid"]."&cname=".$row["cname"]."&tfirstname=".$row["tfirstname"]."&tlastname=".$row["tlastname"]."&sec=".$row["sec"]."&term=".$row["term"]."&year=".$row["year"]."&sid=".$row["sid"]."&sfirstname=".$row["sfirstname"]."&slastname=".$row["slastname"]."'><img src='./image/student.png' alt='สถิติการเข้าเรียน'  width='50' ></a>"."</td>\n";
            echo "<td>"."<a href='student_statis_score.php?cid=".$row["cid"]."&cname=".$row["cname"]."&tfirstname=".$row["tfirstname"]."&tlastname=".$row["tlastname"]."&sec=".$row["sec"]."&term=".$row["term"]."&year=".$row["year"]."&sid=".$row["sid"]."&sfirstname=".$row["sfirstname"]."&slastname=".$row["slastname"]."'><img src='./image/test.png' alt='สถิติคะแนน'  width='50' ></a>"."</td>\n";
            echo "</tr>\n";
        
        
       
    }
    echo "</tbody>\n";
    echo "</table>\n";
}else
{
    echo "<table>\n";
    echo "<tr><td style='color:red' >ไม่พบข้อมูล !!!.!!!</td></tr>\n";
    echo "</table>\n";
}


echo "</body>\n";
//body
echo "</html>\n";
//html


?>