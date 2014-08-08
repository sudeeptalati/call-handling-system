<h1><font color="#0094EF"> Graph: Service Calls by Day</font> </h1>
 <table style='width:600px;'>
	<tr>
		<td>
		<div id = "weekdays">
			<input type="checkbox" checked='' onclick="displayGraph()" value="1" id='monday_checkbox'> Monday
			<br>
			<input type="checkbox" checked='' onclick="displayGraph()" value="2" id='tuesday_checkbox'> Tuesday
			<br>
			<input type="checkbox" checked='' onclick="displayGraph()" value="3" id='wednesday_checkbox'> Wednesday
			<br>
			<input type="checkbox" checked='' onclick="displayGraph()"  value="4" id='thursday_checkbox'> Thursday
			<br>
			<input type="checkbox" checked='' onclick="displayGraph()" value="5" id='friday_checkbox'> Friday
			<br>
			<input type="checkbox"  onclick="displayGraph()"  value="6" id='saturday_checkbox'> Saturday
			<br>
			<input type="checkbox"  onclick="displayGraph()"  value="0" id='sunday_checkbox'> Sunday
		</div>
		</td>
		
		
		<td>
		
<?php
	if(isset($date_error))
{
	if($date_error == 1)
		$msg = "Please enter start date";
	elseif($date_error == 2)
		$msg = "End date is earlier to start date..!!! Please change end date";
	
	
	$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
			'id'=>'date_error',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Enter start date',
					'autoOpen'=>true,
			),
	));
	
	echo $msg;
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');

}
?>
		<h4><b>Start Date*</b></h4>
		<?php 					
			$first_date_of_year='1-1-'. date('Y', time());
			 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name'=>'custom_start_date',
			'value'=>$first_date_of_year,
		// additional javascript options for the date picker plugin
			'options'=>array(
				'showAnim'=>'fold',
				'dateFormat' => 'd-m-yy',
			),
			'htmlOptions'=>array(
				'style'=>'height:20px;'
			),
		));
		
		?>
		</td>
		
		<td>
		<h4><b>End Date*</b></h4>
		<?php
		$today = date('j-n-Y', time()); 
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	    'name'=>'custom_end_date',
		'value'=>$today,
		// additional javascript options for the date picker plugin
	    'options'=>array(
	        'showAnim'=>'fold',
			'dateFormat' => 'd-m-yy',
		),
	    'htmlOptions'=>array(
	        'style'=>'height:20px;'
	    ),
		));			
		?>
		<button type="button" onclick="displaycustomrangegraph()">Display Graph</button>
		
		</td>
	</tr>
</table> 

<!--including javascript for graph--> 
<!--<script src="js/Chart.js"></script>-->
<?php
$url = 	Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.graph.assets'));	
		Yii::app()->clientScript->registerScriptFile($url.'\js\Chart.js') ;
//echo $url;
?>

<div style="width:70%;margin-left: 30px"><div>
		<h3 id='chartLabel'></h3>
		<button type="button" onclick="displaylastweek()">Last week</button>
		<button type="button" onclick="displaylastmonth()">Last 30 Days</button>
		<button type="button" onclick="displaylastyear()">Last Year</button>
		<br><br>
		<canvas style="margin-left: 50px;width:600px;height:500px;background-color: #FFFFFF;" id="canvas"></canvas>
	 </div>
	 
</div>


<script>
 
 var graphData=[];
 var graphLabel=[];
 var start_date="";
 var end_date="";
 
 var monthNames = [ "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December" ];
 var chartLabel="";
 Chart.defaults.global.scaleBeginAtZero = true;
 var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
 var ctx = document.getElementById("canvas").getContext("2d");
 
 var lineChartData = {
			labels : ["January","February","March","April","May","June","July"],
			labels : graphLabel,
			animation: false,
			datasets : [
				{
					label: "My Second dataset",
					fillColor : "rgba(151,187,205,0.2)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
//					data :graphData
				}
			]

		}
 	var	myLineChart = new Chart(ctx).Line(lineChartData, {
			responsive: true
		});
	
 
 
window.onload = function(){
		displaylastweek();
	}///end of window.onloaD
 

function displayGraph()
{
	 ////first find the weekdays checked
	 showweekdays=setweekdays();

	 ///Second thing is to get the data from Ajax
	 $.ajax({
      url: 'index.php?r=graph/default/GetCustomDaysData',
      type: 'get',
	 // data: {'start_date': '24-Jul-2014', 'end_date': '30-Jul-2014', 'weekdays':showweekdays},
	  data: {'start_date':start_date, 'end_date': end_date, 'weekdays':showweekdays},
	  success: function(data, status) {   
				///step 3 Now Draw the Graph
				prepareGraphData(data);
				drawGraph();
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call
	
}/////function displayGraph
	
		
function prepareGraphData(data)
{	
	///emptying the previous data
	graphData=[];
	graphLabel=[];
	
	json_data=jQuery.parseJSON(data);
	
	for (var key in json_data) {
		if (json_data.hasOwnProperty(key)) {
			
			console.log(key + " -> " + json_data[key]);
			
			graphData.push(json_data[key]);
			graphLabel.push(key);
			
		}//end of if
	}///end of for
	
}///end of funct prepareGraphData()

	
function drawGraph(){
 
  lineChartData = {
			labels : graphLabel,
			 
			datasets : [ 
				{
					label: "Service Calls by Date",
					fillColor : "rgba(151,187,205,0.2)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					pointHitDetectionRadius : 2,
					
//					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
					data :graphData
					
				}
			]

		}
 
		destroymychart();
		myLineChart = new Chart(ctx).Line(lineChartData, {
			responsive: true
		});
		//window.myLine.destroy();
		document.getElementById("chartLabel").innerHTML = chartLabel;
		 
}///end of drawGraph


function displaylastweek()
{
	var today=new Date();
		
	var last7thday=new Date();
	
	last7thday.setDate(today.getDate() - 6);
	
	start_date=last7thday.getDate()+'-'+(last7thday.getMonth() + 1)+'-'+last7thday.getFullYear();
	end_date=today.getDate()+'-'+(today.getMonth() + 1)+'-'+today.getFullYear();
	
	//start_date='01-May-2014';
	//end_date='30-Jul-2014';
	document.getElementById("custom_start_date").value=start_date;
	document.getElementById("custom_end_date").value=end_date;
	chartLabel='Current Week - Last 7 Days';
	show_weekdays();
	displayGraph();
	
}//end of displaylastweek

	
function displaylastmonth()
{
	var today=new Date();
		
	var last30thday=new Date();
	
	last30thday.setDate(today.getDate() - 30);
	start_date=last30thday.getDate()+'-'+(last30thday.getMonth() + 1)+'-'+last30thday.getFullYear();
	//console.log('last30thday		:'+label30);
	end_date=today.getDate()+'-'+(today.getMonth() + 1)+'-'+today.getFullYear();
	//console.log('todays date		:'+label1);
	document.getElementById("custom_start_date").value=start_date;
	document.getElementById("custom_end_date").value=end_date;
	chartLabel='Last 30 Days';
	show_weekdays();
	displayGraph();
	
}//end of dispalylastmonth


function displaylastyear()
{
	var today=new Date();
	var last365thday=new Date();
	
	last365thday.setDate(today.getDate() - 364);
	start_date=last365thday.getDate()+'-'+(last365thday.getMonth() + 1)+'-'+last365thday.getFullYear();
	end_date=today.getDate()+'-'+(today.getMonth() + 1)+'-'+today.getFullYear();
	
	chartLabel=last365thday.getDate()+'-'+monthNames[last365thday.getMonth()]+'-'+last365thday.getFullYear();
	chartLabel=chartLabel+' To '+today.getDate()+'-'+monthNames[today.getMonth()]+'-'+today.getFullYear();
	document.getElementById("custom_start_date").value=start_date;
	document.getElementById("custom_end_date").value=end_date;
	hide_weekdays();
	
	displayGraph();
	
}//end of dispalylastyear


function destroymychart()
{
 		if (typeof(myLineChart)==='object')
		{
			myLineChart.destroy();
			myLineChart.clear();
		}//end of if
 
}//end of destroymychart()

	
function setweekdays()
 {
		var checked_weekdays="";

		if (document.getElementById("monday_checkbox").checked==true)
		{
			checked_weekdays=checked_weekdays+document.getElementById("monday_checkbox").value;
		}

		if (document.getElementById("tuesday_checkbox").checked==true)
		{
			checked_weekdays=checked_weekdays+document.getElementById("tuesday_checkbox").value;
		}
		
		if (document.getElementById("wednesday_checkbox").checked==true)
		{
			checked_weekdays=checked_weekdays+document.getElementById("wednesday_checkbox").value;
		}
		
		if (document.getElementById("thursday_checkbox").checked==true)
		{
			checked_weekdays=checked_weekdays+document.getElementById("thursday_checkbox").value;
		}
		
		if (document.getElementById("friday_checkbox").checked==true)
		{
			checked_weekdays=checked_weekdays+document.getElementById("friday_checkbox").value;
		}
		
		if (document.getElementById("saturday_checkbox").checked==true)
		{
			checked_weekdays=checked_weekdays+document.getElementById("saturday_checkbox").value;
		}
		
		if (document.getElementById("sunday_checkbox").checked==true)
		{
			checked_weekdays=checked_weekdays+document.getElementById("sunday_checkbox").value;
		}
		
		
		console.log('CHECKED WEEKDAYS 	*'+checked_weekdays);
		return checked_weekdays;
 }////end of function setWeekdays
  
 
//creating hide_weekdays
function hide_weekdays()
{
document.getElementById('weekdays').style.display = "none";
}//end of hide_weekdays


//creating show_weekdays
function show_weekdays()
{
document.getElementById('weekdays').style.display = "block";
}//end of show_weekdays


//creating function displaycustomrangegraph
function displaycustomrangegraph()
{
	custom_start_date=document.getElementById("custom_start_date").value;
	custom_end_date=document.getElementById("custom_end_date").value;
	
	start_date=custom_start_date;
	end_date=custom_end_date;
	console.log ("7777777"+custom_start_date);
	console.log ("44444444"+start_date);
	
	daysdifference();
	displayGraph();
	
}// end of displaycustomrangegraph


// creating function daysdifference
function daysdifference()
 {
 
 date1=start_date;
 date2=end_date;
 
 sdArr = date1.split("-");  // ex input "2010-01-18"
 d1=(sdArr[0]+ "-" +sdArr[1]+ "-" +sdArr[2]);
 //console.log(d1);
 
 edArr = date2.split("-");  // ex input "2010-01-18"
 d2=(edArr[0]+ "-" +edArr[1]+ "-" +edArr[2]);
 //console.log(d2);
 
 var a=new Date(sdArr[2],sdArr[1],sdArr[0]);
 var b=new Date(edArr[2],edArr[1],edArr[0]);
 var timeDiff =b.getTime() - a.getTime();
 var diffDays = Math.ceil((timeDiff / 86400000)); 
 //console.log("$&^&*(*(("+diffDays);
chartLabel=a.getDate()+'-'+monthNames[a.getMonth()-1]+'-'+a.getFullYear();
chartLabel=chartLabel+' To '+b.getDate()+'-'+monthNames[b.getMonth()-1]+'-'+b.getFullYear();

if (diffDays < 0)
{
alert ("End date is earlier to start date..!!! Please change end date");
exit;
}
if(diffDays < 60)
{
 	show_weekdays();
}
 else
 {
	hide_weekdays();
 }
 
 
}// end of daysdifference

</script>

 