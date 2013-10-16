<?php
$this->breadcrumbs=array(
	'Uplifts Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UpliftsType', 'url'=>array('index')),
	array('label'=>'Manage UpliftsType', 'url'=>array('admin')),
);
?>

<h1>Create UpliftsType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>