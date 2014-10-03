<?php
/* @var $this PostDataController */
/* @var $model PostData */

$this->breadcrumbs=array(
	'Post Datas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PostData', 'url'=>array('index')),
	array('label'=>'Create PostData', 'url'=>array('create')),
	array('label'=>'Update PostData', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PostData', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PostData', 'url'=>array('admin')),
);
?>

<h1>View PostData #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'data',
	),
)); ?>
