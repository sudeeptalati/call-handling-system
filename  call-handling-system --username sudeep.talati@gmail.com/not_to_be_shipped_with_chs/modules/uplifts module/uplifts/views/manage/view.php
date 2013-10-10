<?php
$this->breadcrumbs=array(
	'Uplifts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Uplifts', 'url'=>array('index')),
	array('label'=>'Create Uplifts', 'url'=>array('create')),
	array('label'=>'Update Uplifts', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Uplifts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Uplifts', 'url'=>array('admin')),
);
?>

<h1>View Uplifts #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uplift_number',
		'prefix_id',
		'servicecall_id',
		'customer_id',
		'product_id',
		'product_type',
		'retailer',
		'distributor',
		'visited_engineer_id',
		'visited_engineer_name',
		'date_of_call',
		'reason_for_uplift',
		'request_type',
		'model_number',
		'serial_number',
		'index_number',
		'date_of_purchase',
		'authorised_by',
		'postcode',
		'customer_claim_description',
		'notes',
		'created',
		'modified',
		'created_by',
		'modified_by',
	),
)); ?>
