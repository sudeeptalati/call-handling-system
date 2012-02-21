<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	//array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Update Product', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Product', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
);
?>

<h1>View Product #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		//'contract_id',
		'contract.name',
		//'brand_id',
		'brand.name',
		//'product_type_id',
		'productType.name',
		//'customer_id',
		'customer.fullname',
		//'engineer_id',
		'engineer.fullname',
		'purchased_from',
		//'purchase_date',
		array(
				'name'=>'Purchase Date',
				'value'=>date('d-M-y',$model->purchase_date),
		),
		//'warranty_date',
		array(
				'name'=>'Warranty Date',
				'value'=>date('d-M-y',$model->warranty_date),
		),
		'model_number',
		'serial_number',
		'production_code',
		'enr_number',
		'fnr_number',
		'discontinued',
		'warranty_for_months',
		'purchase_price',
		'notes',
		//'created_by_user_id',
		'createdByUser.username',
		//'created',
		array(
				'name'=>'Created',
				'value'=>date('d-M-y',$model->created),
		),
		'modified',
		'cancelled',
	),
)); ?>
