<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	//array('label'=>'Create Product', 'url'=>array('create')),
);
?>

<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('product-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Products</h1>

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
	'id'=>'product-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		//'contract_id',
		array( 'name'=>'contracter_name', 'value'=>'$data->contract->name' ),
		//'brand_id',
		array( 'name'=>'brand_name', 'value'=>'$data->brand->name' ),
		//'product_type_id',
		array( 'name'=>'product_name', 'value'=>'$data->productType->name' ),
		//'customer_id',
		array('name'=>'customer_name', 'value'=>'$data->customer->fullname'),
		//'engineer_id',
		//array( 'name'=>'engineer_name', 'value'=>'$data->engineer->fullname' ),
		array(
			'name'=>'engineer_id',
			'value'=>'Engineer::item("Engineer",$data->engineer_id)',
			'filter'=>Engineer::items('Engineer'),
		),
		//'created_by_user',
		array( 'name'=>'created_by_user', 'value'=>'$data->createdByUser->username' ),
		/*
		'purchased_from',
		'purchase_date',
		'warranty_date',
		'model_number',
		'serial_number',
		'production_code',
		'enr_number',
		'fnr_number',
		'discontinued',
		'warranty_for_months',
		'purchase_price',
		'notes',
		'created_by_user_id',
		'created',
		'modified',
		'cancelled',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
		),
	),
));
?>
