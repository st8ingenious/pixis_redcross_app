<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel='stylesheet' type='text/css' href='style.css' />

	<title>Red Cross Patras</title>
	<style>
      html, body  {
      height: 100%;
	  width:100%;
      margin: 0px;
      padding: 0px;	
      }
    </style>
	
	<?php require_once('connections/conn.php'); 
      if(isset($_POST["Submit"])){ 
      $link = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database, $link);

// Receiving Service Information 
$name_el=$_POST['name_el'];
$name_en=$_POST['name_en'];
$category_id=$_POST['category_id'];

$query_Recordset1 = "INSERT INTO service (category_id) VALUES ('$category_id ')";
$Recordset1 = mysql_query($query_Recordset1, $link) or die(mysql_error());
$last_id=mysql_insert_id();
$query_Recordset2 = "INSERT INTO service_name (service_id,lang_id,name) VALUES ('$last_id','1','$name_el')";
$Recordset2 = mysql_query($query_Recordset2, $link) or die(mysql_error());
$query_Recordset3 = "INSERT INTO service_name (service_id,lang_id,name) VALUES ('$last_id','2','$name_en')";
$Recordset3 = mysql_query($query_Recordset3, $link) or die(mysql_error());
header('Location: showTable.php?type=3');	//After adding a service to return to the service list
      die();
      }
      ?>
	<?php
        // Here we load the categoroes from the DB to choose in which cat the service should be
	$link = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
	mysql_select_db($database, $link);
	$query_Recordset1 = "SELECT category.id, category_name.name FROM category, category_name WHERE category_name.category_id = category.id AND category_name.lang_id =1";
	$Recordset1 = mysql_query($query_Recordset1, $link) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	$totalRows_Recordset1 = mysql_num_rows($Recordset1);
	?>
	
  </head>
  <body>
        <form id="form1" name="form1" method="post" action="addService.php">
                <ul class="elegant-aero">
                
                <h1>
                Πρόσθεση/ Διαχείριση Υπηρεσίας
                <span>Παρακαλώ συμπληρώστε τα παρακάτω στοιχεία</span>
                </h1>
                
                <p>
                <label>
                <span> Όνομα Υπηρεσίας (ΕΛ) </span>
                <input type="text" name="name_el" id="name_el" />
                </label>
                
                <label>
                <span> Όνομα Υπηρεσίας (ΕΝ) </span>
                <input type="text" name="name_en" id="name_en" />
                </label>
                
                <label>
                <span> Κατηγορία Υπηρεσίας:  </span>
		<select name="category_id">
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
                </select><br/>                
				</label>
                </p>
                
                <label>
                <span>&nbsp;</span>
                <button class="button" type="submit" name="sSubmit" value="Submit">Αποθήκευση</button> 
                </label>
                </ul>
        </form>
     </body>
</html>