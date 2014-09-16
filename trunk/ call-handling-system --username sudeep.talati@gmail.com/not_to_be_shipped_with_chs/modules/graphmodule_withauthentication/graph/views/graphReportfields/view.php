<?php
/* @var $this GraphReportfieldsController */
/* @var $model GraphReportfields */

$this->breadcrumbs=array(
	'Graph Reportfields'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GraphReportfields', 'url'=>array('index')),
	array('label'=>'Create GraphReportfields', 'url'=>array('create')),
	array('label'=>'Update GraphReportfields', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GraphReportfields', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GraphReportfields', 'url'=>array('admin')),
);
?>

<h1>View GraphReportfields #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'report_type',
		'field_name',
		'field_type',
		'field_relation',
		'field_label',
		'sort_order',
		'active',
	),
)); ?>
