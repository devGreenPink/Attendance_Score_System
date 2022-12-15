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
//format_date
date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d');

//head
echo "<head>\n";
echo "<title>สถิติการเช็คชื่อ</title>\n";
echo "<link rel='icon' type='image/x-icon' href='./image/checked.png'>\n";

echo "<style>\n";
echo "body{padding:0;margin:0;box-sizing:border-box;}\n";
echo "th,td{text-align:center; font-size:25px}\n";
echo ".check{color:#fff;
	background-color:#3ce742;
	outline: none;
    border: 0;
    color: #fff;
	padding:10px 20px;
	margin-top:50px;
	border-radius:2px;}";
echo "input[type=radio]{border: 0px;
    width: 100%;
    height: 2rem;}";
echo "</style>\n";

//head



$sql="SELECT * FROM `course` NATURAL JOIN register NATURAL JOIN student WHERE cid='".$_GET["cid"]."';";
$rs = $db_conn->query($sql)
	or die ("Query failed: " . $sql . "<br><br>");


//body
echo "<body>\n";
include_once("header.php");



//count_check
$std=0;

echo "<table width='40%' style='margin-top:4rem;'>\n";
echo "<tr><th style='text-align:left;'>รหัสวิชา</th><th style='text-align:left;'>". $_GET["cid"]."</th></tr>\n";
echo "<tr><th style='text-align:left;'>ชื่อวิชา</th><th style='text-align:left;'>วิชา". $_GET["cname"]."</th></tr>\n";
echo "<tr><th style='text-align:left;'>ปีการศึกษา</th><th style='text-align:left;'>".$_GET["cyear"] ."</th></tr>\n";
echo "<tr><th style='text-align:left;'>เทอม</th><th style='text-align:left;'>". $_GET["cterm"]."</th></tr>\n";
echo "<tr><th style='text-align:left;'>กลุ่มเรียน</th><th style='text-align:left;'>". $_GET["csec"]."</th></tr>\n";
echo "</table><hr>\n<br><br>";
if($rs->num_rows>0)
{
    //table
    echo "<table width='100%' >\n";

    //head -table
    echo "<tr>\n";
   
    echo "<th> รหัสนักศึกษา </th>\n";
    echo "<th> ชื่อ </th>\n";
    echo "<th> นามสกุล </th>\n";
    echo "<th> เข้าเรียน/ครั้ง </th>\n";
    echo "<th> ขาดเรียน/ครั้ง </th>\n";
    echo "<th> มาสาย/ครั้ง </th>\n";
    echo "<tr>\n";

    $count_check=0;
    while($row=$rs->fetch_assoc())
    {
            
            echo "<tr>\n";
            echo "<input type='hidden'  name='hidden_sid[]' value='".$row["sid"]."' >\n";
            echo "<td>".$row["sid"]."</td>\n";
            echo "<td style='text-align:left;'>".$row["firstname"]."</td>\n";
            echo "<td style='text-align:left;'>".$row["lastname"]."</td>\n";

            //check 1 0 2
            $sqlS="SELECT check_status FROM `c_check` WHERE sid='".$row["sid"]."' AND cid='".$_GET["cid"]."';";
            $rsStatus=$db_conn->query($sqlS)or die ("Query failed: " . $sqlS . "<br><br>");

            $one=0;
            $zero=0;
            $two=0;

            while($rowStatus=$rsStatus->fetch_assoc())
            {
              
                $status=$rowStatus['check_status'];
                //echo $status;
                
                if($status=='1')
                {
                    $one+=1;
                    
                }
                
                if($rowStatus['check_status']=='0')
                {
                    $zero+=1;
                }
                if($rowStatus['check_status']=='2')
                {
                    $two+=1;
                }
                $count_check+=1;
            }

            
            echo "<td>".$one."</td>\n";
            echo "<td>".$zero."</td>\n";
            echo "<td>".$two."</td>\n";
                 
            echo "</tr>\n";
          
            $std+=1;
            
            
       
    }
    
    echo "<tr><td></td></tr>\n";
    echo "<tr><td></td><td></td><td></td><td>เช็คชื่อทั้งหมด</td><td>".$count_check/$std."</td><td>ครั้ง</td></tr>\n";
    echo "</table>\n";
    echo "<br>\n";
    echo "&nbsp<a href='form_statis_check_main.php'><img src='./image/left-arrow.png' width='50px' ></a>\n";
    
}else
{
    echo "<table>\n";
    echo "<tr><td style='color:red' >ไม่พบข้อมูล.!!!</td></tr>\n";
    echo "</table>\n";
    echo"<meta http-equiv='Refresh' content='2;url=form_score_main.php'>\n";
}



//echo "<form>\n";
//form

echo "</body>\n";
//body
echo "</html>\n";
//html


?>