<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />

<?php
/* This is the admin index file that shows the map
 * and links to the showTable for Cat/Places/Service
*/
?>


<title>Red Cross Patras</title>
<style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px;

      }

	  table {
		  width:100%;
		  display:block;
	  }
	  td {

	  }
    </style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script>

	var map;
	function initialize() {
	  var mapOptions = {
		zoom: 15,
		center: new google.maps.LatLng(38.2521411,21.7435798)
	  };
	  map = new google.maps.Map(document.getElementById('map-canvas'),
		  mapOptions);
	}

	google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
  <div>
  <table>
  <tr>
  	<td><a href="showTable.php?type=1">Σημεία</a></td>
    <td><a href="showTable.php?type=2">Κατηγορίες</a></td>
    <td><a href="showTable.php?type=3">Υπηρεσίες</a></td>
    <td>Στάσεις</td>
  </tr>
  </table>
  </div>
    <div id="map-canvas"></div>
  </body>
  </html>
