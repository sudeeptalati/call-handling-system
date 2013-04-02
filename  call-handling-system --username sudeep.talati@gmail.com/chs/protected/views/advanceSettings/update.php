<?php
$this->breadcrumbs=array(
	'Advance Settings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AdvanceSettings', 'url'=>array('index')),
	array('label'=>'Create AdvanceSettings', 'url'=>array('create')),
	array('label'=>'View AdvanceSettings', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AdvanceSettings', 'url'=>array('admin')),
);
?>

<h1>Update AdvanceSettings <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>