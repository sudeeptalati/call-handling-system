<div class="form"> 
 <?php
 
 $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tasks-to-do-completeTasks-form',
	'enableAjaxValidation'=>false,
)); 

?>


<?php
echo "<br>Performing tasks.... Please wait.... Update messages will be displayed";
$baseUrl = Yii::app()->getBaseUrl();
//echo $baseUrl;

$tasksModel = TasksToDo::model()->findAll();
$total_tasks = count($tasksModel);
//echo "<br>Total count of table = ".$total_tasks;

?>


<script type="text/javascript">

baseUrl = "<?php echo $baseUrl; ?>";
	
function pass_value(id)
{
	//console.log('In pass_value function');
	//alert('In pass_value function');
	//var id = 1;
	console.log('\n passed id = '+id);
	var total_tasks = "<?php echo $total_tasks; ?>";
	console.log('\n Total tasks = '+total_tasks);
	
	 $.ajax({
                type: 'POST',
                url: baseUrl+"/index.php?r=TasksToDo/performTasks&id="+id,
				data: id,
                async: true,
                success:
                    function (data) 
					{
                        //do something - your long process is finished
						//alert(data);
						var div = document.getElementById('display_response_msg');
						
						div.innerHTML += data;
						div.scrollTop = div.scrollHeight;
						
						if(id == total_tasks)
						{
							alert('All tasks completed');
						}
					},//end of success function.
                error:
                    function () 
					{
						alert("Error in getting Tasks to Perform List");
                    }//end of error function.
										
               
					
            });//end of AJAX.
	
			
	
}//end of func pass_value.


</script>



	<?php
	
	if($total_tasks == 0)
	{
		echo "<span style='color:maroon'><br>No tasks to perform</span>";
	}
	else
	{
		$internet_available = '';
		$advanceSettingsModel = AdvanceSettings::model()->findAllByAttributes(array('parameter'=>'internet_connected'));
		
		foreach($advanceSettingsModel as $settings)
		{
			//echo "Name = ".$settings->name;
			//echo "<br>Value = ".$settings->value;
			$internet_available = $settings->value;
		}//end of advanced foreach.
		
		if($internet_available == 1)
		{
			foreach($tasksModel as $data)
			{
				$email_sent_status = '';
				//echo "<hr>Task Id = ".$data->id;
				$task_id = $data->id;
				//echo "<br>Task = ".$data->task;
				$task = $data->task;
				//echo "<br>Status = ".$data->status;
				$jobStatus = $data->status;
				//echo "<br>Msg body = ".$data->msgbody;
				$msgbody = $data->msgbody;
				//echo "<br>Subject = ".$data->subject;
				$subject = $data->subject;
				//echo "<br>Send to = ".$data->send_to;
				$send_to = $data->send_to;
				
				$id = $task_id;
				//echo "<br>";
				//********* Calling js function which calls AJAX ********
				echo "<script> pass_value(".$id."); </script>";
				
			}//end of foreach().
			
		}//end of if internet available.
		else
		{
			//echo "Internet not available";
			
			$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
				'id'=>'mydialog',
				// additional javascript options for the dialog plugin
				'options'=>array(
					'title'=>'Internet error',
					'autoOpen'=>true,
				),
			));

				echo 'Not able to connect to internet. Check internet settings';

			$this->endWidget('zii.widgets.jui.CJuiDialog');

		}//end of else, Internet not available.
		
	}//end of outer else.
		
	?>
<br><br>
<div id="display_response_msg" name="display_response_msg" style="background-color:#F5F6CE;overflow:scroll;width:500px; height:150px;">
</div>	
	
<?php $this->endWidget(); ?>


</div> <!-- form -->



