<?php
$this->breadcrumbs=array(
	'Setups'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Setup', 'url'=>array('index')),
	array('label'=>'Create Setup', 'url'=>array('create')),
	array('label'=>'Update Setup', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Setup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Setup', 'url'=>array('admin')),
);
?>

<h1>View Setup #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'company',
		'address',
		'town',
		'postcode_s',
		'postcode_e',
		'county',
		'country',
		'email',
		'telephone',
		'mobile',
		'alternate',
		'fax',
		'postcodeanywhere_account_code',
		'postcodeanywhere_license_key',
		'website',
		'vat_reg_no',
		'company_number',
		'postcode',
		'custom5',
	),
)); ?>
