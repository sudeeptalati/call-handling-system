<?php
$this->breadcrumbs=array(
	'Product Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductType', 'url'=>array('index')),
	array('label'=>'Create ProductType', 'url'=>array('create')),
	array('label'=>'View ProductType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ProductType', 'url'=>array('admin')),
);
?>

<h1>Update ProductType <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('updateProductType', array('model'=>$model)); ?>