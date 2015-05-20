<?php require_once('connections/conn.php'); ?>
<?php


//$insert=$_GET['insert'];
$link = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_set_charset('utf8',$link);

mysql_select_db($database, $link);
$query_Recordset1 = "SELECT *  FROM service, service_name  WHERE service_name.service_id = service.id AND lang_id =1";
$Recordset1 = mysql_query($query_Recordset1, $link) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Red Cross Patras</title>
<style>
      html, body  {
        height: 100%;
		width:100%;
        margin: 0px;
        padding: 0px;	
      }
	  
	  #map-canvas
	  {
		height: 300px;
		width:100%;
        margin: 0px;
        padding: 0px;
	  }
	  
	  table {		  
		  width:100%;
		  height:100%;
	  }
	  td {
		  width:50%;
	  }
    </style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
    <script>
	var map;
	var marker;
	var autocomplete1;
	
	function initialize() {
	  var mapOptions = {
		zoom: 15,
		center: new google.maps.LatLng(38.2521411,21.7435798)
	  };
	  map = new google.maps.Map(document.getElementById('map-canvas'),
		  mapOptions);
		  
		google.maps.event.addListener(map, "click", function(event)
            {
                // place a marker
                placeMarker(event.latLng);
			
  			});
			
		autocomplete1 = new google.maps.places.Autocomplete(
			  /** @type {HTMLInputElement} */(document.getElementById('autocomplete1')),
			  { types: ['geocode'], componentRestrictions: {country: 'gr'} });
	}
	
	function fillInAddress() {
		  // Get the place details from the autocomplete object.
		  var place = autocomplete.getPlace();
		
		  for (var component in componentForm) {
			document.getElementById(component).value = '';
			document.getElementById(component).disabled = false;
		  }
		
		  // Get each component of the address from the place details
		  // and fill the corresponding field on the form.
		  for (var i = 0; i < place.address_components.length; i++) {
			var addressType = place.address_components[i].types[0];
			if (componentForm[addressType]) {
			  var val = place.address_components[i][componentForm[addressType]];
			  document.getElementById(addressType).value = val;
			}
		  }
		}
	
	function convert()
	{
		var geocoder = new google.maps.Geocoder();
		
		
		var address = document.getElementById('autocomplete1').value;
 		geocoder.geocode( { 'address': address}, function(results, status) 
		 {
    
			if (status == google.maps.GeocoderStatus.OK) 
			{
				  map.setCenter(results[0].geometry.location);
				  
				  marker = new google.maps.Marker({
					  map: map,
					  position: results[0].geometry.location
				  });
				  
			} 
				else {
				  alert('Geocode was not successful for the following reason: ' + status);
				}
		  });
		  
		  
	}
	
	function placeMarker(latLng)
	{
		if (marker!=null)
			marker.setMap(null);
			
		 marker = new google.maps.Marker({
                position: latLng, 
                map: map,
				});
				
		 console.log(marker.getPosition().toString());
	}
	
	function addService()
	{
		serviceList=document.getElementById("service");
		serviceName=serviceList.options[serviceList.selectedIndex].innerHTML;
		document.getElementById("service_list").innerHTML+=serviceName+ " "+ serviceList.options[serviceList.selectedIndex].value +"<br/>";
	}
	
	google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
  <form id="form1" name="form1" method="post" action=" ">
  <table border="1">
  <tr>
  	<td>Όνομα (ΕΛ)
  	    <input type="text" name="name_el" id="name_el" />
      </td>
    <td rowspan="4"><label for="coords"></label>
    	<br />
        <input id="autocomplete1" placeholder="Enter your address"
         onFocus="geolocate()" type="text" name="autocomplete1"><input type="button" name="conv" id="conv" value="+" onclick="convert();" />
		<div id="map-canvas"></div>
    </td>
    </tr>
  <tr>
    <td>Όνομα (ΕΝ)
      <input type="text" name="name_en" id="name_el2" /></td>
    </tr>
  <tr>
    <td>Ώρες 
    	<label for="day"></label>
    	<select name="day" id="day">
    	  <option value="1">&Delta;&epsilon;&upsilon;&tau;έ&rho;&alpha;</option>
    	  <option value="2">&Tau;&rho;ί&tau;&eta;</option>
    	  <option value="3">&Tau;&epsilon;&tau;ά&rho;&tau;&eta;</option>
    	  <option value="4">&Pi;έ&mu;&pi;&tau;&eta;</option>
    	  <option value="5">&Pi;&alpha;&rho;&alpha;&sigma;&kappa;&epsilon;&upsilon;ή</option>
    	  <option value="6">&Sigma;ά&beta;&beta;&alpha;&tau;&omicron;</option>
    	  <option value="7">&Kappa;&upsilon;&rho;&iota;&alpha;&kappa;ή</option>
      </select>
    	<label for="start_h"></label>
    	<select name="start_h" id="start_h">
    	  <option value="0">00</option>
    	  <option value="1">01</option>
    	  <option value="2">02</option>
    	  <option value="3">03</option>
    	  <option value="4">04</option>
    	  <option value="5">05</option>
    	  <option value="6">06</option>
    	  <option value="7">07</option>
    	  <option value="8">08</option>
    	  <option value="9">09</option>
    	  <option value="10">10</option>
    	  <option value="11">11</option>
    	  <option value="12">12</option>
    	  <option value="13">13</option>
    	  <option value="14">14</option>
    	  <option value="15">15</option>
    	  <option value="16">16</option>
    	  <option value="17">17</option>
    	  <option value="18">18</option>
    	  <option value="19">19</option>
    	  <option value="20">20</option>
    	  <option value="21">21</option>
    	  <option value="22">22</option>
    	  <option value="23">23</option>
      </select>
    	<label for="start_m"></label>
    	<select name="start_m" id="start_m">
    	  <option value="0">00</option>
    	  <option value="15">15</option>
    	  <option value="30">30</option>
    	  <option value="45">45</option>
      </select> 
    	- 
    	<select name="end_h" id="end_h">
    	  <option value="0">00</option>
    	  <option value="1">01</option>
    	  <option value="2">02</option>
    	  <option value="3">03</option>
    	  <option value="4">04</option>
    	  <option value="5">05</option>
    	  <option value="6">06</option>
    	  <option value="7">07</option>
    	  <option value="8">08</option>
    	  <option value="9">09</option>
    	  <option value="10">10</option>
    	  <option value="11">11</option>
    	  <option value="12">12</option>
    	  <option value="13">13</option>
    	  <option value="14">14</option>
    	  <option value="15">15</option>
    	  <option value="16">16</option>
    	  <option value="17">17</option>
    	  <option value="18">18</option>
    	  <option value="19">19</option>
    	  <option value="20">20</option>
    	  <option value="21">21</option>
    	  <option value="22">22</option>
    	  <option value="23">23</option>
  	  </select>
        <label for="start_m"></label>
        <select name="end_m" id="start_m">
          <option value="0">00</option>
          <option value="15">15</option>
          <option value="30">30</option>
          <option value="45">45</option>
        </select>
        <input type="submit" name="button" id="button" value="+" /></td>
    </tr>
  <tr>
    <td>Διεύθυνση (ΕΝ) 
      <input type="text" name="address" id="name_el3" /></td>
    </tr>
  <tr>
    <td>Πλησιέστερη Στάση</td>
    <td>&nbsp; </td>
  </tr>
  <tr>
    <td>Υπηρεσίες<tr>
    <td>
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
</td><tr>
    <td><input type="submit" name="submit" value="Αποθήκευση" style="height: 50px"/></td>
  </tr>
  </table>
  
  
  </form>
    
  </body>
  </html>
<?php
mysql_free_result($Recordset1);
?>
