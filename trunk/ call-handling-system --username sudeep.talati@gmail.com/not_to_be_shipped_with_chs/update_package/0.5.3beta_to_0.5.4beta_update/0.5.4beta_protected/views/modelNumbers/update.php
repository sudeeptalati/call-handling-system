<?php
$this->breadcrumbs=array(
	'Model Numbers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ModelNumbers', 'url'=>array('index')),
	array('label'=>'Create ModelNumbers', 'url'=>array('create')),
	array('label'=>'View ModelNumbers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ModelNumbers', 'url'=>array('admin')),
);
?>

<h1>Update ModelNumbers <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>