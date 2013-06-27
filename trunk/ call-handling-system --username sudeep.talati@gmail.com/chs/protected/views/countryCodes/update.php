<?php
$this->breadcrumbs=array(
	'Country Codes'=>array('index'),
	$model->country_id=>array('view','id'=>$model->country_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CountryCodes', 'url'=>array('index')),
	array('label'=>'Create CountryCodes', 'url'=>array('create')),
	array('label'=>'View CountryCodes', 'url'=>array('view', 'id'=>$model->country_id)),
	array('label'=>'Manage CountryCodes', 'url'=>array('admin')),
);
?>

<h1>Update CountryCodes <?php echo $model->country_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>