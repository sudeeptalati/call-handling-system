<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<table><tr>
	<td> <?php echo CHtml::link('Manage Advance settings',array('admin')); ?></td>
	<td> <?php echo CHtml::link('Add Advance settings',array('create')); ?></td>
</tr></table>

<h1>View AdvanceSettings #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parameter',
		'value',
	),
)); ?>
