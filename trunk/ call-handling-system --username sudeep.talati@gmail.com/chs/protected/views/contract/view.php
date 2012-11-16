
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<table><tr>
	<td> <?php echo CHtml::link('Manage Contracts',array('admin')); ?></td>
	<td> <?php echo CHtml::link('Create Contracts',array('create')); ?></td>
</tr></table>


<h1>View Contract #<?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		//'contract_type_id',
		'contractType.name',
		'name',
//		'main_contact_details_id',
		'management_contact_details',
		'spares_contact_details',
		//'accounts_contact_details',
		//'technical_contact_details',
		'vat_reg_number',
		'notes',
//		'active',
		'inactivated_by_user_id',
		'inactivated_on',
		//'created_by_user_id',
		'createdByUser.username',
		//'created',
		array(
				'name'=>'Created',
				'value'=>date('d-M-y',$model->created),
		),
		'modified',
//		array(
//				'name'=>'Modified',
//				'value'=>date('d-M-y',$model->modified),
//		),
	),
)); ?>
