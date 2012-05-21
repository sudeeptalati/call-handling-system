
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<table><tr>
	<td> <?php echo CHtml::link('Manage Engineers',array('admin')); ?></td>
	<td> <?php echo CHtml::link('Add New Engineer',array('create')); ?></td>
</tr></table>

<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('engineer-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Engineers</h1>




<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'engineer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'first_name',
		'last_name',
		//'active',
/*			array(
					'label'=>'active',
					'value'=>$model->active ? "Active" : "Inactive",
			),
	*/		
		'company',
		'vat_reg_number',
		array('name'=>'created_by_user','value'=>'$data->createdByUser->username'),
		/*
		'notes',
		'inactivated_by_user_id',
		'inactivated_on',
		'contact_details_id',
		'delivery_contact_details_id',
		'created_by_user_id',
		'created',
		'modified',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>
