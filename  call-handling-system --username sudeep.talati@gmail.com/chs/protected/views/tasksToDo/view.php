<?php
$this->breadcrumbs=array(
	'Tasks To Dos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TasksToDo', 'url'=>array('index')),
	array('label'=>'Create TasksToDo', 'url'=>array('create')),
	array('label'=>'Update TasksToDo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TasksToDo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TasksToDo', 'url'=>array('admin')),
);
?>

<h1>View TasksToDo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'task',
		'status',
		'msgbody',
		'subject',
		'send_to',
		//'created',
		array( 'name'=>'created', 'value'=>$model->created==null ? "":date("d-M-Y",$model->created)),
		//'scheduled',
		array( 'name'=>'scheduled', 'value'=>$model->scheduled==null ? "":date("d-M-Y",$model->scheduled)),
		//'executed',
		array( 'name'=>'executed', 'value'=>$model->executed==null ? "":date("d-M-Y",$model->executed)),
		//'finished',
		array( 'name'=>'finished', 'value'=>$model->finished==null ? "":date("d-M-Y",$model->finished)),
	),
)); ?>
