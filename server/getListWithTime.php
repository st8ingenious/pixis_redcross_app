<?php 
header('Content-Type:text/html; charset=utf8');
require_once('connections/conn.php'); 

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
$date = new DateTime('now', new DateTimeZone('Europe/Athens'));
$nowTime = $date->format('N,H:i');
do {
// Query for times with this place_id
$open=0;	//open = 0(closed)| 1(open)
$query_Recordset2 = "SELECT * FROM Times WHERE Times.place_id =".$row_Recordset1['id'];
$Recordset2 = mysql_query($query_Recordset2, $link) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2); 
//For each time
do{
$place_day=$row_Recordset2['day'];
$timeArray = explode(",", $nowTime);
if(0==strcmp($timeArray[0],$place_day)){	// Open today
	//Check for time
	$hourArray = explode(":", $timeArray[1]);
	$nowHour=(int)$hourArray[0];
	$starting_hour = (int)$row_Recordset2['start_h'];
	$ending_hour = (int)$row_Recordset2['end_h'];
	if($nowHour > $starting_hour and $nowHour < $ending_hour){
		$open=1;
		break;
	}
}
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
$places[] = array($row_Recordset1['id'],$row_Recordset1['place_name'],$row_Recordset1['lat'],$row_Recordset1['lng'],$row_Recordset1['address'],$open);
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
echo json_encode($places);
?>