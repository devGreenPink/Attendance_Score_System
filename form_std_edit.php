<?php
session_save_path("./session");	
session_start(); 
include_once("check_session_timeout.php"); 


if (!isset($_SESSION["teacher_firstname"])&&!isset($_SESSION["teacher_lastname"])) {
	echo "<meta http-equiv='Refresh' content='0;url=index.html'>";
}


include_once("db_connect.php");

date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d');

//html
echo "<html>\n";

//head
echo "<head>\n";
echo "<title>แก้ไขการเช็คชื่อวันของวันนี้</title>\n";
echo "<link rel='icon' type='image/x-icon' href='./image/checked.png'>\n";
echo "<style>\n";
echo "th,td{text-align:center; font-size:25px}\n";
echo "*{padding:0;margin:0;box-sizing:border-box;}\n";
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
    height: 2em;}";
echo "</style>\n";
echo "</head>\n";
//head

//style
echo "<style>\n";
echo "tr:nth-child(even) {background-color: #f2f2f2;}";
echo "</style>\n";

$sql="SELECT sid,firstname,lastname,check_status FROM `course`NATURAL JOIN register NATURAL JOIN student NATURAL JOIN c_check  WHERE tid='".$_SESSION["teacher_id"]."' AND cid='".$_GET["cid"]."' AND date_check='$date';";


$rs = $db_conn->query($sql)
	or die ("Query failed: " . $sql . "<br><br>"); 
//body
echo "<body>\n";
include_once("header.php");

//form
echo "<form method='post' action='db_update.php'>\n";
//รหัสวิชา
echo "<input type='hidden'  name='hidden_s_id' value='".$_GET["cid"]."' >\n";





if($rs->num_rows>0)
{
    //table
    echo "<table width='100%' style='margin-top:4rem;'>\n";
    //head -table
    echo "<tr>\n";

    echo "<th> รหัสนักศึกษา </th>\n";
    echo "<th> ชื่อ</th>\n";
    echo "<th>นามสกุล</td>\n";
    echo "<th> เข้าเรียน </th>\n";
    echo "<th> ขาดเรียน </th>\n";
    echo "<th> มาสาย </th>\n";
    echo "<tr>\n";
    while($row=$rs->fetch_assoc())
    {
        
            echo "<tr>\n";
            echo "<input type='hidden'  name='hidden_sid[]' value='".$row["sid"]."' >\n";
            echo "<td>".$row["sid"]."</td>\n";
            echo "<td style='text-align:left;'>".$row["firstname"]."</td>\n";
            echo "<td style='text-align:left;'>".$row["lastname"]."</td>\n";
            if($row["check_status"]=='1')
            {
                echo "<td align='center'>"."<input type='radio' id='#' name='".$row["sid"]."' value='1' checked required>"."</td>\n";
                echo "<td align='center'>"."<input type='radio' id='#' name='".$row["sid"]."' value='0' >"."</td>\n";
                echo "<td align='center'>"."<input type='radio' id='#' name='".$row["sid"]."' value='2' >"."</td>\n";

            }
            else if($row["check_status"]=='2')
            {
                echo "<td align='center'>"."<input type='radio' id='#' name='".$row["sid"]."' value='1'  required>"."</td>\n";
                echo "<td align='center'>"."<input type='radio' id='#' name='".$row["sid"]."' value='0' >"."</td>\n";
                echo "<td align='center'>"."<input type='radio' id='#' name='".$row["sid"]."' value='2' checked>"."</td>\n";
            }
            else
            {
                echo "<td align='center'>"."<input type='radio' id='#' name='".$row["sid"]."' value='1'  required>"."</td>\n";
                echo "<td align='center'>"."<input type='radio' id='#' name='".$row["sid"]."' value='0' checked >"."</td>\n";
                echo "<td align='center'>"."<input type='radio' id='#' name='".$row["sid"]."' value='2' >"."</td>\n";
            }
            
            

            echo "</tr>\n";
       
    }
    echo "</table>\n";
    
    echo "<p style='text-align:right; margin-right:2rem;'><input type='submit' class='check' value='เช็คชื่อ'></p>\n";
    echo "&nbsp<a href='form_check_main.php'><img src='./image/left-arrow.png' width='50px'></a>\n";
}else
{
  
    echo "<table style='margin-top:4rem;'>\n";
    echo "<tr><td style='color:red' >ไม่พบข้อมูล.!!!</td></tr>\n";
    echo "</table>\n";
    echo"<meta http-equiv='Refresh' content='2;url=form_check_main.php'>\n";
}




echo "<form>\n";
//form

echo "</body>\n";
//body
echo "</html>\n";
//html


?>