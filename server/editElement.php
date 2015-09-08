<?php 
header('Content-Type:text/html; charset=utf8');
require_once('connections/conn.php'); ?>
<?php
// Type of element to edit: Place = 1, Category =2, Service = 3
$type=$_GET['type'];
$element_id=$_GET['id'];
//$link = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
//mysqli_set_charset('utf8',$link);

//mysql_select_db($database, $link);

if($type == "1"){ // Edit a place 
header('Location: place_details.php?id=' . $element_id);
}else if($type == "2"){ // Edit a place 
header('Location: categories.php?id=' . $element_id);
}else if($type == "3"){
header('Location: services.php?id=' . $element_id);
}

?>