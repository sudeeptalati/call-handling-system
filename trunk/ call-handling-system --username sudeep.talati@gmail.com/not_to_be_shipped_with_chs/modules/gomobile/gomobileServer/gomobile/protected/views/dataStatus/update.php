<?php
/* @var $this DataStatusController */
/* @var $model DataStatus */

$this->breadcrumbs=array(
	'Data Statuses'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DataStatus', 'url'=>array('index')),
	array('label'=>'Create DataStatus', 'url'=>array('create')),
	array('label'=>'View DataStatus', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DataStatus', 'url'=>array('admin')),
);
?>

<h1>Update DataStatus <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>