 <div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>



<h1>View Brand #<?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
//		'id',
		'name',
		'information',
		'active',
		//'created_by_user_id',
		'createdByUser.username',
		'created',
		/*
		array(
			'name'=>'modified',
			'value'=>date('d-M-Y', $model->modified),
		),
		*/
		'modified',
		'inactivated',
	),
)); ?>
