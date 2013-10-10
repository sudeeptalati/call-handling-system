<?php
$this->breadcrumbs=array(
	'Uplifts Configs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UpliftsConfig', 'url'=>array('index')),
	array('label'=>'Create UpliftsConfig', 'url'=>array('create')),
	array('label'=>'View UpliftsConfig', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UpliftsConfig', 'url'=>array('admin')),
);
?>

<h1>Update UpliftsConfig <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>