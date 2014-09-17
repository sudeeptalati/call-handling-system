<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);

////calling servicecall model and filtering the data which has job status id as remotely booked(2)
$model=Servicecall::model()->findAll('job_status_id=:job_status_id',array('job_status_id'=>2));
//print_r ($model);
$foreacharray=array();
foreach($model as $r) 
{ 
//print_r ($r);
$id=$r['id'];
$servicecall_model=Servicecall::model()->findByPk($id);

$servicecall_id=$servicecall_model->service_reference_number;
$job_status_id=$servicecall_model->job_status_id;
$created_by=$servicecall_model->created_by_user_id;
$modified=date('d-M-y',$servicecall_model->modified);
$created= date('d-M-y',$servicecall_model->created);



/////paasing the values to array
$myarray['id']=$id;
$myarray['servicecall_number']=$servicecall_id;


$servicecall=array();
$customer=array();
$customer['name']=$servicecall_model->customer->fullname;

$gm_json_fields_model=GmJsonFields::model()->findAll();
foreach($gm_json_fields_model as $p)
{
	$key=$p['field_relation'];
	$value=$servicecall_model->$p['field_relation'];
	
$servicecall[$key]=$value;
	
}

$myarray['servicecall']=$servicecall;
$myarray['customer']=$customer;

////passing data to json format
array_push($foreacharray,$myarray);
//echo "<br>";	
}///end of for each
$json_data=array('Details'=>$foreacharray);
echo json_encode($json_data);
?>
