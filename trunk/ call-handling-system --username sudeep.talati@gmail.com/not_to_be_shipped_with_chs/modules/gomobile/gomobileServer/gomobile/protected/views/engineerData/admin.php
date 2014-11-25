<?php
/* @var $this EngineerDataController */
/* @var $model EngineerData */

$this->breadcrumbs=array(
	'Engineer Datas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List EngineerData', 'url'=>array('index')),
	array('label'=>'Create EngineerData', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#engineer-data-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Engineer Datas</h1>

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
	'id'=>'engineer-data-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'engineer_email',
		'data',
		//'data_status_id',
		
		array('name'=>'data_status_id',
		'value'=>'$data->data_status->name',
		'filter'=>false),
		
			
			
		//'created',
		array('name'=>'created', 'value'=>'$data->created==null ? "":date("d-M-Y",$data->created)', 'filter'=>false),
		array('name'=>'last_modified', 'value'=>'$data->last_modified==null ? "":date("d-M-Y",$data->last_modified)', 'filter'=>false),
		
		//'last_modified',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>