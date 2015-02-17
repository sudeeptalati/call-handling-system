<?php
/* @var $this GomobileaccountController */
/* @var $model GomobileAccount */

$this->breadcrumbs=array(
	'Gomobile Accounts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GomobileAccount', 'url'=>array('index')),
	array('label'=>'Create GomobileAccount', 'url'=>array('create')),
	array('label'=>'View GomobileAccount', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GomobileAccount', 'url'=>array('admin')),
);
?>

<h1>Update GomobileAccount <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>