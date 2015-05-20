<?php 
header('Content-Type:text/html; charset=utf8');
require_once('Connections/conn.php'); ?>
<?php
// Type of element to delete: Place = 1, Category =2, Service = 3
$type=$_GET['delete'];
$element_id=$_GET['id'];
$link = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
//mysqli_set_charset('utf8',$link);

mysql_select_db($database, $link);

if($type == "1"){
$query_Recordset1 = "DELETE FROM place WHERE place.id='$element_id'";
}else if($type == "2"){
$query_Recordset1 = "DELETE FROM category WHERE category.id='$element_id'";
}else if($type == "3"){
$query_Recordset1 = "DELETE FROM service WHERE service.id='$element_id'";
}
$Recordset1 = mysql_query($query_Recordset1, $link) or die(mysql_error());
header('Location: index.php');
?>