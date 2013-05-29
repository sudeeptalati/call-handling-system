
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

 

<h1>Manage Engineers</h1>

<div id="submenu">   
<li><?php echo CHtml::link('Manage Engineers',array('admin')); ?></li>
<li><?php echo CHtml::link('Add New Engineers',array('create')); ?></li>
</div>



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
		//'created_by_user_id',
		array('name'=>'user','value'=>'$data->createdByUser->name'),
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
