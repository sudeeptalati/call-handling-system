<?php
/* @var $this DataStatusController */
/* @var $model DataStatus */

$this->breadcrumbs=array(
	'Data Statuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DataStatus', 'url'=>array('index')),
	array('label'=>'Manage DataStatus', 'url'=>array('admin')),
);
?>

<h1>Create DataStatus</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>