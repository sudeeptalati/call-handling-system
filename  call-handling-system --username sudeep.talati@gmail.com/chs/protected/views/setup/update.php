<?php
$this->breadcrumbs=array(
	'Setups'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Setup', 'url'=>array('index')),
	array('label'=>'Create Setup', 'url'=>array('create')),
	array('label'=>'View Setup', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Setup', 'url'=>array('admin')),
);
?>

<h1>Update Setup <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>