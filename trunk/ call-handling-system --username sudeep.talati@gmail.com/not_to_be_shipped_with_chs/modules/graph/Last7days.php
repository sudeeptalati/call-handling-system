

		<input type="checkbox" checked='true' value="1"> Monday
		<br>
		<input type="checkbox" checked='true' value="2"> Tuesday
		<br>
		<input type="checkbox" checked='true'value="3"> Wednesday
		<br>
		<input type="checkbox" checked='true' value="4"> Thursday
		<br>
		<input type="checkbox" checked='true' value="5"> Friday
		<br>
		<input type="checkbox" value="6"> Saturday
		<br>
		<input type="checkbox" value="0"> Sunday
	
	

<?php

$weekdays = array('0', '1', '2', '3', '4', '5', '6');




?>	
	

	<?php


$fault_date=date('d-m-Y');
$today_time=strtotime($fault_date);
$yest_date=date('d-m-Y', strtotime("-1 days"));
$yestrdy_date=strtotime($yest_date);
//echo date('d-m-y',$fault_date-1);
$model=Servicecall::model()->countByAttributes(array('fault_date'=>$today_time));
$model1=Servicecall::model()->countByAttributes(array('fault_date'=>$yestrdy_date));
//echo $model1;
$array=array(array($model,$fault_date),array($model1,$yest_date),array(143,'august'),array(159,'september'));

$this->widget('jqBarGraph',
array('values'=>$array,
'type'=>'simple',
'width'=>200,
'color1'=>'#122A47',
'color2'=>'#1B3E69',
'space'=>5,
'title'=>'simple graph'));

// set current date
$date = date('d-m-Y-l');
//echo $date;
// parse about any English textual datetime description into a Unix timestamp
$ts = strtotime($date);

$graph_array_main=array();




	

	
	
for($i = 6; $i >= 0; $i--) 
{
$time_string=date('d-m-Y', strtotime("-$i days"));
$time_string_label=date('d-m-Y-l', strtotime("-$i days"));
$time= strtotime($time_string);


$current_weekday_no_format=date('w', strtotime("-$i days"));
 

	if (in_array($current_weekday_no_format, $weekdays))
	{

		$no_of_calls=Servicecall::model()->countByAttributes(array('fault_date'=>$time));
		$temp=array($no_of_calls, $time_string_label);
		array_push($graph_array_main,$temp);
		
		
		//array_push($labels,$time_string_label);
		//array_push($calls,$no_of_calls);
		
		
		
	}
  

}/////END OF FOR LOOP
//print_r($graph_array_main);


 
$yr_st=strtotime('01-01-2014');
//echo $yr_st;

$arr=array();

//$record =CHtml::listData(Servicecall::model()->findAll(array('condition'=>'fault_date>=1405461600','order'=>"`fault_date` ASC")), 'id', 'fault_date');
$record =CHtml::listData(Servicecall::model()->findAll(array('condition'=>'fault_date>=1378418400','order'=>"`fault_date` ASC")), 'id', 'fault_date');

foreach ($record as $r)
{	
	//echo '<br>'.$r;
	array_push($arr,date('d-M-Y', $r));
}
$record=$arr;

//print_r($record);




//print_r($graph_array_main);
$this->widget('jqBarGraph',
array('values'=>$graph_array_main,
'type'=>'simple',
'width'=>600,
'color1'=>'#FFB33C',
'color2'=>'#ADE8C4',
'space'=>5,
'title'=>'Last 7days Graph'));


/*
$this->widget('zii.widgets.grid.CGridView', array('value'=>$graph_array_main,
			'filter'=>$graph_array_main));
	*/		


	

?>

<script src="js/Chart.js"></script>

<div style="width:40%">
			 
				<canvas id="canvas" height="450" width="600"></canvas>
			 
</div>
<script>

function getLast7DaysData(json_data)
{		
	///setting up the parameters
	no_of_calls=[]; ////creating blank array for no_of_calls
	for (i=0;i<7;i++)
	{
		no_of_calls[i]=0;///setting up the size of the array and initiating with 0
	}
	
	var today=new Date();
	today.setHours(0, 0, 0, 0);
	
	var last6thday=new Date();
	
	last6thday.setHours(0, 0, 0, 0);
	last6thday.setDate(today.getDate() - 6);
	console.log('last6thday		:'+last6thday);
				
				
	
	for (var key in json_data) {
		if (json_data.hasOwnProperty(key)) {
		
			console.log(key + " -> " + json_data[key]);

			var value=rec_json[key];
			var d= new Date(value);
			d.setHours(0, 0, 0, 0);
			
			if (d<=today && d>=last6thday )
			{
				
				daysdiff=today.getDate()-d.getDate();
				console.log('Days Diff:	'+daysdiff);
				no_of_calls[daysdiff]=no_of_calls[daysdiff]+1;
			}
				
		}//end of if
	}//end of for
	
	console.log('in FUNCT'+no_of_calls[0]);
	return no_of_calls;
}///end of function getLast7DaysData


function get7DaysLabel()
{
		var days_labels=[];
		var days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
		
		for (i=0;i<7;i++)
		{	
			var label_date = new Date();
			label_date.setHours(0,0,0,0);
			label_date.setDate(new Date().getDate() - i);
			
			graph_label=days[label_date.getDay()];
			console.log(graph_label+' : '+no_of_calls[i]);
			days_labels[i]=graph_label;
		}
		
		return days_labels;
	
}///end of get7DaysLabel

 
 function getLast30DaysData(json_data)
{		
	///setting up the parameters
	no_of_calls=[]; ////creating blank array for no_of_calls
	for (i=0;i<31;i++)
	{
		no_of_calls[i]=0;///setting up the size of the array and initiating with 0
	}
	
	var today=new Date();
	today.setHours(0, 0, 0, 0);
	
	var last30thday=new Date();
	
	last30thday.setHours(0, 0, 0, 0);
	last30thday.setDate(today.getDate() - 30);
	console.log('---------last30thday		:'+last30thday);
 
}
//end of last30days
 



		var rec_json=<?php echo json_encode($record );?>;
		//console.log( JSON.stringify(rec_json) );
		

		
		getLast30DaysData(rec_json);
		
		
		///initiating garr
		var no_of_calls=getLast7DaysData(rec_json);
		var days_labels=get7DaysLabel();
		
		console.log(no_of_calls[1]);
		
	
		/*	
		var today=new Date();
		var today_date = today.getDate();
		var today_day = today.getDay();
		var today_month = today.getMonth(); //Months are zero based
		var today_year = today.getFullYear();
		today.setHours(0, 0, 0, 0);	
 
	
		for (var key in rec_json) {
			if (rec_json.hasOwnProperty(key)) {
				
				console.log(key + " -> " + rec_json[key]);
				
				var x = rec_json[key]*1000;
				var value=rec_json[key];
				var d= new Date(value);
				var curr_date = d.getDate();
				var curr_day = d.getDay();
				var curr_month = d.getMonth() + 1; //Months are zero based
				var curr_year = d.getFullYear();
				d.setHours(0, 0, 0, 0);
				
				
				//console.log(curr_day+' : '+curr_date + "-" + curr_month + "-" + curr_year);
 
					
				var d1 = new Date();
				d1.setHours(0,0,0,0);
				console.log('Today 			:'+d1);

				var d2 = 	;
				d2.setHours(0,0,0,0);
				d2.setDate(d1.getDate() - 1);
				console.log('Yesterday		:'+d2);
				
				console.log('From JSOn 		:'+d);
				
				
			
				console.log('JSON TIME STAMP:  '+d.getTime());
				console.log('KAL  TIME STAMP:  '+d2.getTime());
				console.log('AAJ  TIME STAMP:  '+d1.getTime());
								
				
				if (d.getTime()==d1.getTime())
				{
					console.log('MATCHED');
					no_of_calls[1]=no_of_calls[1]+1;
				}

				
				
	


			}
		}///end of for
		
		*/
	 	
		
	
	
	
		var jArray= <?php echo json_encode($weekdays ); ?>;
/*
		for(var i=0;i<6;i++)
		{
		   console.log(jArray[i]);
		}
*/


		var days=days_labels;
		var calls=no_of_calls;
		
		
	 	var lineChartData = {
			labels :days,
			datasets : [
		 
				{
					label: "My Data",
					fillColor : "rgba(151,187,205,0.2)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data :calls
					
				}
			]

		}

	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myLine = new Chart(ctx).Line(lineChartData, {
			responsive: true
		});
	}


	</script>			
