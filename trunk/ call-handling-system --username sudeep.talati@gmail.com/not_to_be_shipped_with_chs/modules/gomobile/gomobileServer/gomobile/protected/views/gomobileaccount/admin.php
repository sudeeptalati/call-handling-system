<?php
/* @var $this GomobileaccountController */
/* @var $model GomobileAccount */

$this->breadcrumbs=array(
	'Gomobile Accounts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List GomobileAccount', 'url'=>array('index')),
	array('label'=>'Create GomobileAccount', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#gomobile-account-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Gomobile Accounts</h1>

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
	'id'=>'gomobile-account-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'gomobile_account_name',
		'company_name',
		'contact_email',
		'no_of_rapport_users',
		'no_of_engineers',
		/*
		'created_on',
		'last_modified_on',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
