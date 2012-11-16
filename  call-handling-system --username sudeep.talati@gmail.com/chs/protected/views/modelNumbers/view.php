<?php
$this->breadcrumbs=array(
	'Model Numbers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ModelNumbers', 'url'=>array('index')),
	array('label'=>'Create ModelNumbers', 'url'=>array('create')),
	array('label'=>'Update ModelNumbers', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ModelNumbers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ModelNumbers', 'url'=>array('admin')),
);
?>

<h1>View ModelNumbers #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'model_number',
		'brand_id',
		'product_type_id',
	),
)); ?>
