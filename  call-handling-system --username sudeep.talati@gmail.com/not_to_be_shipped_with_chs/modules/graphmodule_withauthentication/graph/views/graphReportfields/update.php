<?php
/* @var $this GraphReportfieldsController */
/* @var $model GraphReportfields */

$this->breadcrumbs=array(
	'Graph Reportfields'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GraphReportfields', 'url'=>array('index')),
	array('label'=>'Create GraphReportfields', 'url'=>array('create')),
	array('label'=>'View GraphReportfields', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GraphReportfields', 'url'=>array('admin')),
);
?>

<h1>Update GraphReportfields <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>