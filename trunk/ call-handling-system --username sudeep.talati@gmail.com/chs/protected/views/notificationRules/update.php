<?php
$this->breadcrumbs=array(
	'Notification Rules'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
// 	array('label'=>'List NotificationRules', 'url'=>array('index')),
// 	array('label'=>'Create NotificationRules', 'url'=>array('create')),
// 	array('label'=>'View NotificationRules', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'SetUp', 'url'=>array('/setup/1')),
	array('label'=>'Manage NotificationRules', 'url'=>array('admin')),
);
?>

<h1>Update NotificationRules <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>