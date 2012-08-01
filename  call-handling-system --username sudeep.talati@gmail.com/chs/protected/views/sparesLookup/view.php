<?php
$this->breadcrumbs=array(
	'Spares Lookups'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SparesLookup', 'url'=>array('index')),
	array('label'=>'Create SparesLookup', 'url'=>array('create')),
	array('label'=>'Update SparesLookup', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SparesLookup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SparesLookup', 'url'=>array('admin')),
);
?>

<h1>View SparesLookup #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'url',
		'ftp_username',
		'ftp_password',
		'ftp_port',
	),
)); ?>
