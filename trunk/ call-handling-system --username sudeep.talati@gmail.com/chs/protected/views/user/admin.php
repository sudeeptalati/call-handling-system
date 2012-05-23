<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<table><tr>
	<td> <?php echo CHtml::link('Manage Users',array('admin')); ?></td>
	<td> <?php echo CHtml::link('Add New User',array('create')); ?></td>
</tr></table>

<?php
 

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Users</h1>

 

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'username',
		'email',
		'profile',
		array(
		'name'=>'created',
		'type'=>'datetime',
		),
		/*
		'password',
		'modified',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>
