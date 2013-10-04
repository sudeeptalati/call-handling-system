<?php
$this->breadcrumbs=array(
	'Oows'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Oow', 'url'=>array('index')),
	array('label'=>'Manage Oow', 'url'=>array('admin')),
);
?>

<h1>Create Oow</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>