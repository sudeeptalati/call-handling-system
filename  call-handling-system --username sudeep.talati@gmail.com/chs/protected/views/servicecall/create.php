<?php
$this->breadcrumbs=array(
	//'Servicecalls'=>array('index'),
	'Create',
);

$this->menu=array(
//	array('label'=>'List Servicecall', 'url'=>array('index')),
	//array('label'=>'Recent Servicecalls', 'url'=>array('admin')),
);
?>

<h1>Create Servicecall</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>