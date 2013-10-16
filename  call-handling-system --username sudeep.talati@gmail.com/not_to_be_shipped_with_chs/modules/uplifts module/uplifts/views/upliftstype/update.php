<?php
$this->breadcrumbs=array(
	'Uplifts Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UpliftsType', 'url'=>array('index')),
	array('label'=>'Create UpliftsType', 'url'=>array('create')),
	array('label'=>'View UpliftsType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UpliftsType', 'url'=>array('admin')),
);
?>

<h1>Update UpliftsType <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>