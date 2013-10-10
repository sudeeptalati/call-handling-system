<?php
$this->breadcrumbs=array(
	'Addons'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Addons', 'url'=>array('index')),
	array('label'=>'Create Addons', 'url'=>array('create')),
	array('label'=>'View Addons', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Addons', 'url'=>array('admin')),
);
?>

<h1>Update Addons <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>