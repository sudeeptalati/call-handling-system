<?php
$this->breadcrumbs=array(
	'Country Codes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CountryCodes', 'url'=>array('index')),
	array('label'=>'Create CountryCodes', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('country-codes-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Country Codes</h1>

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
	'id'=>'country-codes-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'country_id',
		'iso2',
		'short_name',
		'long_name',
		'iso3',
		'numcode',
		/*
		'un_member',
		'calling_code',
		'cctld',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
