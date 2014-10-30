<?php
/* @var $this GmServicecallsController */
/* @var $model GmServicecalls */

$this->breadcrumbs=array(
	'Gm Servicecalls'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List GmServicecalls', 'url'=>array('index')),
	array('label'=>'Create GmServicecalls', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#gm-servicecalls-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Gm Servicecalls</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gm-servicecalls-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'servicecall_id',
		array(	'name'=>'service_reference_number',
				//'value'=>'$data->servicecall_id',
			    'value' => 'CHtml::link($data->service_reference_number, array("/Servicecall/view&id=".$data->servicecall_id))',
		 		'type'=>'raw',
				//'header' => 'Ref No#'
		),
		//'mobile_status',
		array('name'=>'mobile_status_id',
			'value'=>'$data->mobile_status->name',),
		array('name'=>'created', 'value'=>'date("d-M-Y",$data->created)', 'filter'=>false),
		array('name'=>'modified', 'value'=>'$data->modified==null ? "":date("d-M-Y",$data->modified)', 'filter'=>false),
		//'modified',
		//array(
			//'class'=>'CButtonColumn',
		//),
	),
)); ?>
