<?php
$this->breadcrumbs=array(
	'Setups'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Setup', 'url'=>array('index')),
	array('label'=>'Create Setup', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('setup-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Setups</h1>

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
	'id'=>'setup-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'company',
		'address',
		'town',
		'postcode_s',
		'postcode_e',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
