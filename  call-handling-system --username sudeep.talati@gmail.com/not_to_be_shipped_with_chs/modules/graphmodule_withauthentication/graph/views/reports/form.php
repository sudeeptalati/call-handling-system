<?php include('graph_menu.php'); ?>   

<?php
if (isset($_GET['engineer_id']))
	$engineer_id=$_GET['engineer_id'];
else
	$engineer_id='';

if (isset($_GET['job_status_id']))
	$job_status_id=$_GET['job_status_id'];
else
	$job_status_id='';

	

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$fault_dateStartDate='';
if (isset($_GET['fault_dateStartDate']))
	$fault_dateStartDate=$_GET['fault_dateStartDate'];

$fault_dateEndDate='';
if (isset($_GET['fault_dateEndDate']))
	$fault_dateEndDate=$_GET['fault_dateEndDate'];
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$jobPaymentStartDate='';
if (isset($_GET['jobPaymentStartDate']))
	$jobPaymentStartDate=$_GET['jobPaymentStartDate'];

$jobPaymentEndDate='';
if (isset($_GET['jobPaymentEndDate']))
	$jobPaymentEndDate=$_GET['jobPaymentEndDate'];
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$jobFinishedStartDate='';
if (isset($_GET['jobFinishedStartDate']))
	$jobFinishedStartDate=$_GET['jobFinishedStartDate'];

$jobFinishedEndDate='';
if (isset($_GET['jobFinishedEndDate']))
	$jobFinishedEndDate=$_GET['jobFinishedEndDate'];
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







//get servicecall model
//get lavbel
$servicecall_label=Servicecall::model()->attributeLabels();
$job_status_data = JobStatus::model()->getAllPublishedListdata();
$engg_data = Engineer::model()->getAllCompanyNames();	
$today = date('d-M-y', time()); 

?> 
 

<div style="padding:1em;background-color:#D0F2FF; width:60em;   border-top-left-radius: 25px;border-bottom-left-radius: 25px;">
<?php echo CHtml::beginForm('index.php?r=graph/reports/form','get'); 
?>

<input type='hidden' id='todays_date' name='todays_date' value='<?php echo $today; ?>'/>

<table>
	<tr>
		<td colspan='4'><b><?php echo $servicecall_label['fault_date']; ?></b></td>
	</tr>
	<tr>
		<td>Start Date*
			<?php 						  
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'name'=>'fault_dateStartDate',
				'value'=>$fault_dateStartDate,	
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'fold',
					'dateFormat' => 'd-M-y',
				),
				'htmlOptions'=>array(
					'style'=>'height:20px;',
					'onChange'=>'javascript:setTodaysDateInTextField("fault_dateEndDate");'
				),
			));
			
			?>
		</td><td>
		End Date*
		<?php
		
		
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name'=>'fault_dateEndDate',
			'value'=>$fault_dateEndDate,
			// additional javascript options for the date picker plugin
			'options'=>array(
				'showAnim'=>'fold',
				'dateFormat' => 'd-M-y',
				
			),
			'htmlOptions'=>array(
				'style'=>'height:20px;'
			),
		));			
		?>
		</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td colspan='4' ><hr><b><?php echo $servicecall_label['job_status_id']; ?></b>
		<?php
			
			echo CHtml::dropDownList('job_status_id',$job_status_id, $job_status_data, array('empty'=> 'All Status'));
		?>
		</td>
	</tr>
	<tr>
		<td colspan='4'><hr><b><?php echo $servicecall_label['engineer_id']; ?></b>
		<?php
			echo CHtml::dropDownList('engineer_id',$engineer_id, $engg_data,
									array('empty'=> 'All Engineers')
									);
		?>
		
		</td>
	</tr>
	<tr>
		<td colspan='4'><hr> <b><?php echo $servicecall_label['job_payment_date']; ?></b></td>
	</tr>
	<tr>
		<td>Start Date
			<?php 						  
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'name'=>'jobPaymentStartDate',
				'value'=>$jobPaymentStartDate,
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'fold',
					'dateFormat' => 'd-M-y',
				),
				'htmlOptions'=>array(
					'style'=>'height:20px;',
					'onChange'=>'javascript:setTodaysDateInTextField("jobPaymentEndDate");'
				),
			));
			
			?>
		</td><td>
		End Date
		<?php
	 
		
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name'=>'jobPaymentEndDate',
			'value'=>$jobPaymentEndDate,
			// additional javascript options for the date picker plugin
			'options'=>array(
				'showAnim'=>'fold',
				'dateFormat' => 'd-M-y',
				
			),
			'htmlOptions'=>array(
				'style'=>'height:20px;'
			),
		));			
		?>
		</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td colspan='4'><hr> <b><?php echo $servicecall_label['job_finished_date']; ?></b></td>
	</tr>
	<tr>
		<td>Start Date
			<?php 						  
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'name'=>'jobFinishedStartDate',
				'value'=>$jobFinishedStartDate,
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'fold',
					'dateFormat' => 'd-M-y',
				),
				'htmlOptions'=>array(
					'style'=>'height:20px;',
					'onChange'=>'javascript:setTodaysDateInTextField("jobFinishedEndDate");'
				),
			));
			
			?>
		</td><td>
		End Date
		<?php
		 
		
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name'=>'jobFinishedEndDate',
			'value'=>$jobFinishedEndDate,
			// additional javascript options for the date picker plugin
			'options'=>array(
				'showAnim'=>'fold',
				'dateFormat' => 'd-M-y',
				
			),
			'htmlOptions'=>array(
				'style'=>'height:20px;'
			),
		));			
		?>
		</td>
		<td></td>
		<td></td>
	</tr>
	
	<tr>
		<td colspan='4'><hr>
		<?php 
			echo CHtml::submitButton('Generate Report',array('name' => 'generate_report'));
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			echo CHtml::link('Reset',array('/graph/reports/form')); 
		?>
		</td>
	</tr>
	
</table>

<?php echo CHtml::endForm(); ?>
</div><!-- END OF FORM DIV -->

<?php
if(isset($_GET['generate_report']))///////SHOW THE FOLLOWING GRID ONLY IF FORM IS SUBMITTED
{
		$this->widget('zii.widgets.grid.CGridView',
						array(
							'dataProvider' => $active_data,
							'columns' => array(
								//'id', 
								//'id',
		//'service_reference_number',
		array(	'name'=>'service_reference_number',
				'value' => 'CHtml::link($data->service_reference_number, array("/Servicecall/view&id=".$data->id))',
		 		'type'=>'raw',
        ),
		//'customer_id',
		array('header' => 'Customer','name'=>'customer_name','value'=>'$data->customer->fullname'),
		array('name'=>'customer_town','value'=>'$data->customer->town'),
		array('header' => 'Postcode','name'=>'customer_postcode','value'=>'$data->customer->postcode'),
		//'product_id',
		array(	'header' => 'Product',
            	'name'=>'product_name',
				'value'=>'$data->product->brand->name." ".$data->product->productType->name',
				'filter'=>false
				),
			
		array('name'=>'model_number','value'=>'$data->product->model_number'),
		array('name'=>'serial_number','value'=>'$data->product->serial_number'),
		
		//'contract_id',
		//array('name'=>'contract_name','value'=>'$data->contract->name'),
		
		//'engineer_id',
		
	
		array(
			'name'=>'job_status_id',
			'value'=>'JobStatus::published_item("JobStatus",$data->job_status_id)',
		),

		array(
			'name'=>'engineer_id',
			'value'=>'Engineer::item("Engineer",$data->engineer_id)',
			'filter'=>Engineer::items('Engineer'),
		),
		
		array('name'=>'fault_date', 'value'=>'date("d-M-Y",$data->fault_date)'),
		array('name'=>'job_payment_date', 'value'=>'($data->job_payment_date)?date("d-M-Y",$data->job_payment_date):""' ),
		array('name'=>'job_finished_date', 'value'=>'($data->job_finished_date)?date("d-M-Y",$data->job_finished_date):""' ),
 
		
		
		),
			
		
			
		));

}////end of if(isset($_GET['generate_report']))		
?>


<script>

function setTodaysDateInTextField(field_id)
{
document.getElementById(field_id).value=document.getElementById("todays_date").value;
}///end of setTodaysDateInTextField("fault_dateEndDate")
</script>
 
