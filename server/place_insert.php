<?php require_once('connections/conn.php'); ?>
<?php


//$insert=$_GET['insert'];
$link = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_set_charset('utf8',$link);

mysql_select_db($database, $link);
$id = $_POST['placeid'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$addr = $_POST['autocomplete1'];
$query_Recordset1 = "Insert into place (id, lat, lng, stop_id, address) values ($id, $lat, $lng, 1, \"$addr\")";
$Recordset1 = mysql_query($query_Recordset1, $link) or die(mysql_error());

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-7" />
<title>Untitled Document</title>
</head>
 
<body>
<?php 

//$query_Recordset1 = "Insert into place (id, lat, lng, stop_id, address) values ($id, $lat, $lng, 1, \"$addr\")";
echo $query_Recordset1;
$Recordset1 = mysql_query($query_Recordset1, $link) or die(mysql_error());
?>
OK
</body>
</html>