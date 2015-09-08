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
  </head>
    
    
    <?php
if(isset($_POST["Submit"])){   
    require_once('connections/conn.php');
// To add a new Category 
$link = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
//mysqli_set_charset('utf8',$link);
mysql_select_db($database, $link);

// Receiving Cat. Information 
$name_el=$_POST['name_el'];
$name_en=$_POST['name_en'];
$ImgURL=$_POST['ImgURL'];

$query_Recordset1 = "INSERT INTO category (icon_path) VALUES ('$ImgURL ')";
$Recordset1 = mysql_query($query_Recordset1, $link) or die(mysql_error());
$last_id=mysql_insert_id();
$query_Recordset2 = "INSERT INTO category_name (category_id,lang_id,name) VALUES ('$last_id','1','$name_el')";
$Recordset2 = mysql_query($query_Recordset2, $link) or die(mysql_error());
$query_Recordset3 = "INSERT INTO category_name (category_id,lang_id,name) VALUES ('$last_id','2','$name_en')";
$Recordset3 = mysql_query($query_Recordset3, $link) or die(mysql_error());
header('Location: index.php');
    die();
}

?>  
  <body>
        <form id="form1" name="form1" method="post" action="categories.php">
                <ul class="elegant-aero">
                
                <h1>
                Πρόσθεση/ Διαχείριση Κατηγορίας
                <span>Παρακαλώ συμπληρώστε τα παρακάτω στοιχεία</span>
                </h1>
                
                <p>
                <label>
                <span> Όνομα Κατηγορίας (ΕΛ) </span>
                <input type="text" name="name_el" id="name_el" />
                </label>
                
                <label>
                <span> Όνομα Κατηγορίας (ΕΝ) </span>
                <input type="text" name="name_en" id="name_en" />
                </label>
                
                <label>
                <span> Εικονίδιο Κατηγορίας:  </span>
                 <input id="ImgURL" type="text" name="ImgURL" placeholder="Icon URL" />
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