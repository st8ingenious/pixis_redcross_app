<?php 
require_once('connections/conn.php');
$link = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database, $link);

  $id= $_POST['pareid'];
  $sese = $_POST['sese'];
echo $id;
  for($i = 0; $i < count($sese); $i++){
      echo $sese[$i];
      
    $query = "INSERT INTO service_detail(place_id,service_id) VALUES('$id','$sese[$i]')";
     $result = mysql_query($query,$link) or die ("query failed: " . mysql_error());
  }

  exit();
?>