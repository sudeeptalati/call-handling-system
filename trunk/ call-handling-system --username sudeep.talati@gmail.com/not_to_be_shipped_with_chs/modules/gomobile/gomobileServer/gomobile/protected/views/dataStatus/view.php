<?php
/* @var $this DataStatusController */
/* @var $model DataStatus */

$this->breadcrumbs=array(
	'Data Statuses'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List DataStatus', 'url'=>array('index')),
	array('label'=>'Create DataStatus', 'url'=>array('create')),
	array('label'=>'Update DataStatus', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DataStatus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DataStatus', 'url'=>array('admin')),
);
?>

<h1>View DataStatus #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
