
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<table><tr>
	<td> <?php echo CHtml::link('Manage Advance settings',array('admin')); ?></td>
	<td> <?php echo CHtml::link('Add Advance settings',array('create')); ?></td>
</tr></table>


<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('advance-settings-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Advance Settings</h1>

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
	'id'=>'advance-settings-grid',
	//'dataProvider'=>$model->search(),
	'dataProvider'=>$model->dataForAdmin(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'parameter',
		'name',
		'value',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}'
		),
	),
)); ?>