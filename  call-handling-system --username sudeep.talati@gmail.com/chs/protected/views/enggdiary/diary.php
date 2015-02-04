<?php
$servicecall_id=$_GET['id'];
$engineer_id=$_GET['engineer_id'];
$servicecallmodel=Servicecall::model()->findbyPK(array('id'=>$servicecall_id));
$current_customer_postcode=$servicecallmodel->customer->postcode;
$engineer_name=$servicecallmodel->engineer->fullname;
$servicecallmodel=Servicecall::model()->findbyPK(array('id'=>$servicecall_id));
$model=Enggdiary::model();
$no_next_days=$model->getconsiderdaysforslotavailabity();
$allowedtraveldistancebetweenpostcodes=$model->gettraveldistanceallowedbetweenpostcodes();


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
	//$days_postcodes_array[$forloopdate_string]=$customer_postcodes;
	
	
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
var current_customer_postcode='<?php echo $current_customer_postcode; ?>';
var allowedtraveldistancebetweenpostcodes=<?php echo $allowedtraveldistancebetweenpostcodes; ?>;

console.log(fivedayspostcodes);
 
var recievd_postcodes=[];
var recievd_distances=[];
var recievd_time=[];
var autotimer;
var engg_id=<?php echo $engineer_id; ?>;
var service_id=<?php echo $servicecall_id; ?>;
var firstnearestdate='';


var availabledatesinddmmyyyy=[];
var availabledays=[];//can starts from 0 which will be day 1


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
	
	if ((x<considerdays))
	{
	d_array=[];
	d_array = fivedayspostcodes[x];
		if(d_array.length!=0)
		{
			var service = new google.maps.DistanceMatrixService();
			service.getDistanceMatrix(
			{
	/*
			origins: ['KA32SN', 'KA12NP'],
			destinations: ['PA12BE'],
	*/
			origins:[current_customer_postcode],
			destinations:d_array,

			travelMode: google.maps.TravelMode.DRIVING,
			unitSystem: google.maps.UnitSystem.IMPERIAL,
			avoidHighways: false,
			avoidTolls: false
			}, callback);
		}
		else
		{
				nearestdate=adddaystodate(x+1);///since x starts with 0
				console.log('There are no calls Booked on Day  '+nearestdate);
				availabledatesinddmmyyyy.push(nearestdate);
				availabledays.push(x);
		}
	x++;
	}
	else
	{	
		//x=0;
		filterdatabydistancebetweentwopostcodes();
		//alert('The system can only consider for '+considerdays+' days and plan. Please choose a date manually or leave call in logged state to book later.');
		showavailabledatesinddmmyyyy();
		clearInterval(autotimer);
	}		
}///end of function calculateDistance


function showavailabledatesinddmmyyyy()
{
		//console.log('------recievd_distances-----------'+recievd_distances);
		//console.log('------recievd_postcodes-----------'+recievd_postcodes);
		console.log('availablle days are availabledatesinddmmyyyy  '+availabledatesinddmmyyyy);
		console.log('availablle days are '+availabledays);
		
		if (recievd_postcodes.length!=0)
		{
			//we will call this 3 times to get the 3 options
			findthenextdaywithnearestpostcode();
			findthenextdaywithnearestpostcode();
			findthenextdaywithnearestpostcode();
		}
		else		
		{
			console.log('Recieve postcodes lenth 0. No postcodes were recieved or SENT');
		}
		
	
		firstslotmsg='first available day is '+availabledatesinddmmyyyy[0];
		secondslotmsg='Second available day is '+availabledatesinddmmyyyy[1];
		thirdslotmsg='Third available day is '+availabledatesinddmmyyyy[2];
		
		availabledatesinddmmyyyy=availabledatesinddmmyyyy.sort();
		availabledays=availabledays.sort();
		console.log('=============AFTER SORTING ========================');
		console.log(availabledatesinddmmyyyy);
		console.log(availabledays);
		
		createpreferecncebutton('0');
		createpreferecncebutton('1');
		createpreferecncebutton('2');
		
		setonclickforpreferreddatesbtn();
	
		
}//end of my fnc


function filterdatabydistancebetweentwopostcodes()
{
	/*
	recievd_distances
	recievd_postcodes
	allowedtraveldistancebetweenpostcodes
	*/
	for (var m=0;m<recievd_distances.length;m++)
	{
		console.log('Recieved Distances'+recievd_distances[m]);
		if (recievd_distances[m]>allowedtraveldistancebetweenpostcodes)
		{
			recievd_postcodes.splice(m, 1);
			recievd_distances.splice(m, 1);
		}
		else
		{
			document.getElementById('outputDiv').innerHTML+='<br>The nearest postcode to '+current_customer_postcode+' is '+recievd_postcodes[m]+' is '+recievd_distances[m]+' miles';
		}
	}//end of for`
	
	console.log('filtered Recieved Distances'+recievd_distances);
	console.log('filtered Recieved POSTCODES'+recievd_postcodes);
	
}//filterdatabydistancebetweentwopostcodes()

function findthenextdaywithnearestpostcode()
{	
	console.log('********************findthenextdaywithnearestpostcode***********************************');
	console.log(recievd_distances);	
	if (recievd_postcodes.length>0)
	{
		p=indexOfSmallest(recievd_distances);
		day_count=finddayofnearestpostcode(recievd_postcodes[p]);
		nearestdate=adddaystodate(day_count+1); ///since day starts with 0
		console.log(day_count,engg_id,service_id, nearestdate);
		if (arraycontains(availabledatesinddmmyyyy,nearestdate)==true)
		{	
			recievd_postcodes.splice(p, 1);
			recievd_distances.splice(p, 1);
			findthenextdaywithnearestpostcode();
		}else
		{		
			console.log('NEXT NEAREST DATE IS'+nearestdate);
			availabledays.push(day_count);			
			availabledatesinddmmyyyy.push(nearestdate);
			
		}	
	}
}///end of findthenextdaywithnearestpostcode


function setonclickforpreferreddatesbtn()
{
	document.getElementById('0preferecncebutton').onclick=selectthefirstavailableday;
	document.getElementById('1preferecncebutton').onclick=selectthesecondavailableday;
	document.getElementById('2preferecncebutton').onclick=selectthethirdavailableday;
}


function createpreferecncebutton(pref)
{
		document.getElementById('outputDiv').innerHTML+='<br> The '+pref+' Available Day for Booking is DAY <b>'+availabledatesinddmmyyyy[pref]+'</b>	';
		var firstpreferencebutton = document.createElement("input");
		firstpreferencebutton.id=pref+'preferecncebutton';
		firstpreferencebutton.name=pref+'preferecncebutton';
		firstpreferencebutton.type = "button";
		firstpreferencebutton.value = "Select";
		firstpreferencebutton.style = "margin:5px";
		document.getElementById('outputDiv').appendChild(firstpreferencebutton);
}//end of createfirstpreferecncebutton

function selectthefirstavailableday()
{
	console.log('selectthefirstavailableday SELECTEWD');
	createNewDiaryEntry(availabledatesinddmmyyyy[0]);
}///end of selectthefirstavailableday


 
function selectthesecondavailableday()
{
	console.log('selectthesecondavailableday SELECTEWD');
	createNewDiaryEntry(availabledatesinddmmyyyy[1]);

}///end of selectthesecondavailableday


 
function selectthethirdavailableday()
{
	console.log('THIRD preferecncebutton SELECTEWD');
	createNewDiaryEntry(availabledatesinddmmyyyy[3]);

}///endf of selectthethirdavailableday






////***==============================================================================*///
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
 
 
		/*
		outputDiv.innerHTML += 'PA12BE  to ' + destinations[j]
            + ': ' + results[j].distance.text + ' in '
            + results[j].duration.text + '<br>';
		*/
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
		}, 1000);
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
			//foundonday=parseInt(day)+1;//deactivated by SUDEEP TALATI
			foundonday=parseInt(day);
			return foundonday;
		}

		
	}////for (t=0;t<data[key].length;t++)
 
  }///end of if (data.hasOwnProperty(key)) {
 
}///end of for (var key in data) 

}





function createNewDiaryEntry(dateofappointment)
{
		alert ('createNewDiaryEntry Called');
 
		var urlToCreate ='<?php echo Yii::app()->getBaseUrl(); ?>'+'/index.php?r=api/createNewDiaryEntry&start_date='+dateofappointment+'&engg_id='+engg_id+'&service_id='+service_id;
		//alert(urlToCreate);
	
		$.ajax
		 ({
	     	type: 'POST',
	        url: urlToCreate ,
	        cache: false,
	        modal: true,
	        success: function(data) 
	        { 
		    	alert('Appointment Created'+data);
				//location.href="baseUrl+'/index.php?r=servicecall/view&id="+service_id;
		    },
	        error: function()
	        {
		        alert("ERROR");
	        },
	        
	     });//end of AJAX.
	     
}//end of createNewDiaryEntry().
    
//function finddayofnearestdate(nearestday)
function adddaystodate(no_of_days)
{
	var today = new Date();
	var nearestdate = new Date(today);
	nearestdate.setDate(today.getDate()+no_of_days);
	
	var dd = nearestdate.getDate();
	var mm = nearestdate.getMonth()+1; //January is 0!
	var yyyy = nearestdate.getFullYear();

	  
	rtn_date=dd+'-'+mm+'-'+yyyy;
	return rtn_date;
}

function arraycontains(a, obj) {
    var i = a.length;
    while (i--) {
       if (a[i] === obj) {
           return true;
       }
    }
    return false;
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

    
