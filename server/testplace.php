<?php 
header('Content-Type:text/html; charset=utf8');
require_once('connections/conn.php');
?>
<?php
$ttt='6';
$link = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_set_charset('utf8',$link);

mysql_select_db($database, $link);
$query_Recordset1 = "SELECT *  FROM service, service_name  WHERE service_name.service_id = service.id AND lang_id =1";
$Recordset1 = mysql_query($query_Recordset1, $link) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<form method="post" action="place_add.php">
    Service select:<br/>

<select multiple="multiple" name="sese[]" size="11" style="width:300px">
        <?php
do {  
?>
        <option value="<?php echo $row_Recordset1['id']?>"><?php echo $row_Recordset1['name']?></option>
        <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
     </select></br>
<input type="hidden" name="pareid" value="<?php echo $ttt ?>">
<input type="submit" name="submit" value="Add"/>
</form>  