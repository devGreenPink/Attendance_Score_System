<?php
session_save_path("./session");	
session_start(); 
include_once("check_session_timeout.php"); 

echo "<html>\n";
echo "<head>\n";
echo "<style>\n";

echo ".nav {";
echo "width:100%;";
echo  "list-style-type: none;";
echo  "margin: 0;";
echo  "padding: 0;";
echo  "overflow: hidden;";
echo  "background-color: #333;";
echo "position: fixed;
top: 0;
left: 0;";
echo "}";

echo "li {";
echo  "float: left;";
echo "}";

echo "li a {";
echo  "display: block;";
echo  "color: white;";
echo  "text-align: center;";
echo  "padding: 14px 16px;";
echo  "text-decoration: none;";
echo  "}";

echo "#name{float:right;width='20px';}";
echo "#log{float:right;}";

echo "li a:hover {";
echo  "background-color: #111;}";

echo "</style>";
echo "</head>";
echo "<body>";
echo "<ul class='nav'>";


if(isset($_SESSION["teacher_firstname"])&&isset($_SESSION["teacher_lastname"]))
{
	echo "<li><a class='active' href='main.php'>Home</a></li>";
	echo "<li id='log'><a href='logout.php' style='float:right; margin:2px;'><img src='./image/logout.png' width='20px' ></a></li>\n";
	echo "<li id='name'><a href='#'>".$_SESSION["teacher_firstname"]." ".$_SESSION["teacher_lastname"]."</a></li>";
}elseif(isset($_SESSION["student_firstname"])&&isset($_SESSION["student_lastname"])){
	echo "<li><a class='active' href='student_main.php'>Home</a></li>";
	echo "<li id='log'><a href='logout.php' style='float:right; margin:2px;'><img src='./image/logout.png' width='20px' ></a></li>\n";
	echo "<li id='name'><a href='#'>".$_SESSION["student_firstname"]." ".$_SESSION["student_lastname"]."</a></li>";
}else{
	echo "error";
}


echo "</ul>";
echo "</body>";
echo "</html>";

?>


  
  
 
  




