<?php 
header('Content-Type:text/html; charset=utf8');
require_once('connections/conn.php'); 

$language=$_GET['language'];
$place_id=$_GET['id'];
$link = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
mysqli_set_charset('utf8',$link);

mysql_select_db($database, $link);

$query_Recordset1 = "SELECT place.id as place_id, place.lat as place_lat, place.lng as place_lng, place_names.place_name as place_name, place.address as address, stops.id as stop_id, stops.lat as stop_lat, stops.lng as stop_lng, stops.lines as stop_lines FROM place INNER JOIN place_names ON place.id = place_names.place_id INNER JOIN stops ON stops.id = place.stop_id WHERE place.id = $place_id  AND place_names.lang_id = $language";
$Recordset1 = mysql_query($query_Recordset1, $link) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$places = array();
do {
// Query for times with this place_id
$open=0;	//open = 0(closed)| 1(open)
$query_Recordset2 = "SELECT * FROM Times WHERE Times.place_id =$place_id";
$Recordset2 = mysql_query($query_Recordset2, $link) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2); 

$times = array();
do{		//For each time
	$times[] = array($row_Recordset2['day'],$row_Recordset2['start_h'],$row_Recordset2['start_m'],$row_Recordset2['end_h'],$row_Recordset2['end_m']);
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
$places[] = array($row_Recordset1['place_id'],$row_Recordset1['place_name'],$row_Recordset1['place_lat'],$row_Recordset1['place_lng'],$row_Recordset1['address'],$row_Recordset1['stop_id'],$row_Recordset1['stop_lat'],$row_Recordset1['stop_lng'],$row_Recordset1['stop_lines'],$open);
//echo json_encode($times);
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
$result = array_merge($places,$times);
echo json_encode($result);
?>