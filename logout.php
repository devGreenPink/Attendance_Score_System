<?php
session_save_path("./session"); 
session_start(); 
session_unset();
session_destroy();
echo"<meta http-equiv='Refresh' content='0;url=index.html'>\n";
?>