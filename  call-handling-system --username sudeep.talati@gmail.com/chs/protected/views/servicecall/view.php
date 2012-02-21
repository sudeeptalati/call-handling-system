<?php
$this->breadcrumbs=array(
	'Servicecalls'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Servicecall', 'url'=>array('index')),
	array('label'=>'Create Servicecall', 'url'=>array('create')),
	array('label'=>'Update Servicecall', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete Servicecall', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Servicecall', 'url'=>array('admin')),
);
?>

<h1>View Servicecall #<?php echo $model->id; ?></h1>
<div align="right">
<h4>Assign Engineer</h4>
<?php 
$url="/enggdiary/create/";
$action_url=$this->createUrl($url);
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'engdairy-form',
	'enableAjaxValidation'=>false,
	'action'=>$action_url,
	'method'=>'get',

)); ?>
<?php 

$EngineerModel=Engineer::model();

?>

<input type="hidden" name='service_id' value='<?php echo $model->id ;?>'>



<?php echo CHtml::submitButton('Add to dairy', array('service_id'=>$model->id)); ?>
<?php $this->endWidget(); ?>


</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'service_reference_number',
		//'customer_id',
		'customer.fullname',
		//'product_id',
		'product.productType.name',
		//'product.name',
		//'contract_id',
		'contract.name',
		//'engineer_id',
		'engineer.fullname',
		'insurer_reference_number',
		'job_status_id',
		'fault_date',
		'fault_code',
		'fault_description',
		'engg_diary_id',
		'work_carried_out',
		'spares_used_status_id',
		'total_cost',
		'vat_on_total',
		'net_cost',
		'job_payment_date',
		'job_finished_date',
		'notes',
		//'created_by_user_id',
		'createdByUser.username',
		'created',
		'modified',
		'cancelled',
		'closed',
	),
));?>


