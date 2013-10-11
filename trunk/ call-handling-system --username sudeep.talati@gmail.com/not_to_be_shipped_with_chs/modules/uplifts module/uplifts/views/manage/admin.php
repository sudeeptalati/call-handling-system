<?php
$this->breadcrumbs=array(
	'Uplifts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Uplifts', 'url'=>array('index')),
	array('label'=>'Create Uplifts', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('uplifts-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Uplifts</h1>

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
	'id'=>'uplifts-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'uplift_number',
		'prefix_id',
		'servicecall_id',
		'customer_id',
		'product_id',
		/*
		'product_type_id',
		'retailer_id',
		'retailer_contact',
		'retailer_phone',
		'distributor_id',
		'visited_engineer_id',
		'visited_engineer_name',
		'date_of_call',
		'reason_for_uplift',
		'request_type_id',
		'model_number',
		'serial_number',
		'index_number',
		'purchase_date',
		'exchange_date',
		'authorised_by',
		'price',
		'customer_claim_description',
		'notes',
		'created',
		'modified',
		'created_by',
		'modified_by',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
