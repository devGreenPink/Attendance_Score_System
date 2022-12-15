<?php
session_save_path("./session");	
session_start(); 
include_once("check_session_timeout.php"); 

if (!isset($_SESSION["teacher_firstname"])&&!isset($_SESSION["teacher_lastname"])) {
	echo "<meta http-equiv='Refresh' content='0;url=index.html'>";
}


echo "<html>\n";
//head
echo "<head>\n";
echo "<title>เมนูหลัก</title>\n";
echo "<link rel='stylesheet' href='./css/main_style.css'>\n";
echo "<link rel='icon' type='image/x-icon' href='./image/checked.png'>\n";
echo "</head>\n";

//body
echo "<body>\n";

//header
include_once("header.php");

echo "<section id='page' style='margin-top:4rem;' >\n";
echo "<div id='check'><a href='form_check_main.php'><img src='./image/check.png' alt='เช็คชื่อ'  width='150' ></a><div>เช็คชื่อ</div></div>\n";
echo "<div id='statis_check'><a href='form_statis_check_main.php'><img src='./image/statis_check.png' alt='สถิติการเข้าเรียน'  width='150' ></a><div>สถิติการเข้าเรียน</div></div>\n";
echo "<div id='score'><a href='form_score_main.php'><img src='./image/score.png' width='150' ></a><div>คะแนน</div></div>\n";
echo "<div id='statis_score'><a href='form_statis_score_main.php'><img src='./image/statis_scores.png' width='150' ></a><div>สถิติคะแนน</div></div>\n";
echo "</section>\n";

echo "</body>\n";

echo "</html>\n";

?>
