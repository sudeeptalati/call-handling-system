<?php
/* @var $this GmJsonFieldsController */
/* @var $model GmJsonFields */

$this->breadcrumbs=array(
	'Gm Json Fields'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GmJsonFields', 'url'=>array('index')),
	array('label'=>'Manage GmJsonFields', 'url'=>array('admin')),
);
?>

<h1>Create GmJsonFields</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>