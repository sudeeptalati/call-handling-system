<?php
$this->breadcrumbs=array(
	'Retailers And Distributors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RetailersAndDistributors', 'url'=>array('index')),
	array('label'=>'Create RetailersAndDistributors', 'url'=>array('create')),
	array('label'=>'View RetailersAndDistributors', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RetailersAndDistributors', 'url'=>array('admin')),
);
?>

<h1>Update RetailersAndDistributors <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>