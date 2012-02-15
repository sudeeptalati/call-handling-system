<?php
$this->breadcrumbs=array(
	'Enggdiaries'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Enggdiary', 'url'=>array('index')),
	array('label'=>'Create Enggdiary', 'url'=>array('create')),
	array('label'=>'Update Enggdiary', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Enggdiary', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Enggdiary', 'url'=>array('admin')),
);
?>

<h1>View Enggdiary #  <?php echo date('F d,Y',$model->visit_start_date); ?></h1>


<h2>Visit Date <?php //echo date()?></h2>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'engineer_id',
		'visit_start_date',
		
//		array('name'=>'visit_start_date',
//			//'type'=>'datetime',
//			'value'=>date('F d,Y',$data->visit_start_date),
//		),	
//
		
		
		'visit_end_date',
		'slots',
		'servicecall_id',
		'user_id',
		'created',
		'modified',
	),
)); ?>
