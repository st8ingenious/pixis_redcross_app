<?php 
header('Content-Type:text/html; charset=utf8');
require_once('connections/conn.php');
// To add a new Service 
$link = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database, $link);

// Receiving Service Information 
$name_el=$_POST['name_el'];
$name_en=$_POST['name_en'];
$category_id=$_POST['category_id'];

$query_Recordset1 = "INSERT INTO service (category_id) VALUES ('$category_id ')";
$Recordset1 = mysql_query($query_Recordset1, $link) or die(mysql_error());
$last_id=mysql_insert_id();
$query_Recordset2 = "INSERT INTO service_name (service_id,lang_id,name) VALUES ('$last_id','1','$name_el')";
$Recordset2 = mysql_query($query_Recordset2, $link) or die(mysql_error());
$query_Recordset3 = "INSERT INTO service_name (service_id,lang_id,name) VALUES ('$last_id','2','$name_en')";
$Recordset3 = mysql_query($query_Recordset3, $link) or die(mysql_error());
header('Location: showTable.php?type=3');	//After adding a service to return to the service list
?>