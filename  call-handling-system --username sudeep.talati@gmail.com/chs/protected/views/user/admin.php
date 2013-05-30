<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<h1>Manage Users</h1>

<div id="submenu">   
<li><?php echo CHtml::link('Manage Users',array('admin')); ?></li>
<li><?php echo CHtml::link('Add New Users',array('create')); ?></li>
</div>
 
 


 

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
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
