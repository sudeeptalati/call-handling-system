<?php include('gomobile_menu.php'); ?>  

<?php
$servicecallmodel=Servicecall::model()->findByPk($model->servicecall_id);


$data=json_decode($model->comments);
//print_r($data);
//echo $data->report_findings;
echo "<br>";
//echo $data->workdone;
?>

<b>Servicecall Ref No:</b><?php echo $model->service_reference_number; ?>
<br>
<b>Customer Name:</b><?php echo $servicecallmodel->customer->fullname; ?>
 <br>
<b>Work Carried Out:</b><?php echo$data->workdone; ?>
<br>
<b>Report Findings:</b><?php echo$data->report_findings; ?>
 <br>
<b>Parts Used:</b>
<br>
<?php foreach ($data->parts as $parts)
						{
						echo $parts->partused."<br>";
						}
?>
