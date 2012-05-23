
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<table><tr>
	<td> <?php echo CHtml::link('Manage Engineers',array('admin')); ?></td>
	<td> <?php echo CHtml::link('Add New Engineer',array('create')); ?></td>
</tr></table>


<h1>View Engineer #<?php echo $model->first_name."  ".$model->last_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'first_name',
		'last_name',
		//'active',
			array(
					'label'=>'active',
					'value'=>$model->active ? "Yes" : "No",
			),
		'company',
		'vat_reg_number',
		'notes',
		'inactivated_by_user_id',
		'inactivated_on',
// 		'contact_details_id',
// 		'delivery_contact_details_id',
// 		//'created_by_user_id',
//		'createdByUser.username',
		//'created',
		array(
				'name'=>'Created',
				'value'=>date('d-M-y',$model->created),
		),
		//'modified',
		array(
				'name'=>'Modified',
				'value'=>date('d-M-y',$model->modified),
		),
	),
)); ?>
