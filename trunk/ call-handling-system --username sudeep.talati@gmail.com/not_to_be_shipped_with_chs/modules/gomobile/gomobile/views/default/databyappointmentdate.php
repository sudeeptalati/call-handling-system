<?php include('gomobile_menu.php'); 

 

?>  
<h2>Send Data</h2>
<?php
echo CHtml::beginForm('index.php?r=gomobile/default/postdatatoserver','get'); 
//$start_date=$_GET['start_date'];
?>
		<table>		<td>		<h4><b>Select Appointment Date</b></h4>
						<?php 					
							
							$this->widget('zii.widgets.jui.CJuiDatePicker', array(
							'name'=>'start_date',
							//'value'=>$first_date_of_year,
						// additional javascript options for the date picker plugin
							'options'=>array(
								'showAnim'=>'fold',
								'dateFormat' => 'd-m-yy',
								'timeFormat'=>'hh:mm',
							),
							'htmlOptions'=>array(
								'style'=>'height:20px;'
							),
						));
						
					
								$today=date('d-m-Y');
								$datetime = new DateTime(date('d-m-Y', time()));
								$datetime->modify('+1 day');
								//$datetime->format('d-m-Y');
								$tomorrow=$datetime->format('d-m-Y');
								//echo $tomorrow;
								
								//print_r(Yii::app()->request->baseUrl);
							?>
				
					
<?php

/*
$jobstatusmodel = Jobstatus::model()->findAll(
                 "published=1");
$published_jobstatus_list = CHtml::listData($jobstatusmodel, 
                'id', 'name');


echo CHtml::dropDownList('jobstatus_postdatatoserver','',$servicecall_id_array);
echo "<br><br>";*/
//echo CHtml::submitButton('Send To Server',array('name' => $servicecall_id_array[0]));

echo "<br><br>".CHtml::submitButton('Show Servicecalls');			
echo CHtml::endForm();////end of form

?>

&nbsp;&nbsp;&nbsp;<a href="<?php echo Yii::app()->request->baseUrl."/index.php?r=gomobile/default/postdatatoserver&start_date=".$today;?>">
<input type='button' value='Show Appointments for Today'>
</a>
&nbsp;&nbsp;&nbsp;<a href="<?php echo Yii::app()->request->baseUrl."/index.php?r=gomobile/default/postdatatoserver&start_date=".$tomorrow;?>">
<input type='button' value='Show Appointments for Tomorrow'>
</a>

