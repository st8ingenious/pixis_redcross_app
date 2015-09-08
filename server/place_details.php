<?php require_once('connections/conn.php'); ?>
<?php

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
    
 <?php    
    if(isset($_POST["submit"])){
        
    echo $tlat = $_POST['tlat'];
    echo "<br>";
    echo $tlng = $_POST['tlng'];
    echo "<br>";
   echo  $address_el = $_POST['address_el'];
 echo "<br>";
    echo  $address_en = $_POST['address_en'];
         echo "<br>"; 
    echo $phone = $_POST['phone'];
    echo "<br>"; 
    echo $url = $_POST['url'];
        
        $query_Recordset1 = "Insert into place (lat, lng, phone,stop_id, address, address_en, url_link) values ( '$tlat', '$tlng', '$phone', 1, \"$address_el\", \"$address_en\", '$url')";
$Recordset1 = mysql_query($query_Recordset1, $link) or die(mysql_error());
        $last_id=mysql_insert_id();
        
        echo "<br>"; 
        echo $name_el = $_POST['name_el'];
    echo "<br>"; 
    echo $name_en = $_POST['name_en'];
    echo "<br>";
    echo "<br>";
      
    $query = "INSERT INTO place_names(place_id, lang_id, place_name) VALUES('$last_id', 1, '$name_el')";
     $result = mysql_query($query,$link) or die ("query failed: " . mysql_error());
         $query = "INSERT INTO place_names(place_id, lang_id, place_name) VALUES('$last_id', 2, '$name_en')";
     $result = mysql_query($query,$link) or die ("query failed: " . mysql_error());
   echo "<br>";
   echo "<br>";
             
         $days=array("Δευτέρα","Τρίτη","Τετάρτη","Πέμπτη","Παρασκευή","Σάββατο","Κυριακή");
    $times="";
     for($i = 0; $i < 7; $i++){
         
   echo $fromH = $_POST[$days[$i] .'FromH'];
   echo $fromM= $_POST[$days[$i] .'FromM'];
    
       echo  $fromAP = $_POST[$days[$i] .'FromAP'];
         if ($fromAP=="μμ"){
        echo  $fromH += 12;}       

   echo  $toH = $_POST[$days[$i] .'ToH'];
echo $toM = $_POST[$days[$i] .'ToM'];
         
  echo  $toAP = $_POST[$days[$i] .'ToAP'];
         if ($toAP=="μμ"){
        echo  $toH += 12;}   
         
     $closed = $_POST[$days[$i] .'closed'];
         
    if ($closed=="closed"){
     echo  $fromH = '30'; 
    }
        $day=$i+1;
         
 $query = "INSERT INTO Times(place_id, day, start_h, start_m, end_h, end_m) VALUES('$last_id', '$day', '$fromH
 ', '$fromM', '$toH', '$toM')";
     $result = mysql_query($query,$link) or die ("query failed: " . mysql_error());
          
     }
    
    echo "<br>";
    echo "<br>";
    
    $sese = $_POST['sese'];
  for($i = 0; $i < count($sese); $i++){
      echo $sese[$i];
      echo "<br>";
      
    $query = "INSERT INTO service_detail(place_id,service_id) VALUES('$last_id','$sese[$i]')";
     $result = mysql_query($query,$link) or die ("query failed: " . mysql_error());
            
}
        die();
    } else if(isset($_POST["id"])){
        
      $query_Recordset1 = "SELECT place.id as place_id, place.lat as place_lat, place.lng as place_lng, place_names.place_name as place_name, place.address as address, stops.id as stop_id, stops.lat as stop_lat, stops.lng as stop_lng, stops.lines as stop_lines FROM place INNER JOIN place_names ON place.id = place_names.place_id INNER JOIN stops ON stops.id = place.stop_id WHERE place.id = $place_id  AND place_names.lang_id = $language";  
        
        
    
    
    
    
    }

?>

    
    <script src="http://code.jquery.com/jquery-1.4.4.min.js" type="text/javascript"></script>
<style type="text/css">
    
    .day {
    height: 25px;
}

#label {
    float: left;
    min-width: 80px; 
}
    
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
                 document.formmain.diefid.value = address;
                document.formmain.topolat.value =results[0].geometry.location.lat()
                document.formmain.topolng.value =results[0].geometry.location.lng()
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
  <form id="formmain" name="formmain" method="post" action="place_details.php">
  <table border="1">
  <tr>
  	<td>Όνομα (ΕΛ)
  	    <input type="text" name="name_el" style="width: 220px"/>
      </td>
    <td rowspan="4"><label for="coords"></label>
    	<br />
        <input id="autocomplete1" placeholder="Εισάγετε διεύθυνση" onFocus="geolocate()" type="text" name="autocomplete1" style="width: 250px" ><input type="button" style="height: 25px" name="conv" id="conv" value="Εύρεση στο χάρτη" onclick="convert();" />
		<div id="map-canvas"></div>
    </td>
    </tr>
  <tr>
    <td>Όνομα (ΕΝ)
      <input type="text" name="name_en" style="width: 220px" /></td>
    </tr>
  <tr>
    <td>
      <div id="hourForm">
    <div id="Δευτέρα" class="day"></div>
    <div id="Τρίτη" class="day"></div>
    <div id="Τετάρτη" class="day"></div>
    <div id="Πέμπτη" class="day"></div>
    <div id="Παρασκευή" class="day"></div>
    <div id="Σάββατο" class="day"></div>
    <div id="Κυριακή" class="day"></div>
</div>
	<script type="text/javascript">
$('.day').each(function() {
    var day = $(this).attr('id');
    $(this).append('<div id="label">' + day + ': </div>');
    $(this).append('<select name="' + day + 'FromH" class="hour from"></select>');
    $(this).append('<select name="' + day + 'FromM" class="min from"></select>');
    $(this).append('<select name="' + day + 'FromAP" class="ampm from"></select>');
    $(this).append(' έως <select name="' + day + 'ToH" class="hour to"></select>');
    $(this).append('<select name="' + day + 'ToM" class="min to"></select>');
    $(this).append('<select name="' + day + 'ToAP" class="ampm to"></select>');
    $(this).append(' <input type="checkbox" name="' + day + 'closed" value="closed" class="closed"><span>Κλειστά</span>');

});

$('.hour').each(function() {
    for (var h = 1; h < 13; h++) {
        $(this).append('<option value="' + h + '">' + h + '</option>');
    }

    $(this).filter('.from').val('9');
    $(this).filter('.to').val('5');
});

$('.min').each(function() {
    var min = [':00', ':15', ':30', ':45'];
    for (var m = 0; m < min.length; m++) {
        $(this).append('<option value="' + min[m] + '">' + min[m] + '</option>');
    }

    $(this).val(':00');
});

$('.ampm').each(function() {
    $(this).append('<option value="πμ">πμ</option>');
    $(this).append('<option value="μμ">μμ</option>');

    $(this).filter('.from').val('πμ');
    $(this).filter('.to').val('μμ');
});

$('input').change( function() { 
    if($(this).filter(':checked').val() == "closed") {
        $(this).siblings('select').attr('disabled', true);
    } else {
        $(this).siblings('select').attr('disabled', false);
    }
});

$('#Σάββατο .closed, #Κυριακή .closed').val(["closed"]).siblings('select').attr('disabled', true);
  </script>	
      </td>
    </tr>
      <tr>
    <td>Τηλέφωνο 
      <input type="text" name="phone" style="width: 220px" /></td>
    </tr>
      <tr>
    <td>Url 
      <input type="text" name="url" value="http://" style="width: 220px"/></td>
    </tr>
      <tr>
    <td>Διεύθυνση (ΕΛ)
     <input id="diefid" type="text" name="address_el" value="" style="width: 220px"/> 
         <input id="topolat" type="hidden" name="tlat" value="" />
           <input id="topolng" type="hidden" name="tlng" value="" />
    </tr>
  <tr>
    <td>Διεύθυνση (ΕΝ) 
      <input type="text" name="address_en" style="width: 220px"/></td>
    </tr>
  <tr>
    <td>Πλησιέστερη Στάση</td>
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
