
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<table><tr>
	<td> <?php echo CHtml::link('Manage Users',array('admin')); ?></td>
	<td> <?php echo CHtml::link('Create New User',array('create')); ?></td>
</tr></table>

<h1>View User #<?php echo $model->name; ?></h1>
<div style="text-align: right;">
<?php echo CHtml::link('Edit',array('update', 'id'=>$model->id)); ?>
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
//		'password',
		'email',
		'profile',
		//'created',
		array(
				'name'=>'Created',
				'value'=>date('d-M-y',$model->created),
		),
		'modified',
	),
)); ?>
