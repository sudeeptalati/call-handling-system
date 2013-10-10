<?php
$this->breadcrumbs=array(
	'Retailers And Distributors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RetailersAndDistributors', 'url'=>array('index')),
	array('label'=>'Manage RetailersAndDistributors', 'url'=>array('admin')),
);
?>

<h1>Create RetailersAndDistributors</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>