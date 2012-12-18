<?php
$this->breadcrumbs=array(
	'Notification Rules'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List NotificationRules', 'url'=>array('index')),
	array('label'=>'SetUp', 'url'=>array('/setup/1')),
	array('label'=>'Manage NotificationRules', 'url'=>array('admin')),
);
?>

<h1>Create NotificationRules</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>