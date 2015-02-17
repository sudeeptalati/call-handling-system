<?php
/* @var $this GomobileaccountController */
/* @var $model GomobileAccount */

$this->breadcrumbs=array(
	'Gomobile Accounts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GomobileAccount', 'url'=>array('index')),
	array('label'=>'Manage GomobileAccount', 'url'=>array('admin')),
);
?>

<h1>Create GomobileAccount</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>