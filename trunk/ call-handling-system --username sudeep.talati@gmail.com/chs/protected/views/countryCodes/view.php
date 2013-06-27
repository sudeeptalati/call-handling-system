<?php
$this->breadcrumbs=array(
	'Country Codes'=>array('index'),
	$model->country_id,
);

$this->menu=array(
	array('label'=>'List CountryCodes', 'url'=>array('index')),
	array('label'=>'Create CountryCodes', 'url'=>array('create')),
	array('label'=>'Update CountryCodes', 'url'=>array('update', 'id'=>$model->country_id)),
	array('label'=>'Delete CountryCodes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->country_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CountryCodes', 'url'=>array('admin')),
);
?>

<h1>View CountryCodes #<?php echo $model->country_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'country_id',
		'iso2',
		'short_name',
		'long_name',
		'iso3',
		'numcode',
		'un_member',
		'calling_code',
		'cctld',
	),
)); ?>
