<?php 
header('Content-Type:text/html; charset=utf8');
require_once('connections/conn.php');
$type=$_GET['type'];

/* This file shows the table of 
*  - Places (type = 1)
*  - Categories (type = 2)
*  - Services (type = 3)
 
* It waits for the php file fillTable to get the information from the DB 
* And display it in a table using AJAX
*/
 ?>
<html>
<head>
	<title>Red Cross Patras</title>
	<b><a style" href=./index.php>Αρχική</a></b>
	<script>
		function showPlaces() {
             if (window.XMLHttpRequest) {
                 // code for IE7+, Firefox, Chrome, Opera, Safari
                 xmlhttp = new XMLHttpRequest();
             } else {  // code for IE6, IE5
                 xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
             }
             xmlhttp.onreadystatechange = function () {
                 if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                     document.getElementById("showPlacesOutput").innerHTML = xmlhttp.responseText;
                 }
             }
             xmlhttp.open("GET", "fillTable.php?type=" + <?php echo $type; ?>, true);
             xmlhttp.send();
         }
    </script>
</head>
<body>
	<script>showPlaces();</script>
	<div id="showPlacesOutput"></div>
</body>
<html>	
