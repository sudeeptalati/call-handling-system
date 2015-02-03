<?php
$servicecall_id=$_GET['id'];
$engineer_id=$_GET['engineer_id'];
$servicecallmodel=Servicecall::model()->findbyPK(array('id'=>$servicecall_id));
$current_customer_postcode=$servicecallmodel->customer->postcode;
$engineer_name=$servicecallmodel->engineer->fullname;
$servicecallmodel=Servicecall::model()->findbyPK(array('id'=>$servicecall_id));
$model=Enggdiary::model();
$no_next_days=$model->getConsiderdaysforslotavailabity();
$today=date('d-m-Y');

//echo $data->servicecall->customer->postcode;
?>
<br>
Current Customer Code: <?php echo $current_customer_postcode;?><br>
Engineer ID:<?php echo $engineer_name;?><br>
<br>
<table>
<tr>
<?php
$days_postcodes_array=array();
for ($i = 1; $i <=$no_next_days; $i++)
{
    $forloopdate_time= time() + (86400 * $i);
	$forloopdate_string=date("d-M-Y l", $forloopdate_time);
	$forloop_day=date("d", $forloopdate_time);
	$forloop_month=date("m", $forloopdate_time);
	$forloop_year=date("Y", $forloopdate_time);
	
	$forloop_start_date_time=mktime(0, 0, 0, $forloop_month, $forloop_day, $forloop_year);////hours,minutes,seconds,month,day,year
	$forloop_end_date_time=mktime(23, 59, 59, $forloop_month, $forloop_day, $forloop_year);////hours,minutes,seconds,month,day,year

	//echo '<hr>'.date('l jS \of F Y h:i:s A',$s);
	$data=Enggdiary::model()->getData($engineer_id, $forloop_start_date_time,$forloop_end_date_time);
//print_r($data);


	echo '<td style="vertical-align:top;">';
	echo '<b>'.$forloopdate_string.'</b>';

	$customer_postcodes=array();
	foreach ($data as $d)
	{
		$diary_customer_postcode=$d->servicecall->customer->postcode;
		$diary_customer_postcode = strtoupper($diary_customer_postcode);
		$diary_customer_postcode = trim($diary_customer_postcode);
		echo '<br>'.$diary_customer_postcode;
		array_push($customer_postcodes,$diary_customer_postcode);
	}
	
	array_push($days_postcodes_array,$customer_postcodes);
	
	
	echo '</td>';
	
}//end of days forloop_end_date_time

$x=1;
echo '<table><tr>';
foreach ($days_postcodes_array as $pa)
	{
		echo '<td style="vertical-align:top;"><hr> <b>DAY '.$x.'</b>';
		foreach ($pa as $p)
		{
			$passing_postcodes_array=array();
			array_push($passing_postcodes_array,$p);
			echo '<br>'.$p;
		}
		echo '</td>';
		
		$x++;
		
	}

		
echo '</tr></table>';
?>
</tr>
</table>
<?php


?>
<br>
<?php echo $current_customer_postcode ?>
 
 
     <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>

    <script>
var map;
var geocoder;
var bounds = new google.maps.LatLngBounds();
var markersArray = [];
var x=0;
var considerdays=<?php echo $no_next_days; ?>;
var fivedayspostcodes=<?php echo json_encode($days_postcodes_array); ?>;
 
var recievd_postcodes=[];
var recievd_distances=[];
var recievd_time=[];
var autotimer;
var engg_id=<?php echo $engineer_id; ?>;
var service_id=<?php echo $servicecall_id; ?>;
var nearestdate='';

var destinationIcon = 'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=D|FF0000|000000';
var originIcon = 'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=O|FFFF00|000000';

function initialize() {
  var opts = {
    center: new google.maps.LatLng(55.6414923, -4.5296094),
    zoom: 10
  };
  map = new google.maps.Map(document.getElementById('map-canvas'), opts);
  geocoder = new google.maps.Geocoder();
}

function calculateDistances() {
	
	if (x<considerdays)
	{
	d_array=[];
	d_array = fivedayspostcodes[x];
	
	var service = new google.maps.DistanceMatrixService();
	service.getDistanceMatrix(
    {
/*
		origins: ['KA32SN', 'KA12NP'],
		destinations: ['PA12BE'],
*/
		origins:['PA12BE'],
		destinations:d_array,

		travelMode: google.maps.TravelMode.DRIVING,
		unitSystem: google.maps.UnitSystem.IMPERIAL,
		avoidHighways: false,
		avoidTolls: false
    }, callback);
	x++;
	}
	else
	{	
		//x=0;
		alert('The system can only consider for '+considerdays+' days and plan. Please choose a date manually or leave call in logged state to book later.');
		console.log(recievd_distances);
		p=indexOfSmallest(recievd_distances);
		
		nearestday=finddayofnearestpostcode(recievd_postcodes[p]);
		nearestdate=finddayofnearestdate(nearestday);
		console.log(nearestdate,engg_id,service_id);
		msg='The nearest available slot is on Day '+nearestday+ ', ' +nearestdate+ ' which is '+recievd_distances[p]+ ' miles by postcode '+recievd_postcodes[p]+' and it takes '+recievd_time[p];
		console.log(msg );
		document.getElementById('outputDiv').innerHTML=msg;
		var resetBtn = document.createElement("input");
		resetBtn.type = "button";
		resetBtn.value = "Select";
		resetBtn.style = "margin:5px";
		resetBtn.onclick=createNewDiaryEntry;
		document.getElementById('outputDiv').appendChild(resetBtn);
		clearInterval(autotimer);
	}

		
}///end of function calculateDistance

function callback(response, status) {

	console.log(response);
  if (status != google.maps.DistanceMatrixStatus.OK) {
    alert('Error was: ' + status);
  } else {
    var origins = response.originAddresses;
    var destinations = response.destinationAddresses;
    var outputDiv = document.getElementById('outputDiv');
    outputDiv.innerHTML = '';
    deleteOverlays();

    for (var i = 0; i < origins.length; i++) {
      var results = response.rows[i].elements;
      addMarker(origins[i], false);
      for (var j = 0; j < results.length; j++) {
        addMarker(destinations[j], true);
		
		/*
		outputDiv.innerHTML += origins[i] + ' to ' + destinations[j]
            + ': ' + results[j].distance.text + ' in '
            + results[j].duration.text + '<br>';
		*/
		recievd_postcodes.push(destinations[j]);
		rd=results[j].distance.text;
		rd=rd.replace('mi','');
		rd=rd.trim();
		rd=parseFloat(rd);
		recievd_distances.push(rd);
		recievd_time.push(results[j].duration.text);
 
 
 
		outputDiv.innerHTML += 'PA12BE  to ' + destinations[j]
            + ': ' + results[j].distance.text + ' in '
            + results[j].duration.text + '<br>';
		
	  }
    }
  }
}

function addMarker(location, isDestination) {
  var icon;
  if (isDestination) {
    icon = destinationIcon;
  } else {
    icon = originIcon;
  }
  geocoder.geocode({'address': location}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      bounds.extend(results[0].geometry.location);
      map.fitBounds(bounds);
      var marker = new google.maps.Marker({
        map: map,
        position: results[0].geometry.location,
        icon: icon
      });
      markersArray.push(marker);
    } else {
      alert('Geocode was not successful for the following reason: '
        + status);
    }
  });
}

function deleteOverlays() {
  for (var i = 0; i < markersArray.length; i++) {
    markersArray[i].setMap(null);
  }
  markersArray = [];
}

google.maps.event.addDomListener(window, 'load', initialize);


function callme()
{
	var div = document.getElementById('inputs');
		div.style.display = 'none';
	
	
		autotimer=setInterval(function() {
		calculateDistances();
		/*
		var div = document.getElementById('inputs');
		if (div.style.display !== 'none') {
        div.style.display = 'none';
			}
			else {
			div.style.display = 'block';
			}
		*/
		}, 5000);
}

function indexOfSmallest(a) {
 var lowest = 0;
 for (var i = 1; i < a.length; i++) {
  if (a[i] < a[lowest]) lowest = i;
 }
 return lowest;
}


function finddayofnearestpostcode(postcode)
{
postcode=postcode.trim();
data=<?php echo json_encode($days_postcodes_array); ?>;
foundonday='BLANK';

console.log(data);
console.log(postcode);

for (var key in data) {
  if (data.hasOwnProperty(key)) {
    //console.log(key + " -> " + data[key]);
	var day=key;
	
	for (t=0;t<data[key].length;t++)
	{
		current_pc=data[key][t];
		//console.log(current_pc);
		var n = postcode.indexOf(current_pc);
		if (n!=-1)
		{
			console.log('INDEX OF G75 8TD in DAY '+day+'is '+n );
			foundonday=parseInt(day)+1;
			return foundonday;
		}

		
	}////for (t=0;t<data[key].length;t++)
 
  }///end of if (data.hasOwnProperty(key)) {
 
}///end of for (var key in data) 

}



function createButton()
{
		/*
		var resetBtn = document.createElement("input");
		resetBtn.type = "button";
		resetBtn.value = "Select";
		resetBtn.style = "margin:5px";
		resetBtn.onclick=createNewDiaryEntry(nearestdate,engg_id,service_id);
		document.getElementById('outputDiv').appendChild(resetBtn);
		console.log('<?php echo json_encode($days_postcodes_array); ?>');
		*/
}


function createNewDiaryEntry()
{
		alert ('select btn clicjked');
 
		var urlToCreate ='<?php echo Yii::app()->getBaseUrl(); ?>'+'/index.php?r=api/createNewDiaryEntry&start_date='+nearestdate+'&engg_id='+engg_id+'&service_id='+service_id;
		alert(urlToCreate);
	
		$.ajax
		 ({
	     	type: 'POST',
	        url: urlToCreate ,
	        cache: false,
	        modal: true,
	        success: function(data) 
	        { 
		    	alert('Appointment Created');
				//location.href="baseUrl+'/index.php?r=servicecall/view&id="+service_id;
		    },
	        error: function()
	        {
		        alert("ERROR");
	        },
	        
	     });//end of AJAX.
	     
}//end of createNewDiaryEntry().
    
function finddayofnearestdate(nearestday)
{
	var today = new Date();
	var nearestdate = new Date(today);
	nearestdate.setDate(today.getDate()+nearestday);
	
	var dd = nearestdate.getDate();
	var mm = nearestdate.getMonth()+1; //January is 0!
	var yyyy = nearestdate.getFullYear();

	  
	rtn_date=dd+'-'+mm+'-'+yyyy;
	return rtn_date;
}
</script>
<style>
 

      #map-canvas {
        height: 25%;
        width: 25%;
      }
      #content-pane {
        float:right;
        width:100%;
        padding-left: 2%;
      }
      #outputDiv {
        font-size: 16px;
      }
    </style>
    <div id="content-pane">
      <div id="inputs">
    
		
		 
		
        <p><button type="button" onclick="callme();">Calculate
          distances</button></p>
      </div>
      <div id="outputDiv"></div>
    </div>
    <div id="map-canvas"></div>
  