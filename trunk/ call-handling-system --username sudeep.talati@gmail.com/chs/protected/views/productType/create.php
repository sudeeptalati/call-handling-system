<?php
$this->breadcrumbs=array(
	'Product Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductType', 'url'=>array('index')),
	array('label'=>'Manage ProductType', 'url'=>array('admin')),
);
?>

<h1>Create ProductType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>