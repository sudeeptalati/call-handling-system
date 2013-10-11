<?php
$this->breadcrumbs=array(
	'Retailers And Distributors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RetailersAndDistributors', 'url'=>array('index')),
	array('label'=>'Create RetailersAndDistributors', 'url'=>array('create')),
	array('label'=>'Update RetailersAndDistributors', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RetailersAndDistributors', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RetailersAndDistributors', 'url'=>array('admin')),
);
?>

<h1>View RetailersAndDistributors #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'company',
		'companytype',
		'address',
		'town',
		'postcode',
		'telephone',
		'created',
	),
)); ?>
