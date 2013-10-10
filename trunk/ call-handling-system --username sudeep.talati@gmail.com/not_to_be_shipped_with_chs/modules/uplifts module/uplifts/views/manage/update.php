<?php
$this->breadcrumbs=array(
	'Uplifts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Uplifts', 'url'=>array('index')),
	array('label'=>'Create Uplifts', 'url'=>array('create')),
	array('label'=>'View Uplifts', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Uplifts', 'url'=>array('admin')),
);
?>

<h1>Update Uplifts <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>