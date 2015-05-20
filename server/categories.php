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
  <body>
        <form id="form1" name="form1" method="post" action="addCategory.php">
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
                <button class="button" type="submit" name="sSubmit" value="Submit">Submit</button> 
                </label>
                </ul>
        </form>
     </body>
</html>