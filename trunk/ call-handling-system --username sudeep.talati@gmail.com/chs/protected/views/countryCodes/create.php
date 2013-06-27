<?php
$this->breadcrumbs=array(
	'Country Codes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CountryCodes', 'url'=>array('index')),
	array('label'=>'Manage CountryCodes', 'url'=>array('admin')),
);
?>

<h1>Create CountryCodes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>