<?php
$this->breadcrumbs=array(
	'Advance Settings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AdvanceSettings', 'url'=>array('index')),
	array('label'=>'Create AdvanceSettings', 'url'=>array('create')),
	array('label'=>'Update AdvanceSettings', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AdvanceSettings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AdvanceSettings', 'url'=>array('admin')),
);
?>

<h1>View AdvanceSettings #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parameter',
		'value',
	),
)); ?>
