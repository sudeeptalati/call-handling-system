<?php
/* @var $this PostDataController */
/* @var $model PostData */

$this->breadcrumbs=array(
	'Post Datas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PostData', 'url'=>array('index')),
	array('label'=>'Create PostData', 'url'=>array('create')),
	array('label'=>'View PostData', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PostData', 'url'=>array('admin')),
);
?>

<h1>Update PostData <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>