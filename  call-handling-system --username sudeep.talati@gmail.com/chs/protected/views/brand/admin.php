<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

 <h1>Brands</h1>

 

<div id="submenu">   
<li><?php echo CHtml::link('Manage Brands',array('admin')); ?></li>
<li><?php echo CHtml::link('Add New Brand',array('create')); ?></li>
</div>


  



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'brand-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	//	'id',
		'name',
		'information',
		//'active',
		array(  'name'=>'active',
				'header'=>'Active',
				'value'=>'($data->active == 0)?"No":"Yes"',
				'filter'=>array('1'=>'Yes', '0'=>'No'),
		),
		//'created_by_user_id',
		//'createdByUser.name'
		//array( 'name'=>'created_by_user', 'value'=>'$data->createdByUser->username' ),
		//'created',
		array( 'name'=>'created', 'value'=>'$data->created==null ? "":date("d-M-Y",$data->created)', 'filter'=>false),
		//'modified',
		array( 'name'=>'modified', 'value'=>'$data->modified==null ? "":date("d-M-Y",$data->modified)', 'filter'=>false),
		
		/*
		'inactivated',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>
