<?php
$this->breadcrumbs=array(
	'Servicecalls'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Servicecall', 'url'=>array('index')),
	array('label'=>'Create Servicecall', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('servicecall-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Servicecalls</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'servicecall-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'service_reference_number',
		'customer_id',
		'product_id',
		'contract_id',
		'engineer_id',
		/*
		'insurer_reference_number',
		'job_status_id',
		'fault_date',
		'fault_code',
		'fault_description',
		'engg_visit_date',
		'work_carried_out',
		'spares_used_status_id',
		'total_cost',
		'vat_on_total',
		'net_cost',
		'job_payment_date',
		'job_finished_date',
		'notes',
		'created_by_user_id',
		'created',
		'modified',
		'cancelled',
		'closed',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
