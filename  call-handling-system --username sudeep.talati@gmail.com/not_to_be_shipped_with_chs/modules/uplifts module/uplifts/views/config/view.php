<?php
$this->breadcrumbs=array(
	'Uplifts Configs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UpliftsConfig', 'url'=>array('index')),
	array('label'=>'Create UpliftsConfig', 'url'=>array('create')),
	array('label'=>'Update UpliftsConfig', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UpliftsConfig', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UpliftsConfig', 'url'=>array('admin')),
);
?>

<h1>View UpliftsConfig #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'prefix',
		'start_from',
		'available_code',
	),
)); ?>
