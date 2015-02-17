<?php
/* @var $this GomobileaccountController */
/* @var $model GomobileAccount */

$this->breadcrumbs=array(
	'Gomobile Accounts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GomobileAccount', 'url'=>array('index')),
	array('label'=>'Create GomobileAccount', 'url'=>array('create')),
	array('label'=>'Update GomobileAccount', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GomobileAccount', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GomobileAccount', 'url'=>array('admin')),
);
?>

<h1>View GomobileAccount #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'gomobile_account_name',
		'company_name',
		'contact_email',
		'no_of_rapport_users',
		'no_of_engineers',
		'created_on',
		'last_modified_on',
	),
)); ?>
