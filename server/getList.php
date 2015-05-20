<?php 
header('Content-Type:text/html; charset=utf8');
require_once('connections/conn.php'); ?>
<?php

$language=$_GET['language'];
$serv_id=$_GET['id'];
$link = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
mysqli_set_charset('utf8',$link);

mysql_select_db($database, $link);

$query_Recordset1 = "SELECT place.id, place.lat, place.lng, place_names.place_name, place.address FROM place INNER JOIN place_names ON place.id = place_names.place_id INNER JOIN service_detail ON service_detail.place_id = place.id WHERE service_detail.service_id = $serv_id  AND place_names.lang_id = $language";
$Recordset1 = mysql_query($query_Recordset1, $link) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$places = array();
do {  
$places[] = array($row_Recordset1['id'],$row_Recordset1['place_name'],$row_Recordset1['lat'],$row_Recordset1['lng'],$row_Recordset1['address']);
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
echo json_encode($places);
?>