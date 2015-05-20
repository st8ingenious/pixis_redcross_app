<?php 
header('Content-Type:text/html; charset=utf8');
require_once('connections/conn.php');
// Type of element to list: Place = 1, Category =2, Service = 3
$element=$_GET['type'];
$link = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
//mysqli_set_charset('utf8',$link);

mysql_select_db($database, $link);
if($element == "1"){
$query_Recordset1 = "SELECT place.id, place_names.place_name FROM place INNER JOIN place_names ON place.id=place_names.place_id WHERE place_names.lang_id='1' ORDER BY place_names.place_name ASC";
}else if($element == "2"){
$query_Recordset1 = "SELECT category.id, category_name.name, category.icon_path FROM category JOIN category_name  WHERE category.id = category_name.category_id AND category_name.lang_id =1 ORDER BY category_name.name ASC";
}else if($element == "3"){
$query_Recordset1 = "SELECT service.id, service_name.name FROM service INNER JOIN service_name ON service.id = service_name.service_id WHERE service_name.lang_id =1 ORDER BY service_name.name ASC";
}
$Recordset1 = mysql_query($query_Recordset1, $link) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$echoString = "";
if($element == "1" or $element == "3"){
     $echoString .= '<table border=1><tr><th>Όνομα</th><th>Επεξεργασία</th><th>Διαγραφή</th></tr>';
}else{
     $echoString .= '<table border=1><tr><th>Εικονίδιο</th><th>Όνομα</th><th>Επεξεργασία</th><th>Διαγραφή</th></tr>';
}
     // output data of each row
do {
 	$echoString .= "<tr>";
	if($element == "2"){
		$echoString .= '<td align="center"><img height="15" width="15"  src=" '. $row_Recordset1['icon_path'];
		$echoString .= '"></img>';
	}
	if($element == "1"){
		$echoString .= "<td>" .$row_Recordset1['place_name'] . "</td>";
	}else{
		$echoString .= "<td>" .$row_Recordset1['name'] . "</td>";
	}	
	$echoString .= '<td align="center"><a href="editElement.php?type='.$element .'&id='. $row_Recordset1['id'];
	$echoString .= '"><img src="images/edit.jpg" height="15" width="15"></a></td>';
	$echoString .= '<td align="center"><a href ="deleteElement.php?delete='.$element .'&id='. $row_Recordset1['id'];
	$echoString .= '"><img src="images/delete.jpg" height="15" width="15"></a></td>';
	$echoString .= "</tr>"; 
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
$echoString .= "</table>";
if($element == "1"){
	$echoString .= '<br/><div>Προσθήκη Νέου<a href="place_details.php"><img src="images/add.jpg" height="15" width="15"></a></div>';
}
if($element == "2"){
	$echoString .= '<br/><div>Προσθήκη Νέου<a href="categories.php"><img src="images/add.jpg" height="15" width="15"></a></div>';
}
if($element == "3"){
	$echoString .= '<br/><div>Προσθήκη Νέου<a href="services.php"><img src="images/add.jpg" height="15" width="15"></a></div>';
}
echo $echoString;
?>