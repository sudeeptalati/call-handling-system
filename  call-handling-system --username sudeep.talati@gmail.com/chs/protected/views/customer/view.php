<?php
$this->breadcrumbs=array(
	'Customers'=>array('index'),
	$model->title,
);

$this->menu=array(
//	array('label'=>'List Customer', 'url'=>array('index')),
	array('label'=>'Create Customer', 'url'=>array('create')),
	array('label'=>'Update Customer', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Customer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Customer', 'url'=>array('admin')),
);
?>

<h1>View Customer #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'first_name',
		'last_name',
		'product_id',
		'address_line_1',
		'address_line_2',
		'address_line_3',
		'town',
		'postcode',
		'country',
		'telephone',
		'mobile',
		'fax',
		'email',
		'notes',
		//'created_by_user_id',
		'createdByUser.username',
		//'created',
		array(
				'name'=>'Created',
				'value'=>date('d-M-y',$model->created),
		),
		'modified',
	),
)); ?>
