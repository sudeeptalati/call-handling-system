<?php
$this->breadcrumbs=array(
	'Uplifts Configs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UpliftsConfig', 'url'=>array('index')),
	array('label'=>'Manage UpliftsConfig', 'url'=>array('admin')),
);
?>

<h1>Create UpliftsConfig</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>