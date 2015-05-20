<?php require_once('connections/conn.php'); ?>
<?php

$link = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_set_charset('utf8',$link);

mysql_select_db($database, $link);


if(isset($_POST['submit-relate'])){
	 $pl = $_POST['place-relate'];
	 $sr = $_POST['service-relate'];
	
	foreach($sr as $s){
	 $query_insert = "INSERT INTO service_detail (place_id, service_id) VALUES ($pl, $s)";
	$Recordset1 = mysql_query($query_insert, $link) or die(mysql_error());
	}

}



$query_Recordset1 = "SELECT service.id as s_id, name   FROM service, service_name  WHERE service_name.service_id = service.id AND lang_id =1";
$Recordset1 = mysql_query($query_Recordset1, $link) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$query_Recordset2 = "SELECT place.id as p_id, place_name as name   FROM place, place_names  WHERE place_names.place_id = place.id AND lang_id =1";
$Recordset2 = mysql_query($query_Recordset2, $link) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Red Cross Patras</title>
</head>
<body>


<form actio="#" method="post">
<table>
<tr>
<td>
 <select multiple name="place-relate" style="height:300px; width:300px;margin-right: 40px;">
 <?php
do{
 ?>
  <option value="<?php echo $row_Recordset2['p_id']; ?>"><?php echo $row_Recordset2['name']; ?></option>
  <?php
  }while($row_Recordset2 = mysql_fetch_assoc($Recordset2));
  ?>
</select> 
</td>
<td>

<select multiple name="service-relate[]" style="height:300px; width:300px;">
 <?php
do{
 ?>
  <option value="<?php echo $row_Recordset1['s_id']; ?>"><?php echo $row_Recordset1['name']; ?></option>
  <?php
  }while($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  ?>
</select> 

</td>
</tr>
</table>

<input type="submit" value="submit" name="submit-relate">

</form>

  </body>
  </html>
<?php
mysql_free_result($Recordset1);
?>
