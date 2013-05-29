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
		'active',
		//'created_by_user_id',
		//'createdByUser.name'
		//array( 'name'=>'created_by_user', 'value'=>'$data->createdByUser->username' ),
		'created',
		//'value'=>date('d-M-Y', $data->created),
		//	array('name'=>'created','value'=>'date("d-M-Y",$data->created)'),
		
		
	/*	
		array(
                        'name'=>'created',
                        'header'=>'Created',
                        'value'=>'Yii::app()->dateFormatter->format("d MMM y",$data->created)'
                    ),
 		*/
		/*
		'modified',
		'inactivated',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>
