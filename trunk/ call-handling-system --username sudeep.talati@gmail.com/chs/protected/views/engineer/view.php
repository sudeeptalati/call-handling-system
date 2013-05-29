
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>


<h1>View Engineer : <?php echo $model->fullname; ?></h1>
<div id="submenu">   
<li><?php echo CHtml::link('Manage Engineers',array('admin')); ?></li>
<li><?php echo CHtml::link('Add New Engineers',array('create')); ?></li>
</div>
<br>
<div style="text-align:right;" >
<b><?php echo CHtml::link('Edit',array('update', 'id'=>$model->id)); ?></b>
</div>
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
		'contactDetails.telephone',
		'contactDetails.mobile',
		'contactDetails.email',
		'contactDetails.postcode',

// 		'inactivated_by_user_id',
// 		'inactivated_on',
// 		'contact_details_id',
// 		'delivery_contact_details_id',
// 		//'created_by_user_id',
//			'createdByUser.username',

		//'created',
		array(
				'name'=>'Created',
				'value'=>date('d-M-y H:m',$model->created),
		),
		//'modified',
 		array(
 				'name'=>'Modified',
 				'value'=>date('d-M-y H:m',$model->modified),
		),
	),
)); ?>
