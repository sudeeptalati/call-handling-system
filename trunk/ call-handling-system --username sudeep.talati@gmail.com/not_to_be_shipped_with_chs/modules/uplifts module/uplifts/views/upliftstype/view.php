<?php
$this->breadcrumbs=array(
	'Uplifts Types'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List UpliftsType', 'url'=>array('index')),
	array('label'=>'Create UpliftsType', 'url'=>array('create')),
	array('label'=>'Update UpliftsType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UpliftsType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UpliftsType', 'url'=>array('admin')),
);
?>

<h1>View UpliftsType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'info',
		'created',
	),
)); ?>
