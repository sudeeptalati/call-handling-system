<?php
$this->breadcrumbs=array(
	'Model Numbers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ModelNumbers', 'url'=>array('index')),
	array('label'=>'Manage ModelNumbers', 'url'=>array('admin')),
);
?>

<h1>Create ModelNumbers</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>