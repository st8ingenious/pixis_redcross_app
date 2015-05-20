<?php
$hostname = "localhost";
$database = "database";
$username = "username";
$password = "password";

//$insert=$_GET['insert'];
$link = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_set_charset('utf8',$link);
?>