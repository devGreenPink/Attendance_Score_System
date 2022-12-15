<?php
session_save_path("./session");	
session_start(); 
include_once("check_sesstion_timeout.php");


if (!isset($_SESSION["teacher_firstname"])&&!isset($_SESSION["teacher_lastname"])) {
	echo "<meta http-equiv='Refresh' content='0;url=index.html'>";
}


include_once("db_connect.php");

//format_time_zone
date_default_timezone_set('Asia/Bangkok');
$date = date('d-m-Y');

//html
echo "<html>\n";

//head
echo "<head>\n";
echo "<title>สถิติการเช็คชื่อ</title>\n";
echo "<link rel='icon' type='image/x-icon' href='./image/checked.png'>\n";
echo "<style>\n";
echo "body{padding:0;margin:0;box-sizing:border-box;}\n";
echo "th,td{text-align:center;}\n";
echo "</style>\n";
echo "</head>\n";
//head


//show course
$sql="SELECT * FROM course NATURAL JOIN register WHERE tid='".$_SESSION["teacher_id"]."' GROUP BY cname;";


$rs = $db_conn->query($sql)
	or die ("Query failed: " . $sql . "<br><br>");

//body
echo "<body>\n";

include_once("header.php");


//table
echo "<table width='100%' style='margin-top:4rem;'>\n";

//head -table
echo "<tr>\n";
echo "<th> <img src='./image/sort.png' width='40' > </th>\n";
echo "<th> ชื่อวิชา </th>\n";
echo "<th> ปีการศึกษา </th>\n";
echo "<th> เทอม </th>\n";
echo "<th> กลุ่มเรียน </th>\n";
echo "<th> สถิติการเข้าเรียน </th>\n";
echo "<tr>\n";

if($rs->num_rows>0)
{
    while($row=$rs->fetch_assoc())
    {
        
            echo "<tr>\n";

            echo "<td>".$row["cid"]."</td>\n";
            echo "<td style='text-align:left'>".$row["cname"]."</td>\n";
            echo "<td>".$row["year"]."</td>\n";
            echo "<td>".$row["term"]."</td>\n";
            echo "<td>".$row["sec"]."</td>\n";
            echo "<td>"."<a href='form_statis_check.php?cid=".$row["cid"]."&cname=".$row["cname"]."&cyear=".$row["year"]."&cterm=".$row["term"]."&csec=".$row["sec"]."'><img src='./image/statis_check.png' alt='สถิติการเข้าเรียน'  width='50' ></a>"."</td>\n";
            
            echo "</tr>\n";
        
    }
    echo "</table>\n";
    echo "<br><br><br>\n";
    echo "&nbsp<a href='main.php'><img src='./image/left-arrow.png' width='50px' ></a>\n";
}else
{
    echo "<table>\n";
    echo "<tr><td style='color:red' >ไม่พบข้อมูล.!!!</td></tr>\n";
    echo "</table>\n";
    echo"<meta http-equiv='Refresh' content='2;url=form_score_main.php'>\n";
}


echo "</body>\n";
//body
echo "</html>\n";
//html


?>