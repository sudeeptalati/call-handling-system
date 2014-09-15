<?php
/* @var $this GmJsonFieldsController */
/* @var $model GmJsonFields */

$this->breadcrumbs=array(
	'Gm Json Fields'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GmJsonFields', 'url'=>array('index')),
	array('label'=>'Create GmJsonFields', 'url'=>array('create')),
	array('label'=>'Update GmJsonFields', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GmJsonFields', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GmJsonFields', 'url'=>array('admin')),
);
?>

<h1>View GmJsonFields #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'field_type',
		'field_relation',
		'field_label',
		'sort_order',
		'active',
		'created',
	),
)); ?>
