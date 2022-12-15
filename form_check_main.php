<?php
session_save_path("./session");	
session_start(); 
include_once("check_sesstion_timeout.php");

if (!isset($_SESSION["teacher_firstname"])&&!isset($_SESSION["teacher_lastname"])) {
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
echo "<title>Check</title>\n";
echo "<link rel='icon' type='image/x-icon' href='./image/checked.png'>\n";
echo "<style>\n";
echo "body{padding:0;margin:0;box-sizing:border-box;}\n";
echo "th,td{text-align:center;}\n";
echo "</style>\n";
echo "</head>\n";
//head



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
echo "<th><img src='./image/sort.png' width='40' ></th>\n";
echo "<th> ชื่อวิชา </th>\n";
echo "<th> ปีการศึกษา </th>\n";
echo "<th> เทอม </th>\n";
echo "<th> กลุ่มเรียน </th>\n";
echo "<th> เช็คชื่อสำหรับวันนี้ </th>\n";
echo "<th> เช็คชื่อย้อนหลัง </th>\n";
echo "<th> แก้ไขเช็คชื่อวันนี้ </th>\n";
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

            //ตรวจสอบว่าเช็คชื่อวันนี้ยัง
            
            //course
            $subject=$row["cid"];

            $sqlDupicate2="SELECT * FROM `c_check` WHERE `date_check`='$date' AND cid='$subject';";
            
            $rsDupicate = $db_conn->query($sqlDupicate2)
            or die ("Query failed: " . $sqlDupicate2 . "<br><br>");
            
            if($rsDupicate->num_rows>0)
            {
                echo "<td>"."<a href='#'><img src='./image/server.png' alt='เช็คชื่อแล้ว' width='50' ></a>"."</td>\n";
       
            }else
            {
                echo "<td>"."<a href='form_std_check_today.php?cid=".$row["cid"]."'><img src='./image/check.png' alt='เช็คชื่อ'  width='50' ></a>"."</td>\n";
            }
            
            echo "<td>"."<a href='form_std_check_restrospect.php?cid=".$row["cid"]."'><img src='./image/restrospect.png' alt='เช็คชื่อย้อนหลัง'  width='50' ></a>"."</td>\n";
            
            
            echo "<td>"."<a href='form_std_edit.php?cid=".$row["cid"]."'><img src='./image/edit.png' width='50' ></a>"."</td>\n";
            
            echo "</tr>\n";
        
        
       
    }
    echo "</table>\n";

    echo "<br><br><table>\n";
    
    echo "<tr><td><img src='./image/check.png' width='50' ></td>\n";
    echo "<td><p> ยังไม่ได้เช็คชื่อวันนี้</p></td></tr>\n";
    echo "<tr><td><img src='./image/server.png' width='50' ></td>\n";
    echo "<td><p> เช็คชื่อลงฐานข้อมูลแล้ว</p></td></tr>\n";
    
    echo "</table>\n";
    
    echo "<br><br><br>\n";
    echo "&nbsp<a href='main.php'><img src='./image/left-arrow.png' width='50px' ></a>\n";
}else
{
    echo "<table>\n";
    echo "<tr><td style='color:red' >ไม่พบข้อมูล !!!.!!!</td></tr>\n";
    echo "</table>\n";
}

//include_once("footer.php");
echo "</body>\n";
//body
echo "</html>\n";
//html


?>