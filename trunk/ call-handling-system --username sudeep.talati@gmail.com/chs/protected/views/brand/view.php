 <div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>
<h1>Brands</h1>

 

<div id="submenu">   
<li><?php echo CHtml::link('Manage Brands',array('admin')); ?></li>
<li><?php echo CHtml::link('Add New Brand',array('create')); ?></li>
 </div>


<br>
<div style="text-align:right;" >
<b><?php echo CHtml::link('Edit',array('update', 'id'=>$model->id)); ?></b>
</div>
	
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
//		'id',
		'name',
		'information',
		//'active',
		array('name'=>'active', 'value'=>$model->active ? "Yes" : "No"),
		//'created_by_user_id',
		'createdByUser.username',
		array('name'=>'created', 'value'=>date('d-M-y H:m',$model->created)),
		array('name'=>'modified', 'value'=>date('d-M-y H:m',$model->modified)),
		
//		'modified',
		'inactivated',
	),
)); ?>
