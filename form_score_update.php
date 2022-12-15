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
echo "<title>อัปเดตคะแนน</title>\n";
echo "<link rel='icon' type='image/x-icon' href='./image/checked.png'>\n";
echo "<style>\n";
echo "body{padding:0;margin:0;box-sizing:border-box;}\n";
echo "th,td{text-align:center; font-size:25px}\n";

echo ".check{color:#fff;
	background-color:#3ce742;
	outline: none;
    border: 0;
    color: #fff;
	border-radius:2px;
    width:10%;
    height:5%}";

echo "input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}\n";
echo "input[type='number']{
    width: 80px;
} \n";
echo "input[type=number] {text-align: right;}";
echo "</style>\n";
//head



//body
echo "<body>\n";
include_once("header.php");

//form
echo "<form method='post' action='db_update_score.php' onSubmit='return checkFullScore()'>\n";
//รหัสวิชา
echo "<input type='hidden'  name='hidden_cid' value='".$_GET["cid"]."' >\n";



echo "<table width='40%' style='margin-top:4rem;'>\n";
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
echo "<tr><th style='text-align:left;'>คะแนนเก็บ</th><th style='text-align:left;'>". "<input type='number' name='score_keep'  id='score_keep' min='0' max='100' onfocusout='fullScore()' value='$full_keep' required>"."</th></tr>\n";
echo "<tr><th style='text-align:left;'>คะแนนกลางภาค</th><th style='text-align:left;'>". "<input type='number' name='score_midterm' id='score_midterm' min='0' max='100' onfocusout='fullScore()' value='$full_midterm' required>"."</th></tr>\n";
echo "<tr><th style='text-align:left;'>คะแนนปลายภาค</th><th style='text-align:left;'>". "<input type='number' name='score_final' id='score_final'  min='0' max='100' onfocusout='fullScore()' value='$full_final' required>"."</th></tr>\n";
echo "<tr><td></td><td style='text-align:left; color:red; font-size:15px;'><span id='warning'></span></td></tr>\n";

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
    echo "<th> <span id='full_keep'>( $full_keep )</span></th>\n";
    echo "<th> <span id='full_midterm'>( $full_midterm )</span></th>\n";
    echo "<th> <span id='full_final'>( $full_final )</span></th>\n";
    echo "<th> (100) </th>\n";
    
    echo "<tr>\n";
    $k_status=0;
    $m_status=0;
    $f_status=0;
    $s_status=0;
    while($row=$rs->fetch_assoc())
    {
        
       
            echo "<tr>\n";
            echo "<input type='hidden'  name='hidden_sid[]' value='".$row["sid"]."' >\n";
            echo "<td>".$row["sid"]."</td>\n";
            echo "<td style='text-align:left;'>".$row["firstname"]."</td>\n";
            echo "<td style='text-align:left;'>".$row["lastname"]."</td>\n";
            echo "<td align='center'>"."<input type='number'  name='f_keep[]'     class='keep'  id='keep$i'    min='0' max='100' maxlength='2'  onfocusout='Addition()' value='".$row["keep"]."'>"."</td>\n";
            echo "<td align='center'>"."<input type='number'  name='f_midterm[]'  class='midterm' id='midterm$i' min='0' max='100'  maxlength='2'  onfocusout='Addition()' value='".$row["midterm"]."'>"."</td>\n";
            echo "<td align='center'>"."<input type='number'  name='f_final[]'    class='final'  id='final$i'     min='0' max='100' maxlength='2' onfocusout='Addition()' value='".$row["final"]."'>"."</td>\n";
            echo "<td align='center'>"."<input type='number'  name='f_summary[]'  class='summary'  id='summary$i'   min='0' max=100' maxlength='2'  value='".$row["sum"]."'>"."</td>\n";
            $k_status=$row["k_status"];
            $m_status=$row["m_status"];
            $f_status=$row["f_status"];
            $s_status=$row["s_status"];
            $i++;
            echo "</tr>\n";
            
    }
   
    echo "<tr>\n";
    echo "<td></td><td></td><td style='text-align:left;'>STATUS</td>\n";
    if($k_status==1)
    {
        echo "<td> <select name='s_keep' >
        <option value='1' selected>SHOW</option>
        <option value='0' >HIDE</option>
        </select></td>\n";
    }
    else
    {
        echo "<td> <select name='s_keep' >
        <option value='1'>SHOW</option>
        <option value='0' selected>HIDE</option>
        </select></td>\n";
    }

    if($m_status==1)
    {
        echo "<td> <select name='s_midterm' >
        <option value='1' selected>SHOW</option>
        <option value='0' >HIDE</option>
        </select></td>\n";
    }
    else
    {
        echo "<td> <select name='s_midterm' >
        <option value='1'>SHOW</option>
        <option value='0' selected>HIDE</option>
        </select></td>\n";
    }

    if($f_status==1)
    {
        echo "<td> <select name='s_final' >
        <option value='1' selected>SHOW</option>
        <option value='0' >HIDE</option>
        </select></td>\n";
    }
    else
    {
        echo "<td> <select name='s_final' >
        <option value='1'>SHOW</option>
        <option value='0' selected>HIDE</option>
        </select></td>\n";
    }

    if($s_status==1)
    {
        echo "<td> <select name='s_summary' >
        <option value='1' selected>SHOW</option>
        <option value='0' >HIDE</option>
        </select></td>\n";
    }
    else
    {
        echo "<td> <select name='s_summary' >
        <option value='1'>SHOW</option>
        <option value='0' selected>HIDE</option>
        </select></td>\n";
    }


    echo "</tr>\n";

    
    echo "</table>\n";
    
    echo "<br><p style='text-align:right; margin-right:5%;'><input type='submit' class='check' value='บันทึก'></p>\n";
    echo "&nbsp<a href='form_score_main.php'><img src='./image/left-arrow.png' width='50px'></a>\n";
    
}else
{
    echo "<table style='margin-top:4rem;'>\n";
    echo "<tr><td style='color:red' >ไม่พบข้อมูล.!!!</td></tr>\n";
    echo "</table>\n";
}



echo "<form>\n";
//form

//js

echo "<script>
function checkFullScore(){
    let f_keep=document.getElementById('score_keep').value;
    let f_midterm=document.getElementById('score_midterm').value;
    let f_final=document.getElementById('score_final').value;
    let rs=parseInt(f_keep)+parseInt(f_midterm)+parseInt(f_final);
    if(rs==100){
        
        return ture;
       
    }
    else
    {
        document.getElementById('warning').innerHTML='*ควรกรอกให้พอดี 100*';
        return false;
    }    
     
}

function fullScore(){
    let f_keep=document.getElementById('score_keep').value;
    let f_midterm=document.getElementById('score_midterm').value;
    let f_final=document.getElementById('score_final').value;
    document.getElementById('full_keep').innerHTML='( '+f_keep+' )';
    document.getElementById('full_midterm').innerHTML='( '+f_midterm+' )';
    document.getElementById('full_final').innerHTML='( '+f_final+' )';
    
    
}

function Addition() {
    for (let j = 0; j < $i; j++) {
        var keep = document.getElementById('keep'+j).value;
        var midterm = document.getElementById('midterm'+j).value;
        var final = document.getElementById('final'+j).value;
        document.getElementById('summary'+j).value=parseInt(keep)+parseInt(midterm)+parseInt(final);
      }
        
}
</script>";

echo "</body>\n";
//body
echo "</html>\n";
//html


?>