<?php include('gomobile_menu.php'); ?>  

<table>
<tr>
<th>Ref No.</th>
<th>Customer Name</th>
<th>Customer Town</th>
<th>Customer Postcode</th>
<th>Fault Description</th>
<th>Engineer</th>
<th>Engineer Email</th>
</tr>

<b>Date Selected:</b>
<?php
//checking if the value is set to get
if(isset( $_GET['start_date']))
{
////today date times
	echo $_GET['start_date'];
	$start_date_starttime=$_GET['start_date']." 00:00";
	$sd=strtotime($start_date_starttime);
	$datetime = new DateTime($_GET['start_date']);
	$datetime->modify('+1 day');
	$start_date_endtime=$_GET['start_date']." 23:59";
	$ed=strtotime($start_date_endtime);
////end of today

///calling engineer model for the criteria of appointment date
	$enggdiary_model=new Enggdiary();
	$criteria=new CDbCriteria();
	$criteria->addBetweenCondition('visit_start_date', $sd, $ed);
		$active_data_for_server=new CActiveDataProvider($enggdiary_model, array(
										'criteria'=>$criteria,
										'pagination'=>false,
										));	
	$fd=$active_data_for_server->getData();///getting the data from criteria into variable fd
	$foreacharray=array();//declaring a blank array for storing all fields
	foreach ($fd as $f)	
	{
		$servicecall_model=Servicecall::model()->findByPk($f->servicecall_id);
		$service_reference_number=$servicecall_model->service_reference_number;
		$job_status_id=$servicecall_model->job_status_id;
		$created_by=$servicecall_model->created_by_user_id;
		$modified=$servicecall_model->modified;
		$created= $servicecall_model->created;
		$fault_description=$servicecall_model->fault_description;
		

		/////paasing the values to array
		$myarray['service_reference_number']=$service_reference_number;
		$myarray['gomobile_sentcall_id']=$servicecall_model->id;
		$servicecall=array();
		$customer=array();
		$customer['name']=$servicecall_model->customer->fullname;
		$customer['postcode']=$servicecall_model->customer->postcode;
		
		$gm_json_fields_model=Gmjsonfields::model()->findAll();
		foreach($gm_json_fields_model as $p)
		{
			$key=$p['field_relation'];
			$label=$p['field_label'];
			$type=$p['field_type'];
			if (strpos($key, '|')!== false)
			{
				$str_array = explode( '|', $key);
				//print_r($str_array);
				$value=$servicecall_model->$str_array[0]->$str_array[1];	
				//$servicecall[$key]=$value;///disabled to be visible as label			
				$servicecall[$label]=Gmjsonfields::model()->processDataFormat($value,$type);			
				//echo $servicecall_model->customer->town;			
			}
			else
			{
				//echo "<br>Its a FIELS ";
				$value=$servicecall_model->$p['field_relation'];
				//$servicecall[$key]=$value;///disabled to be visible as label			
				$servicecall[$label]=Gmjsonfields::model()->processDataFormat($value,$type);
			}
		}
		
		//$engineer_id=$servicecall_model->engineer_id;
		$engineer_email=$servicecall_model->engineer->contactDetails->email;
		$myarray['engineer_email']=$engineer_email;	
        $myarray['customer_fullname']=$servicecall_model->customer->fullname;	
        $myarray['customer_postcode']=$servicecall_model->customer->postcode;
        $myarray['customer_address']=$servicecall_model->customer->address_line_1." ".$servicecall_model->customer->address_line_2." ".$servicecall_model->customer->address_line_3." ".$servicecall_model->customer->town." ".$servicecall_model->customer->postcode;        
		//$myarray['engineer_id']=$engineer_id;
		$myarray['servicecall']=$servicecall;
		$myarray['customer']=$customer;
		////passing data to json format
		array_push($foreacharray,$myarray);
		//echo "<br>";	
		/////WE WILL PRINT VALUES HERE 

		?>
		<tr>
			<td><a href="<?php echo Yii::app()->request->baseUrl."/index.php?r=Servicecall/view&id=".$servicecall_model->id;?>"><?php echo $servicecall_model->service_reference_number;?></a></td>
			<td><?php echo $servicecall_model->customer->fullname; ?></td>
			<td><?php echo $servicecall_model->customer->town;?></td>
			<td><?php echo $servicecall_model->customer->postcode; ?></td>
			<td><?php echo $servicecall_model->fault_description; ?></td>
			<td><?php echo $servicecall_model->engineer->company." - ".$servicecall_model->engineer->fullname; ?></td>
			<td><?php echo $servicecall_model->engineer->contactDetails->email; ?></td>
		</tr>
		<?php
		}///end of foreach
		
		//echo $myarray['customer']['name'];
	$json_data=array('Details'=>$foreacharray);
	//echo json_encode($json_data);
	}
?>

</table>


<br><br><button onclick="post_data();">Sent To Mobile</button>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


<script>
function post_data() 
{

var data = <?php echo json_encode($json_data)?>;
json_data = JSON.stringify(data);
console.log(json_data);
$.ajax({
   url: 'http://www.rapportsoftware.co.uk/gomobileserver/gomobile/index.php?r=server/Getdatafromodule',
 ///  url: 'http://127.0.0.1/purva/call_handling/not_to_be_shipped_with_chs/modules/gomobile/gomobileServer/gomobile/index.php?r=server/Getdatafromodule', 
		 
	  type: 'post',
	/// data: {'start_date': '24-Jul-2014', 'end_date': '30-Jul-2014', 'weekdays':showweekdays},
	  data: {'jsonData':json_data},
	  success: function(data, status) {   
				alert("Following Servicecalls has been sent to server:"+data);
				console.log(data);
				///Call a Javascript Function
				setServicecallsStatus(data);
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
		alert("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call

			
			
//$.post("proto2.php", {'jsonData': json_data},function(data) {alert(data);});
}///end of function

function setServicecallsStatus(servicecalls)
{



$.ajax({
      url: 'index.php?r=gomobile/gmservicecalls/servicecallsenttogomobileserver',
      type: 'post',
	 // data: {'start_date': '24-Jul-2014', 'end_date': '30-Jul-2014', 'weekdays':showweekdays},
	  data: {'servicecall_ids':servicecalls},
	  success: function(data, status) {   
				alert("Success");
				window.location='<?php echo Yii::app()->request->baseUrl."/index.php?r=gomobile/gmservicecalls/admin" ?>';
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
		alert("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call



}

</script>

