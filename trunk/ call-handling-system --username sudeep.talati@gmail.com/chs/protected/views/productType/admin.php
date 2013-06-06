<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>
 

<h1>Manage Product Types</h1>

<div id="submenu">   
<li><?php echo CHtml::link('Manage Product Types',array('admin')); ?></li>
<li><?php echo CHtml::link(' New Product Types',array('create')); ?></li>
</div>
 

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		'information',
		//'created_by_user_id',
		'createdByUser.name',
		//'created',
		array( 'name'=>'created', 'value'=>'$data->created==null ? "":date("d-M-Y",$data->created)', 'filter'=>false),
		//'modified',
		array( 'name'=>'modified', 'value'=>'$data->modified==null ? "":date("d-M-Y",$data->modified)', 'filter'=>false),
		
		//'server_product_type_id',
		array(
			'class'=>'CButtonColumn',
			'template'=> '{view}{update}',
		),
	),
)); ?>
