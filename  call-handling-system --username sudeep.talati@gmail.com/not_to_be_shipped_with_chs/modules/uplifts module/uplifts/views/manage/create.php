<?php
$this->breadcrumbs=array(
	'Uplifts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Uplifts', 'url'=>array('index')),
	array('label'=>'Manage Uplifts', 'url'=>array('admin')),
);
?>

<h1>Create Uplifts</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>