<?php
$this->breadcrumbs=array(
	'Setups'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Change Logo', 'url'=>array('changeLogo')),
//	array('label'=>'Email Settings', 'url'=>array('emailSetup')),
	array('label'=>'About & Help', 'url'=>array('about')),
	array('label'=>'Restore Database', 'url'=>array('restoreDatabase')),
	
);

?>

<h1>Update Setup <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>